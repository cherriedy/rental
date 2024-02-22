@extends('layouts.layout')

@section('title', 'Lịch sử nạp tiền')

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0" style="margin-bottom: 0;">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadein mb-4">Lịch sử nạp tiền</h1>

                <nav aria-label="breadcrumb animated fadein">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('profile') }}">{{ Auth::user()->name }}</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Lịch sử nạp tiền</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6 animated fadein">
                <img class="img-fluid" src="{{ Vite::asset('resources/images/header.jpg') }}" alt="">
            </div>
        </div>
    </div>

    {{-- BLANK SEARCH BAR --}}
    @include('shared.blank-search-bar')

    <div class="container-fluid table-responsive">
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
                        <td scope="row">{{ number_format($rechargeHistory->amount, 0, '', ',') }}đ</td>
                        <td scope="row">{{ number_format($rechargeHistory->discount, 0, '', ',') }}đ</td>
                        <td scope="row">{{ number_format($rechargeHistory->total, 0, '', ',') }}đ</td>
                        <td scope="row">{{ $rechargeHistory->getStatus() }}</td>
                        <td scope="row">{{ $rechargeHistory->note }}</td>
                        <td scope="row">{{ $rechargeHistory->created_at }}</td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $rechargeHistories->links() }}
        </div>
    </div>
@endsection
