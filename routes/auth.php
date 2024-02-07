<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgetPasswordController;

Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function () {
    Route::group(['prefix' => 'login'], function () {
        Route::get('', [LoginController::class, 'login'])->name('login');
        Route::post('', [LoginController::class, 'authentication']);
    });


    Route::group(['prefix' => 'register'], function () {
        Route::get('', [RegisterController::class, 'register'])->name('register');
        Route::post('', [RegisterController::class, 'store']);
    });

    Route::get('forget-password', [ForgetPasswordController::class, 'forgetPasswordIndex'])->name('forget-password');
    Route::post('forget-password', [ForgetPasswordController::class, 'forgetPasswordProcess']);

    Route::get('get-password/{user}/{token}', [ForgetPasswordController::class, 'getPasswordIndex'])->name('get-password');
    Route::put('get-password/{user}/{token}', [ForgetPasswordController::class, 'getPasswordProcess']);
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
