<?php

namespace App\Http\Controllers;

use App\Models\ParkingPlace;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ParkingPlaceController extends Controller
{
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

        $formattedPostalCode = preg_replace('/^(\d{3})(\d{4})$/', '$1-$2', $search);

        $parking_places = $this->parking_places
            ->where('city', 'like', '%'.$search.'%')
            ->orwhere('parking_place_name', 'like', '%' . $search . '%')
            ->orwhere('postal_code', $formattedPostalCode)
            ->paginate(9);

        $isTodayHoliday = $this->isTodayHoliday();
        $isTodayWeekend = $this->isTodayWeekend();

        return view('parking_lots.parking_list',
                compact('parking_places', 'search', 'isTodayHoliday', 'isTodayWeekend'));
    }

    public function filterSearch(Request $request){
        $search = $request->input('search');

        $formattedPostalCode = preg_replace('/^(\d{3})(\d{4})$/', '$1-$2', $request->postal_code);

        $date = $request->input('date');
        $fromTime = $request->from_hour . ":" . $request->from_minute;
        $toTime = $request->to_hour . ":" . $request->to_minute;

        $query = ParkingPlace::query();

        if ($request->has('parking_place_name') && $request->parking_place_name) {
            $query->where('parking_place_name', 'like', '%' . $request->parking_place_name . '%');
        }

        if ($request->has('postal_code') && $request->postal_code) {
            $query->where('postal_code', $formattedPostalCode);
        }

        if ($request->has('city') && $request->city) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // if ($request->has('only_open') && $request->only_open == 'open') {
        //     $query->where(function ($query) {
        //         $query->whereDoesntHave('reservations', function ($query) {
        //             $query->whereDate('date', today());
        //         });
        //     });
        // }

        if ($request->has('only_open') && $request->only_open == 'open') {
            $query = $query->get()->filter(function ($parking_place) use ($date, $fromTime, $toTime) {
                return $parking_place->isReservationPossible($date, $fromTime, $toTime);
            });
        } else {
            $query = $query->get();
        }

        // if ($request->has('date')) {
        //     $inputDate = trim($request->date);
        //     Log::info("Input Date: {$inputDate}");

        //     try {
        //         $selectedDate = Carbon::createFromFormat('Y-m-d', $inputDate)->format('Y-m-d');
        //         Log::info("Selected Date: {$selectedDate}");

        //         // Modify the query to filter by selected date
        //         $query->where(function ($query) use ($selectedDate) {
        //             $query->whereDoesntHave('reservations', function ($query) use ($selectedDate) {
        //                 $query->whereDate('date', $selectedDate);
        //             });
        //         });
        //     } catch (\Exception $e) {
        //         Log::error("Error parsing date: {$inputDate}. Error: {$e->getMessage()}");
        //     }
        // }

        $parking_places = $query;

        if ($date && $fromTime && $toTime) {
            $query->where('date', $date)
                    ->where('planning_time_from', '<=', $toTime)
                    ->where('planning_time_to', '>=', $fromTime);
            ;
        }

        $filteredIds = $parking_places->pluck('id');

        $parking_places = $this->parking_places->whereIn('id', $filteredIds)
            ->paginate(9);

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

}
