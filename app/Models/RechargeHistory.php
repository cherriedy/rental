<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RechargeHistory extends Model
{
    use HasFactory;

    protected $with = ['user:id,name'];

    protected $fillable = [
        'user_id',
        'amount',
        'total',
        'code',
        'type',
    ];

    const STATUS_CANCEL = 0;
    const STATUS_DEFAULT = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_ERROR = -1;

    protected $statusSet = [
        self::STATUS_CANCEL => 'Huỷ',
        self::STATUS_DEFAULT => 'Khởi tạo',
        self::STATUS_SUCCESS => 'Thành công',
        self::STATUS_ERROR => 'Lỗi',
    ];

    const rechargeSet = [
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
    ];

    public function getStatus() {
        return Arr::get($this->statusSet, $this->status);
    }

    public function getType() {
        return Arr::get($this->rechargeSet, $this->status);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
