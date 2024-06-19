<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        return view('user_info.favorite', ['user' => $user_a])
                ->with('favorites', $favorites);
    }
}
