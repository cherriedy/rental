<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RechargeHistory;
use Illuminate\Http\Request;

class AdminRechargeHistoryController extends Controller
{
    public function index() {
        $rechargeHistories = RechargeHistory::all();
        return view('admin.pages.recharge-histories.index', compact('rechargeHistories'));
    }
}
