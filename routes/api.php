<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoomApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\LocationApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['prefix' => 'rooms'], function() {
//     Route::get('', [RoomApiController::class, 'index'])->name('api.rooms.index');
//     Route::post('store', [RoomApiController::class, 'store'])->name('api.rooms.store');
// });

// Route::post('register', [UserApiController::class, 'store'])->name('api.users.store');


Route::group(['prefix' => 'location'], function() {
    Route::post('/districts', [LocationApiController::class, 'getDistrict'])->name('api.get.district');
    Route::post('/wards', [LocationApiController::class, 'getWard'])->name('api.get.ward');
    Route::post('/streets', [LocationApiController::class, 'getStreet'])->name('api.get.street');
});
