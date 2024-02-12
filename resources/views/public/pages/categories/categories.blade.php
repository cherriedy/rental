@extends('layouts.layout')

@section('title', $category->name)

@section('content')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">trang chủ</li>
        <li class="breadcrumb-item active">{{ $category->name }}</li>
    </ol>

    <h3 class="h3" style="font-weight: 600">{{ $category->title }}</h3>
    <small>{{ $category->description }}</small> --}}

    <div class="container" id="category">
        <div class="left-col">
            <section class="card">
                <div class="card-header">
                    <span class="card-title">Tổng {{ !$category->room ? 0 : $category->room->count() }} kết
                        quả</span>

                    <div class="sort-by">
                        <span>Sắp xếp: </span>
                        <a href="">Mặc định</a>
                        <a href="">Mới nhất</a>
                        <a href="">Có video</a>
                    </div>
                </div>

                @foreach ($category->room ?? [] as $room)
                    <div class="card-body">
                        <div class="card-item">
                            <div class="card-item-img">
                                <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cm9vbXxlbnwwfHwwfHx8MA%3D%3D"
                                    alt="" style="width: 100%; height: 100%; object-fit: cover;">

                            </div>

                            <div class="card-info">
                                <span class="post-title">{{ $room->title }}</span>

                                <div class="post-row">
                                    <span class="post-price">{{ number_format($room->price, 0, '', ',') }}
                                        vnđ/tháng</span>
                                    <span class="post-area">{{ $room->area }}m²</span>
                                    <span class="post-location">Quận 7, Hồ Chí Minh</span>
                                    <span class="post-time">7 giờ trước</span>
                                </div>

                                <div class="post-row">
                                    <p class="post-summary">{{ $room->description }}</p>
                                </div>

                                <div class="post-row">
                                    <div class="post-author">
                                        <img src="{{ url('storage/' . $room->user->avatar) }}"
                                            alt="{{ $room->user->name }}">
                                        <span class="author-name">{{ $room->user->name }}</span>
                                    </div>

                                    <div class="post-contact">
                                        <a rel="nofollow" target="_blank" href="https://zalo.me/{{ $room->user->phone }}"
                                            class="btn btn-primary">Nhắn Zalo</a>
                                        <a rel="nofollow" target="_blank" href="tel:{{ $room->user->phone }}"
                                            class="btn btn-secondary">Gọi 0815777735</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                @endforeach

            </section>
        </div>

        <div class="right-col">
            <section class="card">
                <div class="card-header">
                    <span class="card-title">Xem theo giá</span>
                </div>

                <ul class="d-flex flex-col flex-wrap" style="list-style:none; row-gap: 4px; column-gap: 8px;">
                    <li>Dưới 1 triệu</li>
                    <li>Dưới 1 triệu</li>
                    <li>Dưới 1 triệu</li>
                    <li>Dưới 1 triệu</li>
                    <li>Dưới 1 triệu</li>
                    <li>Dưới 1 triệu</li>
                </ul>
            </section>
        </div>
    </div>
@endsection
