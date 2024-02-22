{{-- @extends('errors.layouts')

@section('code', '404')
@section('title', __('Page Not Found'))

@section('image')
    <div style="background-image: url(https://img.freepik.com/premium-photo/anime-girl-with-question-mark-her-face-generative-ai_958124-30566.jpg);" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Xin lỗi, trang bạn đang truy cập không được tìm thấy.')) --}}
@extends('layouts.layout')

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0" style="margin-bottom: 0;">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Lỗi 404</h1>
                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">404 Error</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="{{ Vite::asset('resources/images/header.jpg') }}" alt="">
            </div>
        </div>
    </div>

    {{-- BLANK SEARCH BAR --}}
    @include('shared.blank-search-bar')

    {{-- MAIN CONTENT --}}
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                    <h1 class="display-1">404</h1>
                    <h1 class="mb-4">Không tìm thấy</h1>
                    <p class="mb-4">Xin lỗi, trang bạn đang truy cập không được tìm thấy.</p>
                    <a class="btn btn-primary py-3 px-5" href="">Về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
