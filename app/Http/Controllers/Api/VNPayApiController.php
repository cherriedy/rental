<?php

namespace App\Http\Controllers\Api;

use Omnipay\Omnipay;
use Illuminate\Http\Request;
use App\Services\Core\VNPayService;
use App\Http\Controllers\Controller;

class VNPayApiController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $vnp_TmnCode = 'SAJ9L8JS';
            $vnp_HashSecret = 'HJNVNBRNMIVILWDEVRAWSAYJTHAKBSHY';

            $gateway = Omnipay::create('VNPay');
            $gateway->initialize([
                'vnp_TmnCode' => 'SAJ9L8JS',
                'vnp_HashSecret' => 'HJNVNBRNMIVILWDEVRAWSAYJTHAKBSHY',
            ]);

            $response = $gateway
                ->purchase([
                    'vnp_TxnRef' => time(),
                    'vnp_OrderType' => 100000,
                    'vnp_OrderInfo' => time(),
                    'vnp_IpAddr' => '127.0.0.1',
                    'vnp_Amount' => 1000000,
                    'vnp_ReturnUrl' => 'https://github.com/phpviet',
                ])
                ->send();

            if ($response->isRedirect()) {
                $redirectUrl = $response->getRedirectUrl();
                // TODO: chuyển khách sang trang VNPay để thanh toán
            }

            $vnp_TxnRef = '12121212121';
            $vnp_OrderInfo = 'Nạp tiền';
            $vnp_OrderType = 'other';
            $vnp_Amount = 150000 * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $vnp_Bill_Mobile = get_data_user('web', 'phone');
            $vnp_Bill_Email = get_data_user('web', 'email');
            $vnp_Bill_Country = 'VN';

            $vnp_Inv_Phone = $vnp_Bill_Mobile;
            $vnp_Inv_Email = $vnp_Bill_Email;
            $vnp_Inv_Customer = 'Võ Thành Tiến';
            $vnp_Inv_Address = 'Đà Nẵng';
            $vnp_Inv_Company = '';
            $vnp_Inv_Taxcode = '0102182292';
            $vnp_Inv_Type = 'I';
            $inputData = [
                'vnp_RequestId' => 12121211,
                'vnp_Version' => '2.1.0',
                'vnp_Command' => 'refund',
                'vnp_TmnCode' => $vnp_TmnCode,
                'vnp_Amount' => $vnp_Amount,
                'vnp_CreateDate' => date('YmdHis'),
                'vnp_CurrCode' => 'VND',
                'vnp_IpAddr' => $vnp_IpAddr,
                'vnp_Locale' => $vnp_Locale,
                'vnp_OrderInfo' => $vnp_OrderInfo,
                'vnp_OrderType' => $vnp_OrderType,
                'vnp_TxnRef' => $vnp_TxnRef,
                'vnp_Bill_Mobile' => $vnp_Bill_Mobile,
                'vnp_Bill_Email' => $vnp_Bill_Email,
                'vnp_Bill_Country' => $vnp_Bill_Country,
                'vnp_Inv_Phone' => $vnp_Inv_Phone,
                'vnp_Inv_Email' => $vnp_Inv_Email,
                'vnp_Inv_Customer' => $vnp_Inv_Customer,
                'vnp_Inv_Address' => $vnp_Inv_Address,
                'vnp_Inv_Company' => $vnp_Inv_Company,
                'vnp_Inv_Taxcode' => $vnp_Inv_Taxcode,
                'vnp_Inv_Type' => $vnp_Inv_Type,
                'vnp_TransactionType' => '02',
            ];

            if (isset($vnp_BankCode) && $vnp_BankCode != '') {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != '') {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            ksort($inputData);
            $query = '';
            $i = 0;
            $hashdata = '';
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . '=' . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . '=' . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . '=' . urlencode($value) . '&';
            }

            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $inputData['vnp_SecureHash'] = $vnpSecureHash;
            }

            $response = VNPayService::getClient()->request(VNPayService::POST, 'merchant_webapi/api/transaction', [
                'json' => $inputData,
            ]);

            return response()->json($response);
        } catch (\Exception $exception) {
        }

        return response()->json($request->all());
    }
}
