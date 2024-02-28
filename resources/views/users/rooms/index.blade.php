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

    {{-- TABLE --}}
    <div class="card">
        <div class="card-header card-header__post">
            <div class="__post-shortcut">
                <span class="d-block" style="font-weight: bold; font-size: 1rem;">Lối tắt</span>

                <a href="" class="btn btn-sm __post-shortcut-btn">
                    <div class="svg-container">
                        <img src="https://static.chotot.com/storage/ads-dashboard/svg/goi-pro.svg" alt="goi-pro">
                    </div>
                    Bảng giá
                </a>


                <a href="" class="btn btn-sm __post-shortcut-btn">
                    <div class="svg-container">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="!mr-0">
                            <path
                                d="M9.33333 1.99999C8.71146 1.98512 8.0929 2.09476 7.51403 2.32247C6.93516 2.55017 6.40766 2.89134 5.96258 3.3259C5.5175 3.76047 5.16382 4.27965 4.92234 4.85291C4.68087 5.42618 4.55647 6.04194 4.55647 6.66399C4.55647 7.28604 4.68087 7.9018 4.92234 8.47507C5.16382 9.04833 5.5175 9.56751 5.96258 10.0021C6.40766 10.4366 6.93516 10.7778 7.51403 11.0055C8.0929 11.2332 8.71146 11.3429 9.33333 11.328C9.9552 11.3429 10.5738 11.2332 11.1526 11.0055C11.7315 10.7778 12.259 10.4366 12.7041 10.0021C13.1492 9.56751 13.5028 9.04833 13.7443 8.47507C13.9858 7.9018 14.1102 7.28604 14.1102 6.66399C14.1102 6.04194 13.9858 5.42618 13.7443 4.85291C13.5028 4.27965 13.1492 3.76047 12.7041 3.3259C12.259 2.89134 11.7315 2.55017 11.1526 2.32247C10.5738 2.09476 9.9552 1.98512 9.33333 1.99999ZM6.66667 13.992C5.42899 13.992 4.242 14.4837 3.36683 15.3588C2.49167 16.234 2 17.421 2 18.6587L2 21.988H16.6667V18.6587C16.6667 17.421 16.175 16.234 15.2998 15.3588C14.4247 14.4837 13.2377 13.992 12 13.992H6.66667ZM18.6667 15.3333H18V22H22V18.6667C22 17.7826 21.6488 16.9348 21.0237 16.3096C20.3986 15.6845 19.5507 15.3333 18.6667 15.3333Z"
                                fill="currentColor"></path>
                            <path
                                d="M17.3333 7.33331C16.4493 7.33331 15.6014 7.6845 14.9763 8.30962C14.3512 8.93474 14 9.78259 14 10.6666C14 11.5507 14.3512 12.3985 14.9763 13.0237C15.6014 13.6488 16.4493 14 17.3333 14C18.2174 14 19.0652 13.6488 19.6904 13.0237C20.3155 12.3985 20.6667 11.5507 20.6667 10.6666C20.6667 9.78259 20.3155 8.93474 19.6904 8.30962C19.0652 7.6845 18.2174 7.33331 17.3333 7.33331Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    Liên hệ với chúng tôi
                </a>
            </div>

            <div class="__post-user-toolbar">
                <div class="__post-user-toolbar-info">
                    <div class="__post-user-toolbar-info-avatar">
                        <img src="{{ asset('images/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                </div>

                <div class="btn btn-sm __post-user-toolbar-cash">
                    <div class="svg-container">
                        <img src="https://static.chotot.com/storage/react-common/dongTot.svg" alt="">
                    </div>

                    <span class="txt-account_balance">Số dư:
                        {{ number_format(Auth::user()->account_balance, 0, '', '.') }}</span>

                    <button onclick="window.location.replace('{{ route('recharge.index') }}')">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" stroke="white" stroke-width="2">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 3.30005C12.3866 3.30005 12.7 3.61345 12.7 4.00005V20C12.7 20.3867 12.3866 20.7001 12 20.7001C11.6134 20.7001 11.3 20.3867 11.3 20V4.00005C11.3 3.61345 11.6134 3.30005 12 3.30005Z"
                                fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M20.7 12C20.7 12.3866 20.3866 12.7 20 12.7L3.99995 12.7C3.61335 12.7 3.29995 12.3866 3.29995 12C3.29995 11.6134 3.61335 11.3 3.99995 11.3L20 11.3C20.3866 11.3 20.7 11.6134 20.7 12Z"
                                fill="currentColor"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table_listing_sm">
                    <thead>
                        <tr>
                            <th scope="col" style="white-space: nowrap;">Mã tin</th>
                            <th scope="col">Ảnh đại diện</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Giá</th>
                            <th scope="col" style="white-space: nowrap;">Ngày bắt đầu</th>
                            <th scope="col" style="white-space: nowrap;">Ngày kết thúc</th>
                            <th scope="col" style="white-space: nowrap;">Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($rooms ?? [] as $room)
                            <tr>
                                <td scope="row" style="text-align: center;">#{{ $room->id }}</td>
                                <td>
                                    <div style="overflow: hidden; width: 100px; margin: 0 auto; position: relative;">
                                        <img src="{{ asset('images/' . $room->picture) }}" alt=""
                                            class="post_thumb">
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-primary">{{ $room->category->name ?? null }}</span>

                                    <a href="{{ route('rooms.show', ['slug' => $room->slug, 'room' => $room->id]) }}"
                                        class="post_title"
                                        style="color: {{ $room->getHotService($room->hot_service)['color'] }}">{{ $room->title }}</a>

                                    <p style="margin-top: 12px; font-size: 12.5px;">
                                        <strong>Địa chỉ: </strong>
                                        {{ $room->exact_address }}
                                    </p>

                                    <div class="post_action_toolbar">
                                        @if (in_array($room->getRawOriginal('status'), [\App\Models\Room::STATUS_DEFAULT, \App\Models\Room::STATUS_EXPIRED]))
                                            <a href="{{ route('rooms.hot-service', $room->id) }}"
                                                class="btn btn-sm post_action_toolbar-btn cash">
                                                <div class="svg-container">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-credit-card">
                                                        <rect x="1" y="4" width="22" height="16" rx="2"
                                                            ry="2"></rect>
                                                        <line x1="1" y1="10" x2="23"
                                                            y2="10">
                                                        </line>
                                                    </svg>
                                                </div>
                                                Thanh toán tin
                                            </a>
                                        @endif

                                        <a href="{{ route('rooms.edit', $room->id) }}"
                                            class="btn btn-sm post_action_toolbar-btn">
                                            <div class="svg-container">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12"
                                                    height="12" viewBox="0 0 50 50">
                                                    <path
                                                        d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z">
                                                    </path>
                                                </svg>
                                            </div>
                                            Sửa tin
                                        </a>

                                        @if ($room->getRawOriginal('status') == \App\Models\Room::STATUS_HIDE)
                                            <a href="{{ route('rooms.active', $room->id) }}"
                                                class="btn btn-sm post_action_toolbar-btn">
                                                <div class="svg-container">
                                                    <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                                        stroke-miterlimit="2" viewBox="0 0 12 12"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m17.5 11c2.484 0 4.5 2.016 4.5 4.5s-2.016 4.5-4.5 4.5-4.5-2.016-4.5-4.5 2.016-4.5 4.5-4.5zm-5.346 6.999c-.052.001-.104.001-.156.001-4.078 0-7.742-3.093-9.854-6.483-.096-.159-.144-.338-.144-.517s.049-.358.145-.517c2.111-3.39 5.775-6.483 9.853-6.483 4.143 0 7.796 3.09 9.864 6.493.092.156.138.332.138.507s-.046.351-.138.507l-.008.013c-1.079-1.18-2.631-1.92-4.354-1.92-.58 0-1.141.084-1.671.24-.498-1.643-2.025-2.84-3.829-2.84-2.208 0-4 1.792-4 4 0 2.08 1.591 3.792 3.622 3.982-.014.171-.022.343-.022.518 0 .893.199 1.74.554 2.499zm3.071-2.023 1.442 1.285c.095.085.215.127.333.127.136 0 .271-.055.37-.162l2.441-2.669c.088-.096.131-.217.131-.336 0-.274-.221-.499-.5-.499-.136 0-.271.055-.37.162l-2.108 2.304-1.073-.956c-.096-.085-.214-.127-.333-.127-.277 0-.5.224-.5.499 0 .137.056.273.167.372zm-3.277-2.477c-1.356-.027-2.448-1.136-2.448-2.499 0-1.38 1.12-2.5 2.5-2.5 1.193 0 2.192.837 2.44 1.955-1.143.696-2.031 1.768-2.492 3.044z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                </div>
                                                Hiện tin
                                            </a>
                                        @endif

                                        @can('hideRoom', $room)
                                            <a href="{{ route('rooms.hide', $room->id) }}"
                                                class="btn btn-sm post_action_toolbar-btn edit">
                                                <div class="svg-container">
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M4 14c-.5-.6-.9-1.3-1-2 0-1 4-6 9-6m7.6 3.8A5 5 0 0 1 21 12c0 1-3 6-9 6h-1m-6 1L19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </div>
                                                Ẩn tin
                                            </a>
                                        @endcan
                                    </div>

                                    <span style="display: block; color: #999; margin-top: 12px; font-size: 12px;">Loại tin:
                                        {{ $room->hot_service }}</span>

                                    <span style="display: block; color: #999; margin-top: 12px; font-size: 12px;">Cập nhật
                                        gần nhất:
                                        {{ $room->updated_at }}</span>

                                </td>
                                <td class="post-price">{{ number_format($room->price, 0, '', ',') }} đồng / tháng</td>
                                <td style="text-align: center;">{{ $room->starting_date }}</td>
                                <td style="text-align: center;">{{ $room->expiration_date }}</td>
                                <td style="text-align: center; white-space: nowrap;">{{ $room->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
