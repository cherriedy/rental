<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $CategoryStatus = [
        1 => 'Hiển thị',
        2 => 'Tạm Ẩn'
    ];

    public function getCategoryStatus() {
        return Arr::get($this->CategoryStatus, $this->status, '???');
    }

    public function room() {
        return $this->hasMany(Room::class);
    }
}
