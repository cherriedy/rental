<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'service_id',
        'type',
        'amount',
        'status',
    ];

    const STATUS_ERROR = 0;
    const STATUS_SUCCESS = 1;

    protected $statusSet = [
        self::STATUS_ERROR => 'Thất bại',
        self::STATUS_SUCCESS => 'Thành công'
    ];

    public function getStatus() {
        return Arr::get($this->statusSet, $this->status);
    }
}
