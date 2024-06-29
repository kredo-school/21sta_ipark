<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function profile($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view('user_info.profile', ['user' => $user_a]);
    }

    public function reservation($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view('user_info.reservation', ['user' => $user_a]);
    }

    public function favorite($id){
        $user_a = $this->user->findOrFail($id);
        $favorites = $user_a->favorites->all();

        $isTodayHoliday = $this->isTodayHoliday();
        $isTodayWeekend = $this->isTodayWeekend();

        return view('user_info.favorite', ['user' => $user_a])
                ->with('favorites', $favorites)
                ->with('isTodayHoliday', $isTodayHoliday)
                ->with('isTodayWeekend', $isTodayWeekend);
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
