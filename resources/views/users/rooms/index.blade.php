@extends('layouts.layout')

@section('title', 'Quản lý đăng bài')

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Quản lí bài đăng</h1>

                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('profile') }}">{{ Auth::user()->name }}</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Quản lý bài đăng</li>
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
FIGHTING!
    {{-- TABLE --}}
    <div class="card">
        <div class="card-header w-100 h-100 px-2 py-4">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('images/' . Auth::user()->avatar) }}"
                        style="width: 35px; height: 35px; border-radius: 50%;">
                    {{ Auth::user()->name }}
                </div>

                <div class="d-flex flex-row align-items-center justify-content-between px-1 py-2"
                    style="font-size: 14px; font-weight: 600; background-color: #00B98E; border-radius: 4px; column-gap: 6px;">
                    <span class="text text-sm">Số dư: </span>

                    <span
                        style="color: #f0f0f0;">{{ number_format(auth()->user()->account_balance, 0, '', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Mã tin</th>
                        <th scope="col">Ảnh đại diện</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Dịch vụ nổi bật</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
                        <th scope="col">Trạng thái</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($rooms ?? [] as $room)
                        <tr>
                            <th scope="row"># {{ $room->id }}</th>
                            <td>
                                <div style="overflow: hidden; width: 100px; margin: 0 auto; position: relative;">
                                    @foreach ($room->image as $image)
                                        <img src="{{ asset('images/' . $image->path) }}" alt=""
                                            style="display: block; width: 100%; height: 100%; object-fit: cover;">
                                    @endforeach
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('rooms.show', ['slug' => $room->slug, 'room' => $room->id]) }}"><span
                                        class="badge bg-primary">{{ $room->category->name }}</span> {{ $room->title }}</a>
                                <p class="d-flex align-items-center mt-3">
                                    @if ($room->status == \App\Models\Room::STATUS_EXPIRED)
                                        <a href="#" class="text-decoration-none"><i class="fa fa-refresh"></i> Đăng
                                            lại</a>
                                    @endif

                                    <a href="{{ route('rooms.edit', $room->id) }}" class="text-decoration-none"><i
                                            class="fa fa-refresh"></i>
                                        Sửa tin</a>

                                    @if ($room->status == \App\Models\Room::STATUS_DEFAULT || $room->status == \App\Models\Room::STATUS_EXPIRED)
                                        <a href="{{ route('rooms.hot-service', $room->id) }}"
                                            class="text-decoration-none mx-3"><i class="fa fa-eye-slash"></i>Mua gói dịch vụ
                                            HOT</a>
                                    @endif
                                </p>
                            </td>
                            <td>{{ number_format($room->price, 0, '', ',') }} đồng / tháng</td>
                            <td>{{ $room->gethotService() }}</td>
                            <td>{{ $room->starting_date }}</td>
                            <td>{{ $room->expiration_date }}</td>
                            <td>{{ $room->getStatus() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    {{-- <div class="px-5">
        <div class="card">
            <div class="card-header">
                <div class="col-md-8">Danh sách bài đăng</div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="rooms-index-table">
                    <thead>
                        <tr>
                            <th scope="col">Mã tin</th>
                            <th scope="col">Ảnh đại diện</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Dịch vụ nổi bật</th>
                            <th scope="col">Ngày bắt đầu</th>
                            <th scope="col">Ngày kết thúc</th>
                            <th scope="col">Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div> --}}
@endsection
