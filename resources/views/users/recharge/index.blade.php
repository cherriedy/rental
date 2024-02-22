@extends('layouts.layout')

@section('title', 'Nạp tiền vào tài khoản')

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0" style="margin-bottom: 0;">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Nạp tiền vào tài khoản</h1>

                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('profile') }}">{{ Auth::user()->name }}</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Nạp tiền vào tài khoản</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="{{ Vite::asset('resources/images/header.jpg') }}" alt="">
            </div>
        </div>
    </div>

    {{-- SEARCH BAR --}}
    @include('shared.blank-search-bar')

    {{-- MAIN CONTENT --}}
    <div class="main-content clearfix">
        <div class="row">
            <div class="col-md-9">
                <div class="d-md-block">
                    <div class="row recharge-method-list">
                        @foreach ($methods as $method)
                            <div class="col-md-4">
                                <div class="recharge-method-item">
                                    <a
                                        href="{{ route('recharge.redirect-transfer', ['id' => $method['id'], 'slug' => Illuminate\Support\Str::slug($method['name'])]) }}">

                                        <div class="method-item-icon">
                                            <img src="{{ $method['avatar'] }}" alt="{{ $method['name'] }}">
                                        </div>

                                        <div class="method-item-name">{{ $method['name'] }}</div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                @include('users.recharge.shared.aside-column')
            </div>
        </div>
    </div>

@endsection
