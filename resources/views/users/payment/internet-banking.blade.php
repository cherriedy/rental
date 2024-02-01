@extends('layouts.layout')

@section('title', 'Nạp tiền bằng internet banking')


@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ Auth::user()->name }}</li>
        <li class="breadcrumb-item">Quản lí</li>
        <li class="breadcrumb-item">Nạp tiền</li>
        <li class="breadcrumb-item active">Thẻ ngân hàng nội địa (ATM Internet Banking)</li>
    </ol>

    <h2>Thẻ ngân hàng nội địa (ATM Internet Banking)</h2>
    <hr>

    <form action="" method="POST">
        @csrf
        <h4>Chọn số tiền cần nạp</h4>
        <small>Chọn nhanh số tiền cần nạp</small>

        @foreach ($priceType as $key => $value)
            <div class="">
                <div class="form-check-inline">
                    <input type="radio" name="amount_radio" id="radio{{ $value }}" value="{{ $value }}"
                        {{ request()->amount_radio ?? 0 ? 'checked' : '' }}>
                    <label for="radio{{ $value }}">{{ number_format($value * 100, 0, '', ',') }} đ</label>
                </div>
            </div>
        @endforeach

        <div class="col-md-4 mt-3">
            <small>Hoặc nhập số tiền cần nạp</small>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Nhập số tiền cần nạp" name="amount_input">
                <div class="input-group-prepend">
                    <div class="input-group-text">vnđ</div>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Nạp tiền</button>
        </div>
    </form>
@endsection
