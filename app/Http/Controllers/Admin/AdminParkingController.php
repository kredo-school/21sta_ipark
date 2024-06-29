<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingPlace;

class AdminParkingController extends Controller
{
    private $parkingPlace;
    public function __construct(ParkingPlace $parkingPlace){
        $this->parkingPlace = $parkingPlace;
    }

    public function parkingsList()
    {
        $all_parkings = $this->parkingPlace->withTrashed()->latest()->paginate(5);
        return view('admin.parking.parkings_list')->with('all_parkings', $all_parkings);
    }

    public function index()
    {
        return view('admin.parking.index');
    }

    // Deactivate Parking Place
    public function deactivate(Request $request){
        $selectedIds = $request->input('selected');
        $this->parkingPlace->whereIn('id', $selectedIds)->delete();
        return redirect()->back();
    }

    // Activate Parking Place
    public function activate($id){
        $this->parkingPlace->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

    // filter search
    // public function search(Request $request){
    //     if($request->filled('serch')){
    //         $parkingPlaces = $this->parkingPlace->where('parking_place_name','like', '%'. $request->search .'%')->get();
    //     }

    //     return view('admin.parking.search')->with('parking_place_name', $parkingPlaces)->with('search', $request->search);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'parking_place_name' =>'required',
            'postal_code' =>'required',
            'city' =>'required',
            'street' =>'required',
            'max_number' =>'required',
            'daytime_from' =>'required',
            'daytime_to' =>'required',
            'image' =>'nullable|mimes:jpeg,jpg,png,gif|max:2048',
            'contact_number' =>'required',
            'weekday_daytime_amount' =>'required',
            'weekday_night_amount' =>'required',
            'holiday_daytime_amount' =>'required',
            'holiday_night_amount' =>'required',
            'maximum_amount' =>'required',
        ]);

        $parkingPlace = new ParkingPlace();
        $parkingPlace->parking_place_name = $request->parking_place_name;
        $parkingPlace->postal_code = $request->postal_code;
        $parkingPlace->city = $request->city;
        $parkingPlace->street = $request->street;
        $parkingPlace->max_number = $request->max_number;
        $parkingPlace->daytime_from = $request->daytime_from;
        $parkingPlace->daytime_to = $request->daytime_to;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $parkingPlace->image = str_replace('public/', 'storage/', $imagePath);
        }

        $parkingPlace->contact_number = $request->contact_number;
        $parkingPlace->weekday_daytime_amount = $request->weekday_daytime_amount;
        $parkingPlace->weekday_night_amount = $request->weekday_night_amount;
        $parkingPlace->holiday_daytime_amount = $request->holiday_daytime_amount;
        $parkingPlace->holiday_night_amount = $request->holiday_night_amount;
        $parkingPlace->maximum_amount = $request->maximum_amount;
        $parkingPlace->save();

        return redirect()->route('admin.parking.index')->with('success', 'Parking place registered successfully.');
}
}
