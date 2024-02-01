@extends('layouts.layout')

@section('title', 'Nạp tiền vào tài khoản')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ Auth::user()->name }}</li>
        <li class="breadcrumb-item">Quản lý</li>
        <li class="breadcrumb-item active">Nạp tiền</li>
    </ol>

    <h3 class="h3">Nạp tiền vào tài khoản</h3>
    <hr>

    <div class="row">
        <div class="col-md-8">
            <h4 class="mt-3">Mời bạn chọn phương thức nạp tiền</h4>
            <div class="method-container">
                @foreach ($method as $item)
                    <div class="method-card">
                        <a href="{{ route('recharge.redirect-transfer', ['slug' => Illuminate\Support\Str::slug($item['name']), 'id' => $item['id']]) }}">
                            <div class="method-avatar">
                                <img src="{{ $item['avatar'] }}" alt="method-avatar">
                            </div>

                            <div class="method-name">{{ $item['name'] }}</div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
