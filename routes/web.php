<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/parking_list', [HomeController::class, 'showParkingList'])->name('showParkingList');
Route::get('/parking_place/{id}', [HomeController::class, 'showParkingDetail'])->name('showParkingDetail');
Route::get('/reservation/{id}', [HomeController::class, 'showReservationForm'])->name('showReservationForm');

//Reservations routes
// Route::get('/reservation/show/{id}', [App\Http\Controllers\ReservationsController::class, 'show'])->name('reservation.show');
Route::post('/reservation/create/{id}', [App\Http\Controllers\ReservationsController::class, 'create'])->name('reservation.create');