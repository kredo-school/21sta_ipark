<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParkingPlacesController extends Controller
{
    private $parkingPlace;

    public function __construct(ParkingPlacesController $parkingPlace)
    {
        $this->parkingPlace = $parkingPlace;
    }
}
