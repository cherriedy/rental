<?php

if (!function_exists('get_data_user')) {
    function get_data_user($type, $field = 'id') {
        return \Auth::guard($type)->user() ? \Auth::gurad($type)->user()->$field : '';
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('vnpParamConfig')) {
    function vnpParamConfig() {
        return [
            'vnp_Url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
            'vnp_Returnurl' => 'http://127.0.0.1:8000/nap-tien/internet-banking/vnpay_return.php',
            'vnp_apiUrl' => 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html',
            'apiUrl' =>'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction',
            'vnp_TmnCode' => 'SAJ9L8JS',
            'vnp_HashSecret' => 'HJNVNBRNMIVILWDEVRAWSAYJTHAKBSHY',
            'vnp_Locale' => 'vn',
            'vnp_OrderType' => 1000,
        ];
    }
}
