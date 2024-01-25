<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'city_id', 'district_id', 'ward_id', 'street_id', 'apartment_number', 'category_id', 'title', 'description', 'price', 'area', 'user_id', 'slug', 'exact_address', 'expiration_date', 'updated_at', 'created_at'];

    public function slug()
    {
        return Str::slug($this->name);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
