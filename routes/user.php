<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\User\UserPaymentHistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserRoomController;
use App\Http\Controllers\VnPay\VnPayIPNController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserRechargeHistoryController;
use App\Http\Controllers\VnPay\VnPayReturnController;

/* ROOM */
Route::group(['prefix' => 'rooms', 'as' => 'rooms.', 'middleware' => 'auth'], function () {
    Route::get('', [UserRoomController::class, 'index'])->name('index');

    Route::get('create', [UserRoomController::class, 'create'])->name('create');
    Route::post('store', [UserRoomController::class, 'store'])->name('store');

    Route::group(['prefix' => '{room}'], function () {
        Route::get('edit', [UserRoomController::class, 'edit'])->name('edit');
        Route::put('update', [UserRoomController::class, 'update'])->name('update');

        Route::get('hide', [UserRoomController::class, 'hide'])->name('hide');
        Route::get('active', [UserRoomController::class, 'active'])->name('active');

        Route::get('hot-service', [UserRoomController::class, 'hotServiceIndex'])->name('hot-service');
        Route::post('hot-service', [UserRoomController::class, 'hotServiceStore']);
    });
});

Route::get('{slug}-{room}', [UserRoomController::class, 'show'])
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
    Route::get('', [UserRechargeHistoryController::class, 'index'])->name('index');

    Route::get('{slug}-{id}', [UserRechargeHistoryController::class, 'redirectRecharge'])
        ->where(['slug' => '[a-z-0-9-]+', 'id' => '[0-9]+'])
        ->name('redirect-transfer');

    Route::get('chuyen-khoan', [UserRechargeHistoryController::class, 'tranferIndex'])->name('transfer');
    Route::post('chuyen-khoan', [UserRechargeHistoryController::class, 'transferProcess']);

    Route::group(['prefix' => 'internet-banking'], function () {
        Route::get('internet-banking', [UserRechargeHistoryController::class, 'internetBankingIndex'])->name('internet-banking');
        Route::post('internet-banking', [UserRechargeHistoryController::class, 'internetBankingProcess']);

        Route::group(['as' => 'internet-banking.'], function () {
            Route::get('vnpay_return.php', VnPayReturnController::class)->name('vnpayReturn');
            Route::get('vnpay_ipn.php', VnPayIPNController::class)->name('vnpayIPN');
        });
    });

    Route::get('lich-su-nap-tien', [UserRechargeHistoryController::class, 'rechargeHistory'])->name('history');

    Route::get('refund', [UserRechargeHistoryController::class, 'refundIndex'])->name('refund');
    Route::post('refund', [UserRechargeHistoryController::class, 'refundProcess']);
});

/* PAYMENT */
Route::get('lich-su-thanh-toan', UserPaymentHistoryController::class)->name('payments.history');
