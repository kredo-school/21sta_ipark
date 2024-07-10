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

    // validation rules
    private function validationRules()
    {
        return [
            'parking_place_name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'postal_code' => 'required|regex:/^\d{3}-\d{4}$/',
            'city' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'street' => 'required|regex:/^[a-zA-Z0-9\s\-]+$/|max:50',
            'max_number' => 'required|integer|min:1|max:9999',
            'daytime_from' => 'required|date_format:H:i',
            'daytime_to' => 'required|date_format:H:i',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
            'contact_number' => ['required', 'regex:/^\d{10,11}$|^\d{2,4}-\d{3,4}-\d{4}$/'],
            'weekday_daytime_amount' => 'required|integer|min:0|max:9999',
            'weekday_night_amount' => 'required|integer|min:0|max:9999',
            'holiday_daytime_amount' => 'required|integer|min:0|max:9999',
            'holiday_night_amount' => 'required|integer|min:0|max:9999',
            'maximum_amount' => 'required|integer|min:0|max:9999',
        ];
    }

    // erroe messages
    private function validationMessages()
    {
        return [
            'parking_place_name.required' => 'The parking place name is required.',
            'postal_code.required' => 'The postal code is required.',
            'city.required' => 'The city is required.',
            'street.required' => 'The street is required.',
            'max_number.required' => 'The number of slots is required.',
            'daytime_from.required' => 'The daytime from is required.',
            'daytime_to.required' => 'The daytime to is required.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png, gif.',
            'image.max' => 'The image must not be greater than 2048 kilobytes.',
            'contact_number.required' => 'The contact number is required.',
            'weekday_daytime_amount.required' => 'The fee for weekday daytime is required.',
            'weekday_night_amount.required' => 'The fee for weekday night is required.',
            'holiday_daytime_amount.required' => 'The fee for holiday daytime is required.',
            'holiday_night_amount.required' => 'The fee for holiday night is required.',
            'maximum_amount.required' => 'The max fee for 24 hours is required.',
        ];
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
            $query->withTrashed()
                ->where('max_number', '>=', $request->number_of_slots_from);
        }

        if ($request->filled('number_of_slots_to')) {
            $query->withTrashed()
                ->where('max_number', '<=', $request->number_of_slots_to);
        }

        $all_parkings = $query->orderBy('parking_place_name')
            ->withTrashed()
            ->paginate(10);

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

        foreach ($selectedIds as $id) {
            $this->parkingPlace->onlyTrashed()
                ->findOrFail($id)
                ->restore();
        }

        ParkingPlace::onlyTrashed()
            ->whereIn('id', $selectedIds)
            ->restore();

        return redirect()->back();
    }

    // Register New parking place
    public function index()
    {
        return view('admin.parking.index');
    }

    // Store a new parking place
    public function store(Request $request)
    {
        $request->validate($this->validationRules(), $this->validationMessages());

        $parkingPlace = new ParkingPlace();
        $this->saveParkingPlaceData($parkingPlace, $request);

        return redirect()->route('admin.parking.index')
            ->with('success', 'Parking place registered successfully.');
    }

    // Update an existing parking place
    public function updateParking(Request $request, $id)
    {
        $request->validate($this->validationRules(), $this->validationMessages());

        $parkingPlace = ParkingPlace::withTrashed()->findOrFail($id);
        $this->saveParkingPlaceData($parkingPlace, $request);

        return redirect()->route('admin.parking.parkings_list')
            ->with('success', 'Parking place updated successfully.');

    }

    // Save parking place data
    private function saveParkingPlaceData(ParkingPlace $parkingPlace, Request $request)
    {
        $parkingPlace->parking_place_name = $request->parking_place_name;
        $parkingPlace->postal_code = $request->postal_code;
        $parkingPlace->city = $request->city;
        $parkingPlace->street = $request->street;
        $parkingPlace->max_number = $request->max_number;
        $parkingPlace->daytime_from = $request->daytime_from;
        $parkingPlace->daytime_to = $request->daytime_to;
        $parkingPlace->contact_number = $request->contact_number;
        $parkingPlace->weekday_daytime_amount = $request->weekday_daytime_amount;
        $parkingPlace->weekday_night_amount = $request->weekday_night_amount;
        $parkingPlace->holiday_daytime_amount = $request->holiday_daytime_amount;
        $parkingPlace->holiday_night_amount = $request->holiday_night_amount;
        $parkingPlace->maximum_amount = $request->maximum_amount;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $parkingPlace->image = str_replace('public/', 'storage/', $imagePath);
        }

        $parkingPlace->save();
    }

    // Edit parking place form
    public function edit($id)
    {
        $parkingPlace = ParkingPlace::withTrashed()->findOrFail($id);
        return view('admin.parking.update_parking')->with('parking_place', $parkingPlace);
    }

    // Show parking place details
    public function show($id)
    {
        $parkingPlace = $this->parkingPlace->withTrashed()->findOrFail($id);
        $reviews = $parkingPlace->reviews;
        $average_star = $parkingPlace->reviews->avg('star');

        return view('admin.parking.parking_detail')
                ->with('parking_place', $parkingPlace)
                ->with('reviews', $reviews)
                ->with('average_star', $average_star);
    }
}
