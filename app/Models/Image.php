<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // protected $guard = [''];

    protected $fillable = [
        'name',
        'path',
        'post_id',
    ];
}
