<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS_DEFAULT = 1;
    const STATUS_HIDE = 2;

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => config('category.categoryStatus')[$value]
        );
    }

    public function room() {
        return $this->hasMany(Room::class);
    }
}
