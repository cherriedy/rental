<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserPaymentHistoryController extends Controller
{
    public function __invoke()
    {
        $paymentHistories = PaymentHistory::where('user_id', Auth::id())
            ->orderByDesc('id')
            ->paginate(15);

        return view('users.payment.index', compact('paymentHistories'));
    }
}
