<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request){

        // ユーザー情報を取得
        $user = Auth::user();
    
        // reservation_id を元に既存のレビューを取得
        $review = Review::where('reservation_id', $request->reservation_id)->first();
    
        if ($review) {
            // 既存のレビューがあれば更新
            $review->update([
                'comment' => $request->input('comment'),
                'star' => $request->input('selected_star'),
            ]);
        } else {
            // 既存のレビューがなければ新規登録
            $review = new Review([
                'user_id' => $user->id,
                'reservation_id' => $request->reservation_id,
                'parking_place_id' => $request->parking_place_id,
                'comment' => $request->input('comment'),
                'star' => $request->input('selected_star'),
            ]);
            $review->save();
        }
    
        return redirect()->back();
        
    }

    public function destroy(Request $request){

        $review = Review::where('id', $request->id)->first();

        if ($review) {
            $review->delete();
        }

        return redirect()->back();
        
    }
}
