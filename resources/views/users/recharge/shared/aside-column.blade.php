<div class="card mb-3">
    <div class="card-body">
        <div>Số dư tài khoản</div>
        <h4 class="text-success">{{ number_format(auth()->user()->account_balance, 0, '', '.') }}đ</h4>
    </div>
</div>

<div class="d-grid gap-2">
    <a href="{{ route('recharge.history') }}" class="btn btn-success">
        Lịch sử nạp tiền
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-chevron-right">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </a>

    <a href="{{ route('payments.history') }}" class="btn btn-success">
        Lịch sử thanh toán
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-chevron-right">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </a>
</div>
