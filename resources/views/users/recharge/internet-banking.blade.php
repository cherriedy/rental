@extends('layouts.layout')

@section('title', 'Nạp tiền bằng internet banking')


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

    {{-- MAIN CONTENT --}}
    <div class="main-content">
        <div class="row">


            <div class="col-md-9">
                <h3 class="mb-4">Chọn số tiền cần nạp</h3>

                <form action="" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Nhập số tiền cần nạp"
                                name="amount_input" min="10000">
                            <div class="input-group-prepend">
                                <div class="input-group-text">vnđ</div>
                            </div>
                        </div>

                        <small class="d-block mt-2">Số tiền không bé hơn 10.000đ</small>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-md btn-success">Nạp tiền</button>
                    </div>
                </form>

                <div class="alert alert-danger mt-5">
                    <p>Lưu ý quan trọng: Trong quá trình thanh toán, bạn vui lòng <strong>KHÔNG ĐÓNG TRÌNH DUYỆT</strong>.
                    </p>
                    <p>Nếu gặp khó khăn trong quá trình thanh toán, xin liên hệ <strong>0917686101</strong> để chúng tôi hỗ
                        trợ
                        bạn.</p>
                </div>
            </div>

            <div class="col-md-3">
                @include('users.recharge.shared.aside-column')
            </div>
        </div>
    </div>
@endsection
