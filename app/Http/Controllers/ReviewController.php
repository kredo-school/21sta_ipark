<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;

class ReviewController extends Controller
{
    private $review;
    private $user;
    
    public function __construct(User $user,Review $review)
    {
        $this->review = $review;
        $this->user = $user;
    }

    public function review(Request $request){
        //dd($id);
        //$review = $this->review->findOrFail($id);
        $user_a = $this->user->findOrFail($request->userId);


        return view('user_info.reservation', ['user' => $user_a])
                ->with('favorites', 'a');
    }
}
