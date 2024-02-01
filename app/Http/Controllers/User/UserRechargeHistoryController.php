<?php

namespace App\Http\Controllers\User;

use Exception;
use Carbon\Carbon;
use Omnipay\Omnipay;
use Illuminate\Http\Request;
use App\Models\RechargeHistory;
use App\Services\Core\VNPayService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserRechargeHistoryController extends Controller
{
    public function index()
    {
        $viewData = RechargeHistory::rechargeSet;

        return view('users.payment.index', $viewData);
    }

    public function internetBankingIndex()
    {
        $viewData = RechargeHistory::rechargeSet;

        return view('users.payment.internet-banking', $viewData);
    }

    public function transferIndex()
    {
        return view('users.payment.tranfer');
    }

    public function redirectRecharge(Request $request, $slug, $id)
    {
        return match (intval($id)) {
            1 => view('users.payment.tranfer'),
            2 => view('users.payment.cash'),
            3 => redirect()->route('recharge.internet-banking'),
            default => abort(404),
        };
    }

    public function internetBankingProcess(Request $request)
    {
        try {
            $params = $request->except('_token');
            $params['user_id'] = Auth::id();
            $params['type'] = 3;
            $params['code'] = generateRandomString(15) . $params['user_id'];
            $params['amount'] = $request['amount_input'];
            $params['total'] = $params['amount'];
            $params['created_at'] = Carbon::now();

            $rechargeHistory = RechargeHistory::create($params);

            $response = $this->createInternetBankingRecharge($rechargeHistory);

            if ($response['code'] == 0) {
                return redirect()->away($response['url']);
            }
        } catch (Exception $exception) {
            Log::error("====================internerBankingProcess: " . $exception->getMessage());
        }
    }

    protected function createInternetBankingRecharge($rechargeHistory)
    {
        $vnpParamConfig = vnpParamConfig();

        $vnp_TmnCode = $vnpParamConfig['vnp_TmnCode'];
        $vnp_HashSecret = $vnpParamConfig['vnp_HashSecret'];
        $vnp_Url = $vnpParamConfig['vnp_Url'];
        $vnp_Returnurl = $vnpParamConfig['vnp_Returnurl'];
        $vnp_Locale = $vnpParamConfig['vnp_Locale'];
        $vnp_OrderType = $vnpParamConfig['vnp_OrderType'];

        $vnp_TxnRef = $rechargeHistory['code'];
        $vnp_Amount = $rechargeHistory['total'] * 100;
        $vnp_OrderInfo = 'Nạp tiền qua VNPay, mã đơn hàng: ' . $rechargeHistory['code'];

        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_OrderType' => $vnp_OrderType,
            'vnp_ReturnUrl' => $vnp_Returnurl,
            'vnp_TxnRef' => $vnp_TxnRef,
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

        $vnp_Url = $vnp_Url . '?' . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = ['code' => '00', 'message' => 'success', 'url' => $vnp_Url];

        return $returnData;
    }
}
