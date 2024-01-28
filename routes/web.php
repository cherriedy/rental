<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Models\Image;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Shared\RoomController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Shared\UserProfileController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminUserController;


/* Homepage */
Route::get('/', function () { return view('index'); })->name('index');
Route::group(['namespace' => 'Public'], function () {
    Route::get('chuyen-muc-{slug}-{id}', [HomeController::class, 'category'])
        ->where(['slug' => '[a-z-0-9-]+', 'id' => '[0-9]+'])
        ->name('public.home.category');
});

/* Auth */
Route::group(['namespace' => 'Auth'], function () {
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

/* ADMIN */
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

