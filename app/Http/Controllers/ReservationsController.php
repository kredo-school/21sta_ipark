<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservations;
use App\Models\ParkingPlace;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ReservationsController extends Controller
{
    private $parkingPlace;

    public function __construct(ParkingPlace $parkingPlace)
    {
        $this->parkingPlace = $parkingPlace;
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
                    $query->where('planning_time_from', '<=', $to_time)
                        ->where('planning_time_to', '>=', $from_time);
                })
                ->orWhere(function ($query) use ($date, $from_time, $to_time) {
                    $query->where('date', '=', $date)
                        ->where('planning_time_from', '>=', $from_time)
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

    private function calculateAmount($from_time,$to_time,$isWeekend,$parking_no)
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

    public function store(Request $request)
    {
        return view('Parking_lots.payment');
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        // ユーザーを削除するロジックなどを追加
    }

}
