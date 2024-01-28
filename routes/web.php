<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Shared\RoomController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Shared\UserProfileController;
use App\Http\Controllers\Public\GetRoomByLocationController;

/* Homepage */
Route::get('/', function () { return view('index'); })->name('index');
Route::group(['namespace' => 'Public'], function () {
    Route::get('chuyen-muc-{slug}-{id}', [HomeController::class, 'category'])
        ->where(['slug' => '[a-z-0-9-]+', 'id' => '[0-9]+'])
        ->name('public.home.category');
});

/* Room */
Route::resource('rooms', RoomController::class)->only('index', 'create', 'edit')->middleware(['auth']);

Route::get('rooms/{slug}-{room}', [RoomController::class, 'show'])
    ->where(['slug' => '[a-z-0-9-]+', 'room' => '[0-9]+'])
    ->name('rooms.show');

Route::get('rooms/{room}/hide', [RoomController::class, 'hide'])->name('rooms.hide');
Route::get('rooms/{room}/active', [RoomController::class, 'active'])->name('rooms.active');

/* User */
Route::resource('users', UserProfileController::class)->only(['show', 'edit', 'update'])->middleware('auth');
Route::get('profile', [UserProfileController::class, 'profile'])->name('profile');

/* Image */
Route::group(['prefix' => 'images', 'as' => 'images.', 'middleware' => 'auth'], function() {
    Route::post('', [ImageController::class, 'store'])->name('store');
    Route::delete('', [ImageController::class, 'destroy'])->name('destroy');
});

/* PUBLIC */
Route::get('cities/{slug}-{city}', [GetRoomByLocationController::class, 'city'])
    ->where(['slug' => '[a-z-0-9-]+', 'city' => '[0-9]+'])
    ->name('cities.index');

Route::get('districts/{slug}-{district}', [GetRoomByLocationController::class, 'district'])
    ->where(['slug' => '[a-z-0-9-]+', 'district' => '[0-9]+'])
    ->name('districts.index');

Route::get('wards/{slug}-{ward}', [GetRoomByLocationController::class, 'ward'])
    ->where(['slug' => '[a-z-0-9-]+', 'ward' => '[0-9]+'])
    ->name('wards.index');
