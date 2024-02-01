<?php

namespace App\Http\Controllers\VnPay;

use Exception;
use Illuminate\Http\Request;
use App\Models\RechargeHistory;
use App\Http\Controllers\Controller;

class VnPayIPNController extends Controller
{
    public function __invoke()
    {
        $vnpParamConfig = vnpParamConfig();

        $vnp_TmnCode = $vnpParamConfig['vnp_TmnCode'];
        $vnp_HashSecret = $vnpParamConfig['vnp_HashSecret'];
        $vnp_Url = $vnpParamConfig['vnp_Url'];
        $vnp_Returnurl = $vnpParamConfig['vnp_Returnurl'];
        $vnp_apiUrl = $vnpParamConfig['vnp_apiUrl'];
        $apiUrl = $vnpParamConfig['apiUrl'];
        $startTime = date('YmdHis');
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $inputData = [];
        $returnData = [];

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == 'vnp_') {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
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
        $vnpTranId = $inputData['vnp_TransactionNo'];
        $vnp_BankCode = $inputData['vnp_BankCode'];
        $vnp_Amount = $inputData['vnp_Amount'] / 100;

        $Status = 0;
        $orderId = $inputData['vnp_TxnRef'];

        try {
            if ($secureHash == $vnp_SecureHash) {
                $rechargeData = null;

                $rechargeCode = $inputData['vnp_TxnRef'];
                $rechargeData = RechargeHistory::where('code', $rechargeCode)->get();

                if ($rechargeData != null) {
                    if ($rechargeData['total'] == $vnp_Amount) {
                        if ($rechargeData['status'] != null && $rechargeData['status'] == RechargeHistory::STATUS_DEFAULT) {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $rechargeData['status'] = RechargeHistory::STATUS_SUCCESS;
                            } else {
                                $rechargeData['status'] = RechargeHistory::STATUS_ERROR;
                            }

                            $rechargeData->save();

                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);
    }
}
