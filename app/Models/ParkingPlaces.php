<?php

namespace App\Models;
use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParkingPlaces extends Model
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
}
