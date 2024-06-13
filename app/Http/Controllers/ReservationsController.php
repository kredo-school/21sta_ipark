<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Http\Controllers\ParkingPlacesController;

class ReservationsController extends Controller
{
    private $parkingPlace;

    public function __construct(ParkingPlacesController $parkingPlace)
    {
        $this->parkingPlace = $parkingPlace;
    }
    
    public function index()
    {
        // ユーザー一覧を取得するロジックなどを追加
    }

    public function show($id)
    {
        $all_parking = $this->parkingPlace->findOrFail($id);

        return view('Parking_lots.reservation')->with('all_parking', $all_parking);
    }

    public function create(ReservationRequest $request)
    {
            // バリデーションが通過した場合
            dd($request);
        if ($request->validated()) {

            $reservationResultDate = '26th May Sun';
            
            return redirect()->back()
            ->withInput()
            ->with('reservationResultDate', $reservationResultDate);
        } else {
            return redirect()->back()->withErrors($request)->withInput();
        }
        
    }

    public function store(Request $request)
    {
        // ユーザーを保存するロジックなどを追加
    }

    public function edit($id)
    {
        // ユーザー編集フォームを表示するロジックなどを追加
    }

    public function update(Request $request, $id)
    {
        // ユーザーを更新するロジックなどを追加
    }

    public function destroy($id)
    {
        // ユーザーを削除するロジックなどを追加
    }

}
