<?php

namespace App\Http\Controllers;

use App\Models\ParkingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


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
        $recommendation = $this->parking_places->get()->map(function ($parking_place) {
            $parking_place->average_star = $parking_place->reviews->avg('star');
            return $parking_place;
        });

        $isTodayHoliday = $this->isTodayHoliday();
        $isTodayWeekend = $this->isTodayWeekend();

        return view('home')
                ->with('recommendation', $recommendation)
                ->with('isTodayHoliday', $isTodayHoliday)
                ->with('isTodayWeekend', $isTodayWeekend);
    }

    public function showReservationForm($id){
        $parking_places = $this->parking_places->findOrFail($id);

        return view('parking_lots.reservation')
            ->with('parking_places', $parking_places);
    }

    public function login(){
        return view('auth.login_to_favorite');
    }

    public function aboutUs(){
        return view('about_us');
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
