<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function () {
    Route::group(['prefix' => 'login'], function () {
        Route::get('', [LoginController::class, 'login'])->name('login');
        Route::post('', [LoginController::class, 'authentication']);
    });

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'register'], function () {
        Route::get('', [RegisterController::class, 'register'])->name('register');
        Route::post('', [RegisterController::class, 'store']);
    });
});
