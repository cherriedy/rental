<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Shared\RoomController;
use App\Http\Controllers\Shared\UserProfileController;
use App\Http\Controllers\Public\GetRoomByCategoryController;
use App\Http\Controllers\Public\GetRoomByLocationController;
use App\Http\Controllers\Public\SearchRoomController;

/* PUBLIC */
Route::get('/', function () {
    return view('public.pages.home.index');
})->name('index');

Route::group(['prefix' => 'rooms', 'as' => 'rooms.', 'middleware' => 'auth'], function () {
    Route::get('', [RoomController::class, 'index'])->name('index');
    Route::get('create', [RoomController::class, 'create'])->name('create');

    Route::post('store', [RoomController::class, 'store'])->name('store');

    Route::group(['prefix' => '{room}'], function () {
        Route::get('edit', [RoomController::class, 'edit'])->name('edit');
        Route::get('hide', [RoomController::class, 'hide'])->name('hide');
        Route::get('active', [RoomController::class, 'active'])->name('active');

        Route::put('update', [RoomController::class, 'update'])->name('update');
    });

    Route::get('{slug}-{room}', [RoomController::class, 'show'])
        ->where(['slug' => '[a-z-0-9-]+', 'room' => '[0-9]+'])
        ->name('show');
});

/* User */
Route::resource('users', UserProfileController::class)
    ->only(['show', 'edit', 'update'])
    ->middleware('auth');
Route::get('profile', [UserProfileController::class, 'profile'])->name('profile');

/* Image */
Route::group(['prefix' => 'images', 'as' => 'images.', 'middleware' => 'auth'], function () {
    Route::post('', [ImageController::class, 'store'])->name('store');
    Route::delete('', [ImageController::class, 'destroy'])->name('destroy');
});

/* PUBLIC -> GET BY LOCATION */
Route::get('tinh-thanh/{slug}-{city}', [GetRoomByLocationController::class, 'city'])
    ->where(['slug' => '[a-z-0-9-]+', 'city' => '[0-9]+'])
    ->name('cities.index');

Route::get('quan-huyen/{slug}-{district}', [GetRoomByLocationController::class, 'district'])
    ->where(['slug' => '[a-z-0-9-]+', 'district' => '[0-9]+'])
    ->name('districts.index');

Route::get('phuong-xa/{slug}-{ward}', [GetRoomByLocationController::class, 'ward'])
    ->where(['slug' => '[a-z-0-9-]+', 'ward' => '[0-9]+'])
    ->name('wards.index');

Route::get('chuyen-muc-{slug}-{category}', [GetRoomByCategoryController::class, 'index'])
    ->where(['slug' => '[a-z-0-9-]+', 'ward' => '[0-9]+'])
    ->name('category.getRoom');

Route::post('search', SearchRoomController::class)->name('search');
