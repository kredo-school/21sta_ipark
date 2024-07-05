<?php

namespace App\Models;
use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParkingPlace extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'parking_places';

    public function getDaytimeFromAttribute($value)
    {
        return $this->formatTime($value);
    }

    public function getDaytimeToAttribute($value)
    {
        return $this->formatTime($value);
    }

    private function formatTime($time)
    {
        if ($time === '24:00:00') {
            return '24:00';
        }

        return Carbon::createFromFormat('H:i:s', $time)->format('H:i');
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function isfavorited(){
        return $this->favorites()->where('user_id', Auth::user()->id)->exists();
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function isReservationPossible($date = null, $fromTime = null, $toTime = null){
        // $date = $date ?: today();
        // $fromTime = $fromTime ?: now()->addHours(9)->format('H:i:s');
        // $toTime = $toTime ?: now()->addHours(9)->format('H:i:s');

        if (!$date) {
            $date = today();
        }
        if (!$fromTime) {
            $fromTime = now()->addHours(9)->format('H:i:s');
        }
        if (!$toTime) {
            $toTime = now()->addHours(9)->format('H:i:s');
        }

        Log::info("Checking reservations for date: {$date}, from: {$fromTime}, to: {$toTime}");


        $numberOfCurrentReservations
            = $this->reservations()
                ->where('date', $date)
                ->where(function($query) use ($fromTime, $toTime) {
                    $query->where('planning_time_from', '<=', $toTime)
                        ->where('planning_time_to', '>=', $fromTime);
                    })
                ->count();

        $maxNumber = $this->max_number;

        return $numberOfCurrentReservations < $maxNumber;
    }

    protected $fillable = [
        'parking_place_name',
        'postal_code',
        'city',
        'street',
        'max_number',
        'daytime_from',
        'daytime_to',
        'image',
        'contact_number',
        'weekday_daytime_amount',
        'weekday_night_amount',
        'holiday_daytime_amount',
        'holiday_night_amount',
        'maximum_amount',
        'penalty_amount',
    ];
}
