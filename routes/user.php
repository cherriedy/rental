<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shared\RoomController;
use App\Http\Controllers\Shared\UserProfileController;

Route::group(['prefix' => 'general'], function () {
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
});

Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth'], function () {
    Route::get('show', [UserProfileController::class, 'show'])->name('show');

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function() {
        Route::get('edit', [UserProfileController::class, 'edit'])->name('edit');
        Route::put('update', [UserProfileController::class, 'update'])->name('update');
    });
});
Route::get('profile', [UserProfileController::class, 'profile'])->name('profile');
