<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Room extends Model
{
    use HasFactory;

    protected $with = ['user:id,name,avatar,phone', 'image:id,room_id,path', 'category:id,name', 'city:id,name', 'district:id,name', 'ward:id,name'];

    protected $guarded = [];

    const STATUS_ZERO = 0;
    const STATUS_DEFAULT = 1; // khởi tạo
    const STATUS_PAID = 2; // đã thanh toán
    const STATUS_EXPIRED = -2; // hết hạn
    const STATUS_ACTIVE = 3; // đã duyệt
    const STATUS_CANCEL = -1; // huỷ bỏ
    const STATUS_HIDE = 4; // Tạm ẩn

    const GENDER_ALL = 0;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const SERVICE_ZERO = 0;
    const SERVICE_DEFAULT = 1;
    const SERVICE_H1 = 2;
    const SERVICE_H2 = 3;
    const SERVICE_H3 = 4;
    const SERVICE_SPECIAL = 5;

    public function getHotService($value) {
        return config('room.hotServiceAttribute')[$value];
    }

    public function getBriefDescription(){
        return substr($this->description, 0, 350) . '...';
    }

    public function slug()
    {
        return Str::slug($this->name);
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => config('room.status')[$value]
        );
    }

    protected function subjectId(): Attribute
    {
        return Attribute::make(
            get: fn($value) => config('room.subject')[$value]
        );
    }

    protected function startingDate(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date('d-m-Y', strtotime($value))
        );
    }

    protected function expirationDate(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date('d-m-Y', strtotime($value))
        );
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
