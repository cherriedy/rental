<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'starting_time',
        'type',
        'service'
    ];

    const SERVICE_EMAIL = 1;
    const SERVICE_PHONE = 2;

    const TOKEN_REST_PASSWORD = 1;
}
