<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $LocationType = [
        1 => 'Tỉnh/Thành',
        2 => 'Quận/Huyện',
        3 => 'Phường/Xã',
        4 => 'Đường'
    ];

    protected $LocationStatus = [
        1 => 'Mặc định',
        2 => 'Hot'
    ];

    public function getLocationType() {
        return Arr::get($this->LocationType, $this->type, '???');
    }

    public function getLocationStatus() {
        return Arr::get($this->LocationStatus, $this->status, '???');
    }
}
