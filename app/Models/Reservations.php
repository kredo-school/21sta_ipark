<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservations extends Model
{
    use HasFactory;

    private $count;
    public function countReservations($specified_from_time,$specified_to_time,$parking_no)
    {

        // クエリの構築
        $query = DB::table('reservation')
                ->select(DB::raw('COUNT(*) AS conflicting_reservations'))
                    ->where(function ($query) use ($specified_from_time, $specified_to_time) {
                        $query->where('from_time', '<=', $specified_to_time)
                    ->where('to_time', '>=', $specified_from_time);
                     })
                    ->orWhere(function ($query) use ($specified_from_time, $specified_to_time) {
                        $query->where('from_time', '>=', $specified_from_time)
                    ->where('from_time', '<', $specified_to_time);
                    })
                    ->where('parking_no', $parking_no);

        // クエリの実行
        $conflicting_reservations = $query->first()->conflicting_reservations;

        // 結果を利用して何かを行う
        if ($conflicting_reservations >= 0) {
            // 予約不可
            // 何らかの処理を行う
        } else {
            // 予約可能
            // 何らかの処理を行う
        }

    }



}
