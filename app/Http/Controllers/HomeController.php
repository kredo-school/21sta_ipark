<?php

namespace App\Http\Controllers;

use App\Models\ParkingPlaces;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $parking_places;

    public function __construct(ParkingPlaces $parking_places)
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

    public function showParkingList(Request $request){
        $search = $request->input('search');

        $parking_places = $this->parking_places
            ->where('city', 'like', '%'.$search.'%')
            ->get();

        return view('parking_lots.parking_list', compact('parking_places', 'search'));
    }

    public function showParkingDetail($id){
        $parking_places = $this->parking_places->findOrFail($id);

        return view('parking_lots.parking_detail')
            ->with('parking_places', $parking_places);
    }

    public function showReservationForm($id){
        $parking_places = $this->parking_places->findOrFail($id);

        return view('parking_lots.reservation')
            ->with('parking_places', $parking_places);
    }
}
