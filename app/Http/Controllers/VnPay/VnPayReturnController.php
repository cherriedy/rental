<?php

namespace App\Http\Controllers\VnPay;

use Omnipay\Omnipay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RechargeHistory;

class VnPayReturnController extends Controller
{
    public function __invoke(Request $request)
    {
        $vnpParamConfig = vnpParamConfig();

        $vnp_TmnCode = $vnpParamConfig['vnp_TmnCode'];
        $vnp_HashSecret = $vnpParamConfig['vnp_HashSecret'];
        $vnp_Url = $vnpParamConfig['vnp_Url'];
        $vnp_Returnurl = $vnpParamConfig['vnp_Returnurl'];
        $vnp_apiUrl = $vnpParamConfig['vnp_apiUrl'];
        $apiUrl = $vnpParamConfig['apiUrl'];

        $vnp_SecureHash = $_GET['vnp_SecureHash'];

        $startTime = date('YmdHis');
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $inputData = [];
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == 'vnp_') {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = '';
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $rechargeCode = $inputData['vnp_TxnRef'];
                $rechargeData = RechargeHistory::where('code', $rechargeCode)->get();

                return view('users.payment.success', compact('rechargeData', 'vnp_HashSecret', 'secureHash', 'vnp_SecureHash'));
            } else {
                return view('users.payment.success', compact('vnp_HashSecret', 'secureHash', 'vnp_SecureHash'));
            }
        } else {
            echo 'Chu ky khong hop le';
        }
    }
}
