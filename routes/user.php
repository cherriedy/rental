<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shared\RoomController;
use App\Http\Controllers\Api\VNPayApiController;
use App\Http\Controllers\Api\VnPayIPNController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserRechargeController;

/* ROOM */
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
});

Route::get('{slug}-{room}', [RoomController::class, 'show'])
    ->where(['slug' => '[a-z-0-9-]+', 'room' => '[0-9]+'])
    ->name('rooms.show');

/* USER */
Route::get('profile', [UserProfileController::class, 'profile'])->name('profile');
Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth'], function () {
    Route::get('show', [UserProfileController::class, 'show'])->name('show');

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('edit', [UserProfileController::class, 'edit'])->name('edit');
        Route::put('update', [UserProfileController::class, 'update'])->name('update');
    });
});

/* RECHAGRE */
Route::group(['prefix' => 'nap-tien', 'as' => 'recharge.', 'middleware' => 'auth'], function () {
    Route::get('', [UserRechargeController::class, 'index'])->name('index');

    Route::get('{slug}-{id}', [UserRechargeController::class, 'redirectRecharge'])
        ->where(['slug' => '[a-z-0-9-]+', 'id' => '[0-9]+'])
        ->name('redirect-transfer');

    Route::get('chuyen-khoan', [UserRechargeController::class, 'tranferIndex'])->name('transfer');
    Route::post('chuyen-khoan', [UserRechargeController::class, 'transferProcess']);

    Route::group(['prefix' => 'internet-banking'], function () {
        Route::get('internet-banking', [UserRechargeController::class, 'internetBankingIndex'])->name('internet-banking');
        Route::post('internet-banking', [UserRechargeController::class, 'internetBankingProcess']);

        Route::group(['as' => 'internet-banking.'], function () {
            Route::get('vnpay_return.php', VNPayApiController::class)->name('vnpayReturn');
            Route::get('vnpay_ipn.php', VnPayIPNController::class)->name('vnpayIPN');
        });
    });

    Route::get('refund', [UserRechargeController::class, 'refundIndex'])->name('refund');
    Route::post('refund', [UserRechargeController::class, 'refundProcess']);
});
