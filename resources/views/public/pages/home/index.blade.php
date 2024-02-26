@extends('layouts.layout')

@section('title', 'Trang chủ')

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Tìm nhà trọ <span class="text-primary">Tiện Lợi</span> không
                    tốn thời gian</h1>

                <p class="animated fadeIn mb-4 pb-2">Rental với giao diện thân thiện dễ sử dụng và hướng đến người dùng, các
                    chuyên mục được phân chia rất rõ ràng và tim kiếm tin đăng rất chi tiết.</p>

                <a href="" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">KHÁM PHÁ</a>
            </div>

            <div class="col-md-6 animated fadeIn">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/carousel-1.jpg') }}" alt="">
                    </div>

                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="{{ Vite::asset('resources/images/carousel-2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SEARCH BAR --}}
    @include('shared.search-bar-2')

    {{-- MAIN CONTENT --}}
    <div class="main-content clearfix">
        <div class="section mb-4">
            <div class="section-header mb-5">
                <span class="section-title big">Phòng cho thuê nổi bật</span>
                <small class="d-block">Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd
                    vero ipsum sit eirmod
                    sit diam justo sed rebum.
                </small>
            </div>

            <div class="tab-content">
                <div class="row g-4">
                    @foreach ($VipRooms as $room)
                        <div class="col-lg-4 col-md-6">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href=""><img class="img-fluid"
                                            src="{{ Vite::asset('resources/images/property-1.jpg') }}" alt=""></a>

                                    <div
                                        class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                        {{$room->image->count()}} ảnh</div>

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
                                    {{-- <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>2
                                    Bath</small> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @include('shared.room-list')
    </div>
@endsection
