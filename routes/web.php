<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Shared\RoomController;
use App\Http\Controllers\Api\VNPayApiController;
use App\Http\Controllers\Api\VnPayIPNController;
use App\Http\Controllers\Public\SearchRoomController;
use App\Http\Controllers\Shared\UserProfileController;
use App\Http\Controllers\Shared\UserRechargeController;
use App\Http\Controllers\Public\GetRoomByCategoryController;
use App\Http\Controllers\Public\GetRoomByLocationController;

/* PUBLIC */
Route::get('/', function () {
    return view('public.pages.home.index');
})->name('index');

/* Image */
Route::group(['prefix' => 'images', 'as' => 'images.', 'middleware' => 'auth'], function () {
    Route::post('', [ImageController::class, 'store'])->name('store');
    Route::delete('', [ImageController::class, 'destroy'])->name('destroy');
});

/* PUBLIC -> GET BY LOCATION */
Route::get('tinh-thanh/{slug}-{city}', [GetRoomByLocationController::class, 'city'])
    ->where(['slug' => '[a-z-0-9-]+', 'city' => '[0-9]+'])
    ->name('cities.index');

Route::get('quan-huyen/{slug}-{district}', [GetRoomByLocationController::class, 'district'])
    ->where(['slug' => '[a-z-0-9-]+', 'district' => '[0-9]+'])
    ->name('districts.index');

Route::get('phuong-xa/{slug}-{ward}', [GetRoomByLocationController::class, 'ward'])
    ->where(['slug' => '[a-z-0-9-]+', 'ward' => '[0-9]+'])
    ->name('wards.index');

Route::get('chuyen-muc-{slug}-{category}', [GetRoomByCategoryController::class, 'index'])
    ->where(['slug' => '[a-z-0-9-]+', 'ward' => '[0-9]+'])
    ->name('category.getRoom');

Route::post('search', SearchRoomController::class)->name('search');

/* CHARGE */
Route::group(['prefix' => 'nap-tien', 'as' => 'recharge.', 'middleware' => 'auth'], function () {
    Route::get('', [UserReChargeController::class, 'index'])->name('index');

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
