<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParkingPlaceController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login/favorite', [HomeController::class, 'login'])->name('login_to_favorite');

Route::get('/reservation/{id}', [HomeController::class, 'showReservationForm'])->name('showReservationForm');

// PROFILES
Route::get('/user_info/{id}/profile', [ProfileController::class, 'profile'])->name('profile');
Route::get('/user_info/{id}/reservation', [ProfileController::class, 'reservation'])->name('reservation');
Route::get('/user_info/{id}/favorite', [ProfileController::class, 'favorite'])->name('favorite');

// Parking places
Route::get('/parking_place/{id}', [ParkingPlaceController::class, 'show'])->name('showParkingDetail');
Route::get('/parking_list', [ParkingPlaceController::class, 'ParkingList'])->name('showParkingList');

// Favorites
Route::post('/favorite/store/{id}', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('/favorite/destroy/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
