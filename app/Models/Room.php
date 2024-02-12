<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $with = ['user:id,name,avatar,phone'];

    protected $guarded = [];

    const STATUS_DEFAULT = 1; // khởi tạo
    const STATUS_PAID = 2; // đã thanh toán
    const STATUS_EXPIRED = -2; // hết hạn
    const STATUS_ACTIVE = 3; // đã duyệt
    const STATUS_CANCEL = -1; // huỷ bỏ

    const GENDER_ALL = 0;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const SERVICE_DEFAULT = 1;
    const SERVICE_H1 = 2;
    const SERVICE_H2 = 3;
    const SERVICE_H3 = 4;
    const SERVICE_SPECIAL = 5;

    public function slug()
    {
        return Str::slug($this->name);
    }

    protected function getStatusAttribute(): Attribute
    {
        return Attribute::make(get: fn($value) => config('room.status')[$value]);
    }

    protected function getSubjectAttribute(): Attribute
    {
        return Attribute::make(get: fn($value) => config('room.subject')[$value]);
    }

    protected function getHotServiceAttribute(): Attribute
    {
        return Attribute::make(get: fn($value) => config('room.hot_service')[$value]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(Location::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(Location::class, 'district_id');
    }

    public function ward()
    {
        return $this->belongsTo(Location::class, 'ward_id');
    }

    public function street()
    {
        return $this->belongsTo(Location::class, 'street_id');
    }

    public function image()
    {
        return $this->hasmany(image::class);
    }
}
