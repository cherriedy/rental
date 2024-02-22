<?php

use App\Models\Room;

return [
    'status' => [
        Room::STATUS_ZERO => '??',
        Room::STATUS_DEFAULT => 'Khởi tạo',
        Room::STATUS_PAID => 'Đã thanh toán',
        Room::STATUS_EXPIRED => 'Hết hạn',
        Room::STATUS_ACTIVE => 'Hoạt động',
        Room::STATUS_CANCEL => 'Đã huỷ',
        Room::STATUS_HIDE => 'Tạm ẩn',
    ],

    'subject' => [
        Room::GENDER_ALL => 'Tất cả',
        Room::GENDER_MALE => 'Nam',
        Room::GENDER_FEMALE => 'Nữ',
    ],

    'hot_service' => [
        Room::SERVICE_ZERO => 'Chưa có dịch vụ',
        Room::SERVICE_DEFAULT => 'Dịch vụ mặc định',
        Room::SERVICE_H1 => 'Dịch vụ HOT1',
        Room::SERVICE_H2 => 'Dịch vụ HOT2',
        Room::SERVICE_H3 => 'Dịch vụ HOT3',
        Room::SERVICE_SPECIAL => 'Dịch vụ đặc biệt nổi bật',
    ],

    'hotServiceAttribute' => [
        Room::SERVICE_ZERO => [
            'name' => 'Chưa có dịch vụ',
            'class' => '',
            'color' => '',
        ],
        Room::SERVICE_DEFAULT => [
            'name' => 'Dịch vụ mặc định',
            'class' => 'goitin__macdinh',
            'color' => '#00B98E',
        ],
        Room::SERVICE_H1 => [
            'name' => 'Dịch vụ HOT1',
            'class' => 'goitin__h1',
            'color' => '#FF6922',
        ],
        Room::SERVICE_H2 => [
            'name' => 'Dịch vụ HOT2',
            'class' => 'goitin__h2',
            'color' => '#ea2e9d',
        ],
        Room::SERVICE_H3 => [
            'name' => 'Dịch vụ HOT3',
            'class' => 'goitin__h3',
            'color' => '#055699',
        ],
        Room::SERVICE_SPECIAL => [
            'name' => 'Dịch vụ nổi bật',
            'class' => 'goitin__noibat',
            'color' => '#E13427',
        ],
    ],
];
