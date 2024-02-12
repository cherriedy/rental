<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Room extends Model
{
    use HasFactory;

    protected $with = ["user:id,name,avatar,phone"];

    protected $guarded = [];

    const STATUS_DEFAULT = 1; // khởi tạo
    const STATUS_PAID = 2; // đã thanh toán
    const STATUS_EXPIRED = -2; //hết hạn
    const STATUS_ACTIVE = 3; // đã duyệt
    const STATUS_CANCEL = -1; // huỷ bỏ
    const STATUS_HIDE = 0; // Ẩn

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

    public function getStatus()
    {
        return Arr::get($this->statusType, $this->status);
    }

    public function getSubject()
    {
        return Arr::get($this->subjectType, $this->subject_id);
    }

    public function gethotService()
    {
        return Arr::get($this->hotServiceType, $this->hot_service);
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
        return $this->belongsTo(Location::class, "city_id");
    }

    public function district()
    {
        return $this->belongsTo(Location::class, "district_id");
    }

    public function ward()
    {
        return $this->belongsTo(Location::class, "ward_id");
    }

    public function street()
    {
        return $this->belongsTo(Location::class, "street_id");
    }

    public function image()
    {
        return $this->hasmany(image::class);
    }
}
