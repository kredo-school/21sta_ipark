<?php

namespace App\Http\Controllers;

use App\Models\ParkingPlace;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        $date = $request->input('date');
        $fromTime = $request->from_hour . ":" . $request->from_minute;
        $toTime = $request->to_hour . ":" . $request->to_minute;

        $query = $this->parking_places->query();
        // $query = ParkingPlace::query();
        // $query = DB::table('parking_places');

        // $parking_place = ParkingPlace::all();

        if ($request->has('parking_place_name') && $request->parking_place_name) {
            $query->where('parking_place_name', 'like', '%' . $request->parking_place_name . '%');
        }

        if ($request->has('postal_code') && $request->postal_code) {
            $query->where('postal_code', $request->postal_code);
        }

        if ($request->has('city') && $request->city) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // if ($request->has('only_open') && $request->only_open == 'open') {
        //     $parking_places = $query->get()->filter(function ($parking_place) {
        //         return $parking_place->isReservationPossible();
        //     });
        // } else {
        //     $parking_places = $query->get();
        // }

        // $date = $request->date;
        // $fromTime = $request->from_hour . ":" . $request->from_minute;
        // $toTime = $request->to_hour . ":" . $request->to_minute;

        if ($request->has('only_open') && $request->only_open == 'open') {
            $query = $query->get()->filter(function ($parking_place) use ($date, $fromTime, $toTime) {
                return $parking_place->isReservationPossible($date, $fromTime, $toTime);
            });
        } else {
            $query = $query->get();
        }

        $parking_places = $query;

        if ($date && $fromTime && $toTime) {
            $query->where('date', $date)
                    ->where('planning_time_from', '<=', $toTime)
                    ->where('planning_time_to', '>=', $fromTime);
            ;
        }

        $filteredIds = $parking_places->pluck('id');

        $parking_places = $this->parking_places->whereIn('id', $filteredIds)
            ->where('city', 'like', '%'.$search.'%')
            ->paginate(9);

        // $parking_places = $query->paginate(9);

        $isTodayHoliday = $this->isTodayHoliday();
        $isTodayWeekend = $this->isTodayWeekend();

        return view('parking_lots.parking_list',
                compact('parking_places', 'search', 'isTodayHoliday', 'isTodayWeekend'));
    }

    public function holiday(){
        $api_key = env('GOOGLE_API_KEY');
        $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
        $start = date('2024-01-01\T00:00:00\Z');
        $end = date('2026-12-31\T00:00:00\Z');

        $url = "https://www.googleapis.com/calendar/v3/calendars/" . $calendar_id . "/events?";
        $query = [
            'key' => $api_key,
            'timeMin' => $start,
            'timeMax' => $end,
            'maxResults' => 50,
            'orderBy' => 'startTime',
            'singleEvents' => 'true'
        ];

        $results = [];
        if ($data = file_get_contents($url. http_build_query($query), true)) {
            $data = json_decode($data);
            foreach ($data->items as $row) {
                $results[] = $row->start->date;
            }
        }

        return $results;
    }

    public function isTodayHoliday(){
        $holidays = $this->holiday();
        $today = today();

        return in_array($today, $holidays);
    }

    public function isTodayWeekend(){
        $dayOfWeek = Carbon::today()->shortEnglishDayOfWeek;
        $isWeekend = ($dayOfWeek == "Sat" || $dayOfWeek == "Sun");

        return $isWeekend;
    }

    public function filters(Request $request){

    }
}
