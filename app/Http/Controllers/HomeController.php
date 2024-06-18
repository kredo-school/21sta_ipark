<?php

namespace App\Http\Controllers;

use App\Models\ParkingPlace;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $parking_places;

    public function __construct(ParkingPlace $parking_places)
    {
        // $this->middleware('auth');

        $this->parking_places = $parking_places;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $recommendation = $this->parking_places->get();

        return view('home')
                ->with('recommendation', $recommendation);
    }

    public function showReservationForm($id){
        $parking_places = $this->parking_places->findOrFail($id);

        return view('parking_lots.reservation')
            ->with('parking_places', $parking_places);
    }

    public function login(){
        return view('auth.login_to_favorite');
    }
}
