@extends('layouts.layout')

@section('title', 'Tìm kiếm theo danh mục')

@section('content')
    {{-- HEADER --}}
    <div class="container-flui header d bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">{{ $location->title }}</h1>

                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item text-body" aria-current="page">Trang chủ</li>
                        <li class="breadcrumb-item text-body active" aria-current="page"><a
                                href="{{ route('cities.index', ['city' => $location->id, 'slug' => $location->slug]) }}">{{ $location->name }}</a>
                        </li>
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
