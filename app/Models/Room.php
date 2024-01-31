<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'city_id', 'district_id', 'ward_id', 'street_id', 'apartment_number', 'category_id', 'title', 'description', 'price', 'area', 'user_id', 'slug', 'exact_address', 'expiration_date', 'updated_at', 'created_at', 'price_range', 'area_range'];
    // protected $guraded = [''];

    protected $with = ['user:id,name,avatar,phone'];

    const STATUS_ACTIVE = 1;        // Hoạt Động
    const STATUS_EXPRIED = -1;      // Hết Hạn
    const STATUS_CANCEL = 0;        // Huỷ
    const STATUS_HIDE = 2;           // Ẩn

    protected $statusType = [
        self::STATUS_ACTIVE => 'Hoạt động',
        self::STATUS_EXPRIED => 'Hết hạn',
        self::STATUS_CANCEL => 'Đã huỷ',
        self::STATUS_HIDE => 'Tạm ẩn',
    ];

    protected $subjectType = [
        0 => 'Tất cả',
        1 => 'Nam',
        2 => 'Nữ',
    ];

    public function slug() {
        return Str::slug($this->name);
    }

    public function getStatus() {
        return Arr::get($this->statusType, $this->status);
    }

    public function getSubject() {
        return Arr::get($this->subjectType, $this->subject_id);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function city() {
        return $this->belongsTo(Location::class, 'city_id');
    }

    public function district() {
        return $this->belongsTo(Location::class, 'district_id');
    }

    public function ward() {
        return $this->belongsTo(Location::class, 'ward_id');
    }

    public function street() {
        return $this->belongsTo(Location::class, 'street_id');
    }


}
