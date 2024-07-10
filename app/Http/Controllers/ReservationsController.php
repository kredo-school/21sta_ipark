<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservations;
use App\Models\ParkingPlace;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ReservationsController extends Controller
{
    private $parkingPlace;
    private $reservation;

    public function __construct(ParkingPlace $parkingPlace, Reservation $reservation)
    {
        $this->parkingPlace = $parkingPlace;
        $this->reservation = $reservation;
    }

    public function index()
    {

    }

    public function show($id)
    {
        $all_parking = $this->parkingPlace->findOrFail($id);

        return view('Parking_lots.reservation')->with('all_parking', $all_parking);
    }

    public function create(ReservationRequest $request)
    {
        if ($request->validated()) {
            // Validation passed
            $parking_no = $request->parking_places_id;
            $date = $request->date;
            $from_time = $request->from_hour . ":" . $request->from_minute;
            $to_time = $request->to_hour . ":" . $request->to_minute;

            // Check if reservation is possible
            if (!$this->isReservationPossible($date,$from_time,$to_time,$parking_no)) {
                return redirect()->back()->withErrors(['error' => 'Reservation for the selected date and time is not available.'])->withInput();
            }

            $carbonDate = Carbon::parse($date);
            $dayOfWeek = $carbonDate->shortEnglishDayOfWeek;
            $isWeekend = ($dayOfWeek == "Sat" || $dayOfWeek == "Sun" || $this->isHoliday($date));

            $fee = $this->calculateAmount($from_time,$to_time,$isWeekend,$parking_no);

            $data = $request->all();
            $data['fee'] = $fee;

            $request->session()->put('reservation_data', $data);
            return redirect()->back()
            ->withInput()
            ->with('date', $date)
            ->with('cartype', $request->cartype)
            ->with('from_time', $from_time)
            ->with('to_time', $to_time)
            ->with('dayOfWeek', $dayOfWeek)
            ->with('fee', $fee)
            ->with('isWeekend', $isWeekend);
        } else {
            return redirect()->back()->withErrors($request)->withInput();
        }
    }

    private function isReservationPossible($date,$from_time,$to_time,$parking_no)
    {
        $query = DB::table('reservations')
            ->select(DB::raw('COUNT(*) AS conflicting_reservations'))
            ->where('date', '=', $date)
            ->where(function ($query) use ($from_time, $to_time) {
                $query->where('planning_time_from', '<', $to_time)
                    ->where('planning_time_to', '>', $from_time); // planning_time_to > $from_time
            })
            ->orWhere(function ($query) use ($date, $from_time, $to_time) {
                $query->where('date', '=', $date)
                    ->where('planning_time_from', '>', $from_time)
                    ->where('planning_time_from', '<', $to_time);
            })
            ->where('parking_place_id', $parking_no);

        $conflicting_reservations = $query->first()->conflicting_reservations;

        $maxNumber = DB::table('parking_places')
                ->where('id', $parking_no)
                ->value('max_number');

        if ($conflicting_reservations >= $maxNumber) {
            return false;
        } else {
            return true;
        }
    }

    public function calculateAmount($from_time,$to_time,$isWeekend,$parking_no)
    {

        // depend on weekend or weekdays
        if ($isWeekend) {
            // weekend
            $parkingPlace = ParkingPlace::select('daytime_from', 'daytime_to', 'holiday_daytime_amount', 'holiday_night_amount', 'maximum_amount')
            ->where('id', $parking_no)
            ->first();

            $daytimeRate = $parkingPlace->holiday_daytime_amount; // fee_holiday_daytime
            $nighttimeRate = $parkingPlace->holiday_night_amount; // fee_holiday_nighttime
        } else {
            // weekdays

            $parkingPlace = ParkingPlace::select('daytime_from', 'daytime_to', 'weekday_daytime_amount', 'weekday_night_amount', 'maximum_amount')
            ->where('id', $parking_no)
            ->first();

            $daytimeRate = $parkingPlace->weekday_daytime_amount; // fee_weekday_daytime
            $nighttimeRate = $parkingPlace->weekday_night_amount; // fee_weekday_nighttime

        }
        $daytimeFromDateTime = Carbon::parse($parkingPlace->daytime_from);
        $daytimeToDateTime = Carbon::parse($parkingPlace->daytime_to);

        // To convert the start and end times of a reservation to Carbon objects
        $fromDateTime = Carbon::parse($from_time);
        $toDateTime = Carbon::parse($to_time);

        $amount = 0;

        // To loop through reservation times in 30-minute intervals.
        $currentDateTime = $fromDateTime->copy();

        while ($currentDateTime < $toDateTime) {
            // To get the time 30 minutes later
            $nextDateTime = $currentDateTime->copy()->addMinutes(30);

            // To determine whether the given time period is during daytime or nighttime
            if ($daytimeFromDateTime <= $currentDateTime  && $currentDateTime < $daytimeToDateTime) {
                $amount += $daytimeRate;
            } else {
                $amount += $nighttimeRate;
            }

            $currentDateTime = $nextDateTime;
        }

        // To adjust so as not to exceed the maximum fee
        if ($amount > $parkingPlace->maximum_amount) {
            $amount = $parkingPlace->maximum_amount;
        }

        return $amount;
    }

    public function holiday(){
        $api_key = env('GOOGLE_API_KEY');
        $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
        $start = date('2024-01-01\T00:00:00\Z');
        $end = date('2026-12-31\T00:00:00\Z');

        $url = "https://www.googleapis.com/calendar/v3/calendars/" . $calendar_id . "/events?";
        $query = [
            'key' => $api_key,
            'timeMin' => $start,
            'timeMax' => $end,
            'maxResults' => 50,
            'orderBy' => 'startTime',
            'singleEvents' => 'true'
        ];

        $results = [];
        if ($data = file_get_contents($url. http_build_query($query), true)) {
            $data = json_decode($data);
            foreach ($data->items as $row) {
                $results[] = $row->start->date;
            }
        }

        return $results;
    }

    public function isHoliday($date){
        $holidays = $this->holiday();

        return in_array($date, $holidays);
    }

    public function payment(Request $request)
    {

        $reservationData = $request->session()->get('reservation_data');

        // reservation_data 配列内の各要素にアクセス
        $parkingPlacesId = $reservationData['parking_places_id'];
        $cartype = $reservationData['cartype'];
        $date = $reservationData['date'];
        $fee = $reservationData['fee'];
        $fromtime = $reservationData['from_hour'] . ':' . $reservationData['from_minute'];
        $totime = $reservationData['to_hour'] . ':' .$reservationData['to_minute'];

        // 配列に詰める
        $reservationdata = compact(
            'parkingPlacesId',
            'cartype',
            'date',
            'fee',
            'fromtime',
            'totime'
        );
        $success = false;
        return view('Parking_lots.payment')
                ->with('reservationdata', $reservationdata)
                ->with('success', $success);
    }

    public function pay(Request $request)
    {
        return view('login');
    }

    public function store(Request $request)
    {

        $reservations = new Reservation();
        $reservations->parking_place_id = $request->parkingPlacesId;
        $reservations->parking_slot_id 
            = $this->findAvailableParkingSlot($request->parkingPlacesId,$request->date,$request->fromtime,$request->totime);
        $reservations->user_id = auth()->id();
        $reservations->date = $request->date;
        $reservations->fee = $request->fee;
        $reservations->planning_time_from = $request->fromtime;
        $reservations->planning_time_to = $request->totime;
        $reservations->actual_start_time = "00:00:00";
        $reservations->actual_end_time = "00:00:00";
        $reservations->car_type = $request->cartype;

        $reservations->save();

    }

    function findAvailableParkingSlot($parking_no, $date, $from_time, $to_time) {
        // 予約済みのスロットを取得するクエリ
        $reservedSlots = DB::table('reservations')
                            ->select('parking_slot_id') // SELECT句にparking_slot_idを指定
                            ->where('date', '=', $date)
                            ->where(function ($query) use ($from_time, $to_time) {
                                $query->where('planning_time_from', '<', $to_time)
                                    ->where('planning_time_to', '>', $from_time);
                            })
                            ->orWhere(function ($query) use ($date, $from_time, $to_time) {
                                $query->where('date', '=', $date)
                                    ->where('planning_time_from', '>', $from_time)
                                    ->where('planning_time_from', '<', $to_time);
                            })
                            ->where('parking_place_id', $parking_no)
                            ->pluck('parking_slot_id') // parking_slot_idのみを取得して配列にする
                            ->toArray();

        // 駐車場の最大スロット数を取得
        $maxSlots = DB::table('parking_places')
                        ->where('id', $parking_no)
                        ->value('max_number');

        // 空いているスロットを決定する
        for ($slotId = 1; $slotId <= $maxSlots; $slotId++) {
            if (!in_array($slotId, $reservedSlots)) {
                return $slotId;
            }
        }
    }

    public function update(Request $request, $id)
    {

    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->back();
    }
}
