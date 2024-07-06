<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParkingPlaceController;
use App\Http\Controllers\FavoriteController;

# Admin Users
use App\Http\Controllers\Admin\AdminParkingController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login/favorite', [HomeController::class, 'login'])->name('login_to_favorite');

Route::get('/reservation/{id}', [HomeController::class, 'showReservationForm'])->name('showReservationForm');

// Parking places
Route::get('/parking_place/{id}', [ParkingPlaceController::class, 'show'])->name('showParkingDetail');
Route::get('/parking_list', [ParkingPlaceController::class, 'ParkingList'])->name('showParkingList');

// Favorites
Route::post('/favorite/store/{id}', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('/favorite/destroy/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

// ABOUT US
Route::get('/aboutus', [HomeController::class, 'aboutUs'])->name('aboutUs');

#### Admin Route for Administrator ####
Route::middleware(['auth', 'admin'])->group(function ()
{
    Route::get('/admin', [UsersController::class, 'index'])->name('admin.index');
    Route::get('/admin', [UsersController::class, 'UpdateParking'])->name('admin.update_parking');

    // ADMIN(users)
    Route::get('/admin/users', [UsersController::class, 'usersList'])->name('admin.users_list');
    Route::delete('/admin/users/deactivate', [UsersController::class, 'deactivate'])->name('admin.users.deactivate');
    Route::patch('/admin/users/activate', [UsersController::class, 'activate'])->name('admin.users.activate');

    // ADMIN(parking)
    Route::get('/admin/parking', [AdminParkingController::class, 'parkingsList'])->name('admin.parking.parkings_list');
    Route::get('/admin/register', [AdminParkingController::class, 'index'])->name('admin.parking.index');
    Route::post('/admin/register', [AdminParkingController::class,'store'])->name('admin.parking.store');
    Route::delete('/admin/parking/deactivate', [AdminParkingController::class, 'deactivate'])->name('admin.parking.deactivate');
    Route::patch('/admin/parking/activate/{id}', [AdminParkingController::class, 'activate'])->name('admin.parking.activate');
    Route::get('/admin/parking/search', [AdminParkingController::class, 'search'])->name('admin.parking.search');
    Route::post('/admin/parking/search', [AdminParkingController::class, 'search'])->name('admin.parking.search');
});

Route::group(["middleware"=>"auth"], function()
{
    // Profiles
    Route::get('/user_info/{id}/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/user_info/{id}/reservation', [ProfileController::class, 'reservation'])->name('reservation');
    Route::get('/user_info/{id}/favorite', [ProfileController::class, 'favorite'])->name('favorite');

    // Favorites
    Route::post('/favorite/store/{id}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/destroy/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');


    //Reservations
    Route::get('/reservation/show/{id}', [ReservationsController::class, 'show'])->name('reservation.show');
    Route::post('/reservation/{id}', [ReservationsController::class, 'create'])->name('reservation.create');

    // Payment
    Route::post('/payment', [ReservationsController::class, 'store'])->name('reservation.store');
    Route::get('/payment', [ReservationsController::class, 'payment'])->name('reservation.payment');
    Route::post('/pay/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/pay/success', [PaymentController::class, 'success'])->name('payment.success');

});


