<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::group(['prefix' => 'admins', 'as' => 'admins.', 'middleware' => 'admin'], function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'locations', 'as' => 'locations.'], function() {
        Route::get('', [AdminLocationController::class, 'index'])->name('index');

        Route::get('create', [AdminLocationController::class, 'create'])->name('create');
        Route::post('create', [AdminLocationController::class, 'store']);

        Route::get('{location}/update', [AdminLocationController::class, 'edit'])->name('update');
        Route::post('{location}/update', [AdminLocationController::class, 'update']);

        Route::get('{location}/delete', [AdminLocationController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {
        Route::get('', [AdminCategoryController::class, 'index'])->name('index');

        Route::get('create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('create', [AdminCategoryController::class, 'store']);

        Route::get('{category}/update', [AdminCategoryController::class, 'edit'])->name('update');
        Route::post('{category}/update', [AdminCategoryController::class, 'update']);

        Route::get('{category}/delete', [AdminCategoryController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
        Route::get('', [AdminUserController::class, 'index'])->name('index');

        Route::get('create', [AdminUserController::class, 'create'])->name('create');
        Route::post('create', [AdminUserController::class, 'store']);

        Route::get('{user}/update', [AdminUserController::class, 'edit'])->name('update');
        Route::post('{user}/update', [AdminUserController::class, 'update']);

        Route::get('{user}/delete', [AdminUserController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'rooms', 'as' => 'rooms.'], function() {
        Route::get('', [AdminRoomController::class, 'index'])->name('index');
    });
});
