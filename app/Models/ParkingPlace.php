<?php

namespace App\Models;
use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ParkingPlace extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
