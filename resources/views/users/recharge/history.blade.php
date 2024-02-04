@extends('layouts.layout')

@section('title', 'Lịch sử nạp tiền')

@section('content')
    <div class="container table-responsive py-5">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã hoá đơn</th>
                    <th scope="col">Phương thức</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Giảm giá</th>
                    <th scope="col">Thực nhận</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col">Ngày nạp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rechargeHistories ?? [] as $rechargeHistory)
                    <tr>
                        <th scope="row">{{ $rechargeHistory->id }}</th>
                        <td scope="row">{{ $rechargeHistory->code }}</td>
                        @if ($rechargeHistory->type == 1)
                            <td scope="row">Chuyển khoản</td>
                        @elseif ($rechargeHistory->type == 2)
                            <td scope="row">Tiền mặt</td>
                        @else
                            <td scope="row">VnPay</td>
                        @endif
                        <td scope="row">{{ number_format($rechargeHistory->amount, 0, '', ',') }}</td>
                        <td scope="row">{{ number_format($rechargeHistory->discount, 0, '', ',') }}</td>
                        <td scope="row">{{ number_format($rechargeHistory->total, 0, '', ',') }}</td>
                        <td scope="row">{{ $rechargeHistory->getStatus() }}</td>
                        <td scope="row" class="text text-sm">{{ $rechargeHistory->note }}</td>
                        <td scope="row">{{ date('d-m-Y', strtotime($rechargeHistory->created_at)) }}</td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
