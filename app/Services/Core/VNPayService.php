<?php

namespace App\Services\Core;

use GuzzleHttp\Client;

class VNPayService
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    public static function getClient()
    {
        return new Client([
            'base_uri' => 'https://sandbox.vnpayment.vn/',
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
