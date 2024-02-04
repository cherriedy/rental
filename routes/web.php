<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemporaryImageController;
use App\Http\Controllers\Public\SearchRoomController;
use App\Http\Controllers\Public\GetRoomByCategoryController;
use App\Http\Controllers\Public\GetRoomByLocationController;

/* HOMEPAGE */
Route::get('/', function () { return view('public.pages.home.index'); })->name('index');

/* TEMPORARY IMAGE */
Route::group(['prefix' => 'images', 'as' => 'images.', 'middleware' => 'auth'], function () {
    Route::post('', [TemporaryImageController::class, 'store'])->name('store');
    Route::delete('', [TemporaryImageController::class, 'destroy'])->name('destroy');
});

/* ROOM BY LOCATION */
Route::get('tinh-thanh/{slug}-{city}', [GetRoomByLocationController::class, 'city'])
    ->where(['slug' => '[a-z-0-9-]+', 'city' => '[0-9]+'])
    ->name('cities.index');

Route::get('quan-huyen/{slug}-{district}', [GetRoomByLocationController::class, 'district'])
    ->where(['slug' => '[a-z-0-9-]+', 'district' => '[0-9]+'])
    ->name('districts.index');

Route::get('phuong-xa/{slug}-{ward}', [GetRoomByLocationController::class, 'ward'])
    ->where(['slug' => '[a-z-0-9-]+', 'ward' => '[0-9]+'])
    ->name('wards.index');

/* ROOM BY CATEGORY */
Route::get('chuyen-muc-{slug}-{category}', [GetRoomByCategoryController::class, 'index'])
    ->where(['slug' => '[a-z-0-9-]+', 'ward' => '[0-9]+'])
    ->name('category.getRoom');

/* SEARCH */
Route::post('search', SearchRoomController::class)->name('search');
