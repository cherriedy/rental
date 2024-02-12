<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS_DEFAULT = 1;
    const STATUS_HIDE = 2;

    public function getCategoryStatus() {
        return Arr::get($this->CategoryStatus, $this->status, '???');
    }

    public function room() {
        return $this->hasMany(Room::class);
    }
}
