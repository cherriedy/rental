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

    protected $guarded  = [];

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
