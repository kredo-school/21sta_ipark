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
        // ユーザー一覧を取得するロジックなどを追加
    }

    public function show($id)
    {
        $all_parking = $this->parkingPlace->findOrFail($id);

        return view('Parking_lots.reservation')->with('all_parking', $all_parking);
    }

    public function create(ReservationRequest $request)
    {
        // dd($request);
        // return redirect()->back();
        
        if ($request->validated()) {
            // Validation passed
            
            $parking_no = $request->parking_no;
            $date = $request->date;
            $from_time = $request->from_hour . ":" . $request->from_minute;
            $to_time = $request->to_hour . ":" . $request->to_minute;

            // Check if reservation is possible
            if (!$this->isReservationPossible($date,$from_time,$to_time,$parking_no)) {
                return redirect()->back()->withErrors(['error' => 'Reservation for the selected date and time is not available.'])->withInput();
            }

            $carbonDate = Carbon::parse($date);
            $dayOfWeek = $carbonDate->shortEnglishDayOfWeek;
            $isWeekend = ($dayOfWeek === Carbon::SATURDAY || $dayOfWeek === Carbon::SUNDAY);

            $fee = $this->calculateAmount($from_time,$to_time,$isWeekend,$parking_no);
            
            return redirect()->back()
            ->withInput()
            ->with('date', $date)
            ->with('from_time', $from_time)
            ->with('to_time', $to_time)
            ->with('dayOfWeek', $dayOfWeek)
            ->with('fee', $fee);
        } else {
            return redirect()->back()->withErrors($request)->withInput();
        }
    }

    private function isReservationPossible($date,$from_time,$to_time,$parking_no)
    {
        $query = DB::table('reservation')
                ->select(DB::raw('COUNT(*) AS conflicting_reservations'))
                    ->where(function ($query) use ($from_time, $to_time) {
                        $query->where('from_time', '<=', $to_time)
                    ->where('to_time', '>=', $from_time);
                     })
                    ->orWhere(function ($query) use ($from_time, $to_time) {
                        $query->where('from_time', '>=', $from_time)
                    ->where('from_time', '<', $to_time);
                    })
                    ->where('parking_no', $parking_no);

        // クエリの実行
        $conflicting_reservations = $query->first()->conflicting_reservations;

        $maxNumber = DB::table('parkin_places')
                ->where('id', $parking_no)
                ->value('max_number');

        // 結果を利用して何かを行う
        if ($conflicting_reservations >= $maxNumber) {
            return false;
        } else {
            return true;
        }
    }

    public function calculateAmount($from_time,$to_time,$isWeekend,$parking_no)
    {

        // 予約時間の計算
        $fromDateTime = Carbon::createFromFormat('Y-m-d H:i', "$fromTime");
        $toDateTime = Carbon::createFromFormat('Y-m-d H:i', "$toTime");
        $durationInMinutes = $toDateTime->diffInMinutes($fromDateTime);

        // 駐車場の料金情報を取得
        $parkingPlace = ParkingPlace::findOrFail($parking_no);

        // 料金計算
        $rate = $$isWeekend ? 
            ($fromDateTime->isWeekday() ? $parkingPlace->holiday_daytime_amount : $parkingPlace->holiday_night_amount) :
            ($fromDateTime->isWeekday() ? $parkingPlace->weekday_daytime_amount : $parkingPlace->weekday_night_amount);

        // 30分ごとの料金
        $amount = ceil($durationInMinutes / 30) * $rate;

        // 最大料金を超えないように調整
        if ($amount > $parkingPlace->maximum_amount) {
            $amount = $parkingPlace->maximum_amount;
        }

        return $amount;
    }

    public function store(Request $request)
    {
        dd($request);
        // ユーザーを保存するロジックなどを追加
    }

    public function edit($id)
    {
        // ユーザー編集フォームを表示するロジックなどを追加
    }

    public function update(Request $request, $id)
    {
        // ユーザーを更新するロジックなどを追加
    }

    public function destroy($id)
    {
        // ユーザーを削除するロジックなどを追加
    }

}
