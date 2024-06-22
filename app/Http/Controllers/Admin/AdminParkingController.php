<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingPlace;

class AdminParkingController extends Controller
{
    // private $parking_places;
    // public function __construct(ParkingPlace $parking_places){
    //     $this->parking_places = $parking_places;
    // }
    // public function RegisterNewParking()
    // {
    //     return view('admin.parking.index');
    // }

    // public function store(Request $request){
    //     $request->validate([
    //             'parking_place_name' =>'required',
    //             'postal_code' =>'required',
    //             'city' =>'required',
    //            'street' =>'required',
    //            'max_number' =>'required',
    //             'daytime_from' =>'required',
    //             'daytime_to' =>'required',
    //             'image' =>'required|mimes:jpeg,jpg,png,gif|max:1048',
    //             'contact_number' =>'required',
    //             'weekday_daytime_amount' =>'required',
    //             'weekday_night_amount' =>'required',
    //             'holiday_daytime_amount' =>'required',
    //             'holiday_night_amount' =>'required',
    //            'maximum_amount' =>'required',
    //             'penalty_amount' =>'required',
    //     ]);

    //     $this->parking_places->parking_place_name = $request->parking_place_name;
    //     $this->parking_places->postal_code = $request->postal_code;
    //     $this->parking_places->city = $request->city;
    //     $this->parking_places->street = $request->street;
    //     $this->parking_places->max_number = $request->max_number;
    //     $this->parking_places->daytime_from = $request->daytime_from;
    //     $this->parking_places->daytime_to = $request->daytime_to;
    //     $this->parking_places->image = 'data:image/'.
    //     $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
    //     $this->parking_places->contact_number = $request->contact_number;
    //     $this->parking_places->weekday_daytime_amount = $request->weekday_daytime_amount;
    //     $this->parking_places->weekday_night_amount = $request->weekday_night_amount;
    //     $this->parking_places->holiday_daytime_amount = $request->holiday_daytime_amount;
    //     $this->parking_places->holiday_night_amount = $request->holiday_night_amount;
    //     $this->parking_places->maximum_amount = $request->maximum_amount;
    //     $this->parking_places->penalty_amount = $request->penalty_amount;
    //     $this->parking_places->save();



    //     return redirect()->route('admin.parking.index');


    // }

    public function RegisterNewParking()
    {
        return view('admin.parking.index');
    }

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
            'image' =>'nullable|mimes:jpeg,jpg,png,gif|max:1048',  // ここでnullableを追加
            'contact_number' =>'required',
            'weekday_daytime_amount' =>'required',
            'weekday_night_amount' =>'required',
            'holiday_daytime_amount' =>'required',
            'holiday_night_amount' =>'required',
            'maximum_amount' =>'required',
            'penalty_amount' =>'required',
        ]);

        // 新しいParkingPlaceインスタンスを作成
        $parkingPlace = new ParkingPlace();
        $parkingPlace->parking_place_name = $request->parking_place_name;
        $parkingPlace->postal_code = $request->postal_code;
        $parkingPlace->city = $request->city;
        $parkingPlace->street = $request->street;
        $parkingPlace->max_number = $request->max_number;
        $parkingPlace->daytime_from = $request->daytime_from;
        $parkingPlace->daytime_to = $request->daytime_to;

        // 画像がアップロードされているか確認
        if ($request->hasFile('image')) {
            $parkingPlace->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $parkingPlace->contact_number = $request->contact_number;
        $parkingPlace->weekday_daytime_amount = $request->weekday_daytime_amount;
        $parkingPlace->weekday_night_amount = $request->weekday_night_amount;
        $parkingPlace->holiday_daytime_amount = $request->holiday_daytime_amount;
        $parkingPlace->holiday_night_amount = $request->holiday_night_amount;
        $parkingPlace->maximum_amount = $request->maximum_amount;
        $parkingPlace->penalty_amount = $request->penalty_amount;
        $parkingPlace->save();

        return redirect()->route('admin.parking.index')->with('success', 'Parking place registered successfully.');
}
}
