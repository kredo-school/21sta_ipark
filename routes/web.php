<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParkingPlaceController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReviewController;

# Admin
use App\Http\Controllers\Admin\AdminParkingController;
use App\Http\Controllers\Admin\UsersController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login/favorite', [HomeController::class, 'login'])->name('login_to_favorite');
Route::get('/reservation/{id}', [HomeController::class, 'showReservationForm'])->name('showReservationForm');

// Route::post('/register', [RegisterController::class, 'store'])->name('register');

// Parking places
Route::get('/parking_place/{id}', [ParkingPlaceController::class, 'show'])->name('showParkingDetail');
Route::get('/parking_list', [ParkingPlaceController::class, 'ParkingList'])->name('showParkingList');
Route::get('/parking_list/filtersearch', [ParkingPlaceController::class, 'filterSearch'])->name('filterSearch');

// Favorites
Route::post('/favorite/store/{id}', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('/favorite/destroy/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

// ABOUT US
Route::get('/aboutus', [HomeController::class, 'aboutUs'])->name('aboutUs');

// FAQ
Route::get('/faq',[HomeController::class, 'faq'])->name('faq');

// Reservarion calculate fee
Route::post('/reservation/{id}', [ReservationsController::class, 'create'])->name('reservation.create');

#### Admin Route for Administrator ####
Route::middleware(['auth', 'admin'])->group(function ()
{
    Route::get('/admin', [UsersController::class, 'index'])->name('admin.index');

    // ADMIN(users)
    Route::get('/admin/users', [UsersController::class, 'usersList'])->name('admin.users_list');
    Route::delete('/admin/users/deactivate', [UsersController::class, 'deactivate'])->name('admin.users.deactivate');
    Route::patch('/admin/users/activate', [UsersController::class, 'activate'])->name('admin.users.activate');

    // ADMIN(parking)
    Route::get('/admin/parking', [AdminParkingController::class, 'parkingsList'])->name('admin.parking.parkings_list');
    Route::delete('/admin/parking/deactivate', [AdminParkingController::class, 'deactivate'])->name('admin.parking.deactivate');
    Route::patch('/admin/parking/activate', [AdminParkingController::class, 'activate'])->name('admin.parking.activate');
    Route::get('/admin/register', [AdminParkingController::class, 'index'])->name('admin.parking.index');
    Route::post('/admin/register', [AdminParkingController::class,'store'])->name('admin.parking.store');
    Route::patch('/admin/{id}/update', [AdminParkingController::class, 'updateParking'])->name('admin.parking.update');
    Route::get('admin/parking/{id}/edit', [AdminParkingController::class, 'edit'])->name('admin.parking.edit');
    Route::get('admin/parking/{id}', [AdminParkingController::class, 'show'])->name('admin.parking.show');
});

Route::group(["middleware"=>"auth"], function()
{
    // Profiles
    Route::get('/user_info/{id}/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/user_info/{id}/reservation', [ProfileController::class, 'reservation'])->name('reservation');
    Route::get('/user_info/{id}/favorite', [ProfileController::class, 'favorite'])->name('favorite');
    Route::get('/user_info/{id}/edit', [ProfileController::class, 'edit'])->name('edit_profile');
    Route::patch('/user_info/{id}/updateProfile', [ProfileController::class, 'updateProfile'])->name('update_profile');
    Route::patch('/user_info/{id}/updatePassword', [ProfileController::class, 'updatePassword'])->name('update_password');
    Route::delete('/user_info/{id}/delete', [ProfileController::class, 'delete'])->name('delete_profile');

    // review
    Route::post('/user_info/review/', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/user_info/delete/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

    // Favorites
    Route::post('/favorite/store/{id}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/destroy/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

    //Reservations
    Route::get('/reservation/show/{id}', [ReservationsController::class, 'show'])->name('reservation.show');
    Route::get('/reservation/{id}/cancel', [ReservationsController::class, 'cancel'])->name('reservation.cancel');

    // Payment
    Route::post('/payment', [ReservationsController::class, 'store'])->name('reservation.store');
    Route::get('/payment', [ReservationsController::class, 'payment'])->name('reservation.payment');
    Route::post('/pay/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/pay/success', [PaymentController::class, 'success'])->name('payment.success');

});



