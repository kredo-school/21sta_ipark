<?php

namespace App\Http\Controllers;
use App\Models\ParkingPlace;

use Illuminate\Http\Request;

class ParkingPlaceController extends Controller
{
    //
    private $parking_places;

    public function __construct(ParkingPlace $parking_places){
        $this->parking_places = $parking_places;
    }

    public function show($id){
        $parking_place = $this->parking_places->findOrFail($id);
        $reviews = $this->parking_places->reviews->all();
        $average_star = $parking_place->reviews->avg('star', 1);

        return view('parking_lots.parking_detail')
                ->with('parking_place', $parking_place)
                ->with('reviews', $reviews)
                ->with('average_star', $average_star);
    }

    public function ParkingList(Request $request){
        $search = $request->input('search');

        $parking_places = $this->parking_places
            ->where('city', 'like', '%'.$search.'%')
            ->get();

        return view('parking_lots.parking_list', compact('parking_places', 'search'));
    }

}
