<div class="container">
    <div class="header clearfix">
        <h3 class="text-muted">VNPAY RESPONSE</h3>
    </div>
    <div class="table-responsive">
        <div class="form-group">
            <label>Mã đơn hàng:</label>

            <label>{{ request('vnp_TxnRef') }}</label>
        </div>
        <div class="form-group">

            <label>Số tiền:</label>
            <label>{{ request('vnp_Amount') }}</label>
        </div>
        <div class="form-group">
            <label>Nội dung thanh toán:</label>
            <label>{{ request('vnp_OrderInfo') }}</label>
        </div>
        <div class="form-group">
            <label>Mã phản hồi (vnp_ResponseCode):</label>
            <label>{{ request('vnp_ResponseCode') }}</label>
        </div>
        <div class="form-group">
            <label>Mã GD Tại VNPAY:</label>
            <label>{{ request('vnp_TransactionNo') }}</label>
        </div>
        <div class="form-group">
            <label>Mã Ngân hàng:</label>
            <label>{{ request('vnp_BankCode') }}</label>
        </div>
        <div class="form-group">
            <label>Thời gian thanh toán:</label>
            <label>{{ request('vnp_PayDate') }}</label>
        </div>
        <div class="form-group">
            <label>Kết quả:</label>
            <label>
                @if ($secureHash == $vnp_SecureHash)
                    @if (request('vnp_ResponseCode') == '00')
                        <span style='color:blue'>GD Thanh cong</span>
                    @else
                        <span style='color:red'>GD Khong thanh cong</span>
                    @endif
                @else
                    <span style='color:red'>Chu ky khong hop le</span>
                @endif

            </label>
        </div>
    </div>
    <p>
         
    </p>
    <footer class="footer">
        <p>© VNPAY {{ date('Y') }}</p>
    </footer>
</div>
