@extends('layouts.layout')

@section('title', 'Tìm kiếm theo danh mục')

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">{{ $category->name }}</h1>
                {{-- <small>{{ $category->title }}</small>
                <small>{{ $category->description }}</small> --}}

                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="">Danh mục</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="{{ Vite::asset('resources/images/header.jpg') }}" alt="">
            </div>
        </div>
    </div>

    {{-- SEARCH BAR --}}
    @include('shared.search-bar-2')

    {{-- MAIN CONTENT --}}
    <div class="main-content clearfix">
        @include('shared.room-list')
    </div>
@endsection
