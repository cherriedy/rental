@extends('layouts.layout')

@section('title', 'Lịch sử thanh toán')

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0" style="margin-bottom: 0;">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadein mb-4">Lịch sử thanh toán</h1>

                <nav aria-label="breadcrumb animated fadein">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('profile') }}">{{ Auth::user()->name }}</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Lịch sử thanh toán</li>
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

    {{-- MAIN CONTENT --}}
    <div class="container-fluid table-responsive">
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
                        <td scope="row">{{ $paymentHistory->created_at }}</td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $paymentHistories->links() }}
        </div>
    </div>
@endsection
