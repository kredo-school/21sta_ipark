<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingPlace;

class AdminParkingController extends Controller
{
    private $parkingPlace;
    public function __construct(ParkingPlace $parkingPlace)
    {
        $this->parkingPlace = $parkingPlace;
    }

    // filter search
    public function parkingsList(Request $request)
    {
        $query = ParkingPlace::query();

        if ($request->filled('parking_place_name')) {
            $query->where('parking_place_name', 'like', '%' . $request->parking_place_name . '%');
        }

        if ($request->filled('postal_code')) {
            $query->where('postal_code', 'like', '%' . $request->postal_code . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('status')) {
            if ($request->status === 'open') {
                $query->whereNull('deleted_at');
            } elseif ($request->status === 'closed') {
                $query->onlyTrashed();
            }
        }

        if ($request->filled('number_of_slots_from')) {
            $query->withTrashed()->where('max_number', '>=', $request->number_of_slots_from);
        }

        if ($request->filled('number_of_slots_to')) {
            $query->withTrashed()->where('max_number', '<=', $request->number_of_slots_to);
        }

        $all_parkings = $query->orderBy('parking_place_name')->withTrashed()->paginate(5);

        return view('admin.parking.parkings_list', compact('all_parkings'));
    }

    // Deactivate Parking Place
    public function deactivate(Request $request)
    {
        $selectedIds = $request->input('parking_ids', []);

        ParkingPlace::whereIn('id', $selectedIds)->delete();

        return redirect()->back();
    }

    // Activate Parking Place
    public function activate(Request $request)
    {
        $selectedIds = $request->input('parking_ids', []);

        foreach($selectedIds as $id){
            $this->parkingPlace->onlyTrashed()->findOrFail($id)->restore();
        }

        ParkingPlace::onlyTrashed()->whereIn('id', $selectedIds)->restore();

        return redirect()->back();
    }

    // Regiter New parking place
    public function index()
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
