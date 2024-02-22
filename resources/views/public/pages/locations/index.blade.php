@extends('layouts.layout')

@section('title', 'Tìm kiếm theo danh mục')

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0">
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
    {{-- @include('shared.search-bar-2') --}}

    {{-- @if (isset($districts) && !$districts->IsEmpty())
        <div class="row">
            <div class="col-md-8">
                <ul class="list-group list-group-horizontal-sm flex-fill">
                    @foreach ($districts as $district)
                        <li class="list-group-item">
                            <a
                                href="{{ route('districts.index', ['district' => $district->id, 'slug' => $district->slug]) }}">
                                {{ $district->name }}</a>
                            <small>{{ $district->roomDistrict->count() }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif --}}

    @include('shared.room-list')
@endsection
