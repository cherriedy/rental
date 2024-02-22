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
];
