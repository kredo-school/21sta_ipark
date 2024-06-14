<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// PROFILES
Route::get('/user_info/{id}/profile', [ProfileController::class, 'profile'])->name('profile');
Route::get('/user_info/{id}/reservation', [ProfileController::class, 'reservation'])->name('reservation');
Route::get('/user_info/{id}/favorite', [ProfileController::class, 'favorite'])->name('favorite');


Route::get('/parking_list', [HomeController::class, 'showParkingList'])->name('showParkingList');
Route::get('/parking_place/{id}', [HomeController::class, 'showParkingDetail'])->name('showParkingDetail');
Route::get('/reservation/{id}', [HomeController::class, 'showReservationForm'])->name('showReservationForm');
