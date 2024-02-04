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

    // protected $guraded = [''];
    protected $fillable = ['user_id', 'city_id', 'district_id', 'ward_id', 'street_id', 'apartment_number', 'category_id', 'title', 'description', 'price', 'area', 'user_id', 'slug', 'exact_address', 'expiration_date', 'updated_at', 'created_at', 'price_range', 'area_range', 'status', 'cancel_reason'];

    protected $with = ['user:id,name,avatar,phone'];

    // const STATUS_ACTIVE = 1;        // Hoạt Động
    // const STATUS_EXPRIED = -1;      // Hết Hạn
    // const STATUS_CANCEL = 0;        // Huỷ
    // const STATUS_HIDE = 2;           // Ẩn

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

    protected $statusType = [
        self::STATUS_DEFAULT => 'Khởi tạo',
        self::STATUS_PAID => 'Đã thanh toán',
        self::STATUS_EXPIRED => 'Hết hạn',
        self::STATUS_ACTIVE => 'Hoạt động',
        self::STATUS_CANCEL => 'Đã huỷ',
        // self::STATUS_HIDE => 'Tạm ẩn',
    ];

    protected $subjectType = [
        self::GENDER_ALL => 'Tất cả',
        self::GENDER_MALE => 'Nam',
        self::GENDER_FEMALE => 'Nữ',
    ];

    protected $hotServiceType = [
        self::SERVICE_DEFAULT => 'Dịch vụ mặc định',
        self::SERVICE_H1 => 'Dịch vụ HOT1',
        self::SERVICE_H2 => 'Dịch vụ HOT2',
        self::SERVICE_H3 => 'Dịch vụ HOT3',
        self::SERVICE_SPECIAL => 'Dịch vụ đặc biệt nổi bật',
    ];

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
        return Arr::get($this->hotSeriveType, $this->hot_serivce);
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
}
