<?php

use App\Models\RechargeHistory;

return [
    'method' => [
        1 => [
            'id' => 1,
            'name' => 'Chuyển khoản',
            'avatar' => 'https://phongtro123.com/images/bank-transfer.png',
        ],

        2 => [
            'id' => 2,
            'name' => 'Tiền mặt',
            'avatar' => 'https://phongtro123.com/images/cash.svg',
        ],

        3 => [
            'id' => 3,
            'name' => 'Thanh toán bằng Internet Banking',
            'avatar' => 'https://phongtro123.com/images/payment-method.svg',
        ],
    ],

    'priceType' => [
        1 => 2000,
        2 => 20000,
        3 => 30000,
        4 => 50000,
        5 => 80000,
    ],

    'statusSet' => [
        RechargeHistory::STATUS_CANCEL => 'Huỷ',
        RechargeHistory::STATUS_DEFAULT => 'Khởi tạo',
        RechargeHistory::STATUS_SUCCESS => 'Thành công',
        RechargeHistory::STATUS_ERROR => 'Lỗi',
    ],
];
