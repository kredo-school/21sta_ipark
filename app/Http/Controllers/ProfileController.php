<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ReservationsController;

use App\Models\User;
use App\Models\ParkingPlace;
use App\Models\Reservation;
use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $user;
    private $parkingPlace;
    private $reservation;
    private $review;

    public function __construct(User $user,ParkingPlace $parkingPlace, Reservation $reservation,Review $review)
    {
        $this->user = $user;
        $this->parkingPlace = $parkingPlace;
        $this->reservation = $reservation;
        $this->review = $review;
    }

    public function profile($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view('user_info.profile', ['user' => $user_a]);
    }

    public function reservation($id)
    {

        $user_a = $this->user->findOrFail($id);
        $reservations = $user_a->reservation()
                                ->with('ParkingPlace')
                                ->withTrashed()
                                ->orderBy('date', 'desc')
                                ->get();

        $reservationController = new ReservationsController($this->parkingPlace,$this->reservation);
        $now = \Carbon\Carbon::now()->setTimezone('Asia/Tokyo');

        $review = [];
        $tempReservations = [];
        $future_reservations = [];
        $past_reservations = [];
    
        foreach ($reservations as $reservation) {



            $reservation_datetime = \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->planning_time_from, 'Asia/Tokyo');

            if ($reservation_datetime > $now && is_null($reservation->deleted_at)) {
                // 現在時刻が終了時間より前なら未来の予約
                $future_reservations[] = $reservation;
            } else {
                // 現在時刻が終了時間より後なら過去の予約

                if (\Carbon\Carbon::parse($reservation->date . ' ' . $reservation->planning_time_to, 'Asia/Tokyo') >= $now) {
                    $reservation->is_current = true; // 現在進行中の予約フラグ
                } else {
                    $reservation->is_current = false;
                }

                $past_reservations[] = $reservation;

                $reviewItem = $this->review->where('reservation_id', $reservation->id)->first();
                if (!$reviewItem) {
                    $reviewItem = new Review();
                    $reviewItem->reservation_id = "";
                    $reviewItem->star = 0;
                    $reviewItem->comment = "";
                }
                $review[] = $reviewItem;
            }
        }

        return view('user_info.reservation', [
            'user' => $user_a,
            'future_reservations' => $future_reservations,
            'past_reservations' => $past_reservations,
            'review' => $review
        ]);
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

    public function edit($id){
        $user = $this->user->findOrFail($id);

        return view('user_info.update_profile')->with('user', $user);
    }

    public function updateProfile($id, Request $request){
        $user = $this->user->findOrFail($id);

        $user->update($request->all());

        return redirect()->route('profile', $user->id);
    }

    public function updatePassword($id, Request $request){
        $user = $this->user->findOrFail($id);

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'old_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'The new password must be at least 8 characters long.',
            'new_password.confirmed' => 'The new password and confirmation password do not match.'
        ]);

        if (!Hash::check($request->input('old_password'), $user->password)){
            return back()->withErrors(['old_password' => 'Your current password is incorrect.']);
        }

        if($request->new_password == $request->old_password){
            return back()->withErrors(['new_password' => 'New password cannot be the same as current password']);
        }

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('success_message', 'Password updated successfully.');
    }

    public function delete($id){
        $user = $this->user->findOrFail($id);
        $user->delete();

        return redirect()->route('home');
    }
}
