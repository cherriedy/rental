<?php
use App\Models\Image;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Shared\RoomController;
use App\Http\Controllers\Shared\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLocationController;

Route::get('/', function () { return view('welcome'); });

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
Route::resource('rooms', RoomController::class)->middleware(['auth']);

/* User */
Route::resource('users', UserController::class)->only(['show', 'edit', 'update'])->middleware('auth');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');

/* Image */
Route::group(['prefix' => 'images', 'as' => 'images.', 'middleware' => 'auth'], function() {
    Route::post('', [ImageController::class, 'store'])->name('store');
    Route::delete('', [ImageController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'admins', 'as' => 'admins.', 'middleware' => 'admin'], function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('locations', AdminLocationController::class);
});
