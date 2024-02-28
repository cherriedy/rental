@extends('layouts.layout')

@section('title', 'Trang cá nhân của ' . $user->name)

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Trang cá nhân</h1>

                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('profile') }}">{{ Auth::user()->name }}</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Trang cá nhân</li>
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
    <div class="main-content">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="px-3 pt-4 pb-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img style="width: 50px; height: 50px;" class="me-3 avatar-sm rounded-circle"
                                    src="{{ asset('images/' . $user->avatar) }}" alt="{{ $user->name }}">

                                <div>
                                    <h3 class="card-title fs-6 mb-0"><a href="/profile">{{ $user->name }}</a></h3>
                                    <span class="text-muted" style="font-size: 12px;">@~{{ $user->name }}</span>
                                </div>

                            </div>

                            @can('update', $user)
                                <a href="{{ route('users.settings.edit') }}" class="btn btn-sm btn-primary">Cập nhật</a>
                            @endcan
                        </div>

                        <div class="px-2 mt-4">
                            @can('getAccountBalance', $user)
                                <h6 class="h6"> Số dư khả dụng : </h6>
                                <p class="fs-6 fw-light">{{ number_format($user->account_balance, 0, '', '.') }}đ</p>
                            @endcan

                            <h6 class="h6"> Email : </h6>
                            <p class="fs-6 fw-light">{{ $user->email }}</p>

                            <h6 class="h6"> Số điện thoại : </h6>
                            <p class="fs-6 fw-light">{{ $user->phone }}</p>

                            <h6 class="h6"> Facebook : </h6>
                            <p class="fs-6 fw-light">{{ $user->facebook }}</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="tab-content">
                    <div class="row g-4">
                        @foreach ($rooms as $room)
                            <div class="col-lg-4 col-md-8">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        {{-- <a href=""><img class="img-fluid"
                                                src="{{ asset('images/' . $room->picture) }}" alt=""></a> --}}


                                        <a href=""><img class="img-fluid"
                                                src="{{ Vite::asset('resources/images/property-1.jpg') }}"
                                                alt=""></a>

                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            {{ $room->image->count() }} ảnh</div>

                                        <div
                                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            {{ $room->category->name }}</div>
                                    </div>

                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">{{ $room->price }}</h5>
                                        <a class="d-block h5 mb-2"
                                            style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis;"
                                            href="{{ route('rooms.show', ['slug' => $room->slug, 'room' => $room->id]) }}">{{ $room->title }}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $room->exact_address }}
                                        </p>
                                    </div>

                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-ruler-combined text-primary me-2"></i>{{ $room->area }}
                                            m<sup>2</sup></small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa-solid fa-venus-mars text-primary me-2"></i>{{ $room->subject_id }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-3">
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
