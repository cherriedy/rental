@extends('layouts.layout')

@section('title', 'Lịch sử thanh toán')

@section('content')
    <div class="container table-responsive py-5">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Loại dịch vụ</th>
                    <th scope="col">Mã phòng</th>
                    <th scope="col">Phí</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày nạp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paymentHistories ?? [] as $paymentHistory)
                    <tr>
                        <td scope="row">Dịch vụ nổi bật</td>
                        <td scope="row">{{ $paymentHistory->room_id }}</td>
                        <td scope="row">{{ number_format($paymentHistory->amount, 0, '', ',') }}</td>
                        <td scope="row">{{ $paymentHistory->getStatus() }}</td>
                        <td scope="row">{{ date('d-m-Y', strtotime($paymentHistory->created_at)) }}</td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
