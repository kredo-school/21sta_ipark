<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //
    private $favorite;
    public function __construct(Favorite $favorite){
        $this->favorite = $favorite;
    }

    public function store(Request $request, $id){
        $this->favorite->user_id = Auth::id();
        $this->favorite->parking_place_id = $id;
        $this->favorite->save();

        return response()->json(['status' => 'success', 'action' => 'added']);
    }

    public function destroy($parking_place_id){
        $this->favorite->where('parking_place_id', $parking_place_id)->where('user_id', Auth::id())->delete();

        return response()->json(['status' => 'success', 'action' => 'removed']);
    }
}
