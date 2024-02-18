@extends('layouts.layout')

@section('title', $room->name)

@section('content')
    {{-- HEADER --}}
    {{-- <div class="container-fluid header bg-white pt-5">
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
    </div> --}}

    {{-- SEARCH BAR --}}
    {{-- @include('shared.search-bar-2') --}}

    {{-- ROOM DETAL LAYOUT --}}
    <div class="container-fluid">
        <div class="room-detail__gallery">
            <div class="room-detail-container">
                @php
                    $photos = $room->image->first();
                @endphp
                <div class="__gallery-flex-box">
                    <div class="__gallery-main-img">
                        <img loading="lazy" src="{{ asset('images/' . $photos->path) }}" alt="">
                    </div>

                    <div class="__gallery-sub-img">
                        <img loading="lazy" src="{{ asset('images/' . $photos->path) }}" alt="">
                        <img loading="lazy" src="{{ asset('images/' . $photos->path) }}" alt="">
                        <img loading="lazy" src="{{ asset('images/' . $photos->path) }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="room-detail__info clearfix">
            <div class="room-detail-container">
                <div class="__info-basic">
                    <div class="group-name">
                        <h3>{{ $room->title }}</h3>
                    </div>

                    <div class="group-tag">
                        <span class="tag-item ward">{{ $room->ward->name }}</span>
                        <span class="tag-item district">{{ $room->district->name }}</span>
                        <span class="tag-item city">{{ $room->city->name }}</span>
                    </div>

                    <div class="group-address">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        <span>{{ $room->exact_address }}</span>
                    </div>

                    <div class="group-price">
                        <h2>{{ number_format($room->price, 0, '', ',') }} đồng/tháng</h2>
                    </div>
                </div>

                <div class="__info-right-sidebar">
                    <div class="__info-seller">
                        <div class="__info-seller-basic">
                            <div class="seller-avatar-container">
                                <img src="{{ asset('images/' . $room->user->avatar) }}" alt="{{ $room->user->name }}">
                            </div>

                            <div class="__info-seller-profile">
                                <b>{{ $room->user->name }}</b>
                                <button class="btn btn-sm __info-seller-profile-btn"
                                    onclick="window.location.replace('{{ route('users.show', $room->user->id) }}')">
                                    Xem trang
                                    <img src="https://static.chotot.com/storage/icons/svg/next-orange.svg" alt=">">
                                </button>
                            </div>
                        </div>

                        @can('getSellerPhone', $room)
                            <div class="btn btn-sm __info-seller-contact">
                                <a href="tel: {{ $room->user->phone }}" class="__info-seller-contact-btn">
                                    <div class="svg-container">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3.59 1.322l2.844-1.322 4.041 7.89-2.725 1.341c-.538 1.259 2.159 6.289 3.297 6.372.09-.058 2.671-1.328 2.671-1.328l4.11 7.932s-2.764 1.354-2.854 1.396c-7.861 3.591-19.101-18.258-11.384-22.281zm1.93 1.274l-1.023.504c-5.294 2.762 4.177 21.185 9.648 18.686l.971-.474-2.271-4.383-1.026.5c-3.163 1.547-8.262-8.219-5.055-9.938l1.007-.497-2.251-4.398zm7.832 7.649l2.917.87c.223-.747.16-1.579-.24-2.317-.399-.739-1.062-1.247-1.808-1.469l-.869 2.916zm1.804-6.059c1.551.462 2.926 1.516 3.756 3.051.831 1.536.96 3.263.498 4.813l-1.795-.535c.325-1.091.233-2.306-.352-3.387-.583-1.081-1.551-1.822-2.643-2.146l.536-1.796zm.95-3.186c2.365.705 4.463 2.312 5.729 4.656 1.269 2.343 1.466 4.978.761 7.344l-1.84-.548c.564-1.895.406-4.006-.608-5.882-1.016-1.877-2.696-3.165-4.591-3.729l.549-1.841z" />
                                        </svg>
                                    </div>

                                    <span>{{ $room->user->phone }}</span>
                                </a>

                                <span>Bấm để liên hệ</span>
                            </div>
                        @endcan

                        @can('update', $room)
                            <div class="btn btn-sm __info-owner-action">
                                <a href="{{ route('rooms.edit', $room->id) }}" class="__info-onwer-hide-post-btn">
                                    <div class="svg-container">
                                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" width="32px"
                                            height=32px" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m19 20.25c0-.402-.356-.75-.75-.75-2.561 0-11.939 0-14.5 0-.394 0-.75.348-.75.75s.356.75.75.75h14.5c.394 0 .75-.348.75-.75zm-7.403-3.398 9.124-9.125c.171-.171.279-.423.279-.684 0-.229-.083-.466-.28-.662l-3.115-3.104c-.185-.185-.429-.277-.672-.277s-.486.092-.672.277l-9.143 9.103c-.569 1.763-1.555 4.823-1.626 5.081-.02.075-.029.15-.029.224 0 .461.349.848.765.848.511 0 .991-.189 5.369-1.681zm-3.27-3.342 2.137 2.137-3.168 1.046zm.955-1.166 7.651-7.616 2.335 2.327-7.637 7.638z"
                                                fill-rule="nonzero" />
                                        </svg>
                                    </div>

                                    <span>Sửa tin</span>
                                </a>
                            </div>
                        @endcan

                        @can('hideRoom', $room)
                            <div class="btn btn-sm __info-owner-action _white">
                                <a href="{{ route('rooms.edit', $room->id) }}" class="__info-onwer-hide-post-btn">
                                    <div class="svg-container">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" width="32px" height="32px"
                                            xmlns="http://www.w3.org/2000/svg" fill="curerntColor" viewBox="0 0 24 24">
                                            <path
                                                d="m4 15.6 3-3V12a5 5 0 0 1 5-5h.5l1.8-1.7A9 9 0 0 0 12 5C6.6 5 2 10.3 2 12c.3 1.4 1 2.7 2 3.6Z" />
                                            <path
                                                d="m14.7 10.7 5-5a1 1 0 1 0-1.4-1.4l-5 5A3 3 0 0 0 9 12.7l.2.6-5 5a1 1 0 1 0 1.4 1.4l5-5 .6.2a3 3 0 0 0 3.6-3.6 3 3 0 0 0-.2-.6Z" />
                                            <path
                                                d="M19.8 8.6 17 11.5a5 5 0 0 1-5.6 5.5l-1.7 1.8 2.3.2c6.5 0 10-5.2 10-7 0-1.2-1.6-2.9-2.2-3.4Z" />
                                        </svg>

                                    </div>

                                    <span>Ẩn tin</span>
                                </a>
                            </div>
                        @endcan
                    </div>

                    <div class="__info-relative-room">
                        <h4>Phòng nổi bật</h4>

                        <ul class="__info-relative-room-list">
                            @foreach ($_SIDEBAR_ROOM_SPECIAL_SERVICE as $item)
                                <li class="__info-relative-room-item">
                                    <a href="{{ route('rooms.show', ['slug' => $item->slug, 'room' => $item->id]) }}">
                                        <div class="img-container">
                                            @php
                                                $image = $item->image->first() !== null ? $item->image->first()->path : 'no-avatar.jpg';
                                            @endphp
                                            <img src="{{ asset('images/' . $image) }}" alt="avatar">
                                        </div>

                                        <div class="__room-item-meta">
                                            <span class="post-title clearfix">{{ $item->title }}</span>
                                            <span class="post-price">{{ $item->price }}</span>
                                            <time class="post-time">{{ $item->starting_date }}</time>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="__info-relative-room">
                        <h4>Phòng mới đăng</h4>

                        <ul class="__info-relative-room-list">
                            @foreach ($_SIDEBAR_ROOM_NEW as $item)
                                <li class="__info-relative-room-item">
                                    <a href="{{ route('rooms.show', ['slug' => $item->slug, 'room' => $item->id]) }}">
                                        <div class="img-container">
                                            @php
                                                $image = $item->image->first() !== null ? $item->image->first()->path : 'no-avatar.jpg';
                                            @endphp
                                            <img src="{{ asset('images/' . $image) }}" alt="avatar">
                                        </div>

                                        <div class="__room-item-meta">
                                            <span class="post-title clearfix">{{ $item->title }}</span>
                                            <span class="post-price">{{ $item->price }}</span>
                                            <time class="post-time">{{ $item->starting_date }}</time>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="__info-detail-content">
                    <div class="horizontal-line"></div>
                    <div class="__info-detail-section-container">
                        <h6>Đặc điểm</h6>
                        <div class="outstanding-features">
                            <div class="outstanding-features__item">
                                <div class="svg-container">
                                    <img src="https://static.chotot.com/storage/icons/logos/ad-param/size.png"
                                        alt="">
                                </div>
                                <div class="title">
                                    <div class="sub-title">Diện tích</div>
                                    <div class="main-title">{{ $room->area }} m<sup>2</sup></div>
                                </div>
                            </div>
                            {{-- TEST --}}
                            <div class="outstanding-features__item">
                                <div class="svg-container">
                                    <img src="https://static.chotot.com/storage/icons/logos/ad-param/size.png"
                                        alt="">
                                </div>
                                <div class="title">
                                    <div class="sub-title">Diện tích</div>
                                    <div class="main-title">{{ $room->area }} m<sup>2</sup></div>
                                </div>
                            </div>

                            <div class="outstanding-features__item">
                                <div class="svg-container">
                                    <img src="https://static.chotot.com/storage/icons/logos/ad-param/size.png"
                                        alt="">
                                </div>
                                <div class="title">
                                    <div class="sub-title">Diện tích</div>
                                    <div class="main-title">{{ $room->area }} m2</div>
                                </div>
                            </div>
                            {{-- END TEST --}}

                            <div class="outstanding-features__item">
                                <div class="svg-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M17 0v2h1.586l-2.113 2.113c-.981-.698-2.177-1.113-3.473-1.113-2.225 0-4.151 1.219-5.187 3.018-1.473.045-2.933.615-4.057 1.739-1.171 1.172-1.756 2.707-1.756 4.242 0 1.536.585 3.071 1.757 4.243.917.917 2.055 1.469 3.243 1.669v2.24l-1.122-1.121-1.414 1.414 3.535 3.556 3.536-3.557-1.414-1.414-1.121 1.122v-2.24c1.186-.199 2.326-.752 3.242-1.668.382-.381.689-.805.943-1.252 3.227-.099 5.815-2.74 5.815-5.991 0-1.296-.415-2.492-1.113-3.473l2.113-2.113v1.586h2v-5h-5zm-4 13c-1.956 0-3.579-1.444-3.924-3.25-.326-.158-.689-.25-1.076-.25-.34 0-.661.074-.956.197.267 2.3 1.837 4.191 3.948 4.943-1.516 1.746-4.201 1.808-5.821.188-1.56-1.56-1.56-4.097-.001-5.657 2.261-2.26 6.126-1.07 6.747 2.04.328.17.687.289 1.083.289.333 0 .643-.081.932-.201-.263-2.242-1.672-4.128-3.91-4.93.728-.833 1.785-1.369 2.978-1.369 2.206 0 4 1.794 4 4s-1.794 4-4 4z" />
                                    </svg>
                                </div>
                                <div class="title">
                                    <div class="sub-title">Đối tượng</div>
                                    <div class="main-title">{{ $room->subject_id }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="horizontal-line"></div>
                    <div class="__info-detail-section-container">
                        <h6>Mô tả</h6>
                        <pre>{{ $room->description }}</pre>
                    </div>

                    <div class="horizontal-line"></div>
                    <div class="__info-detail-section-container">
                        <h6>Đặc điểm bài đăng</h6>
                        <div class="__info-detail-trait">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td class="title">Mã tin:</td>
                                        <td>{{ $room->id }}</td>
                                    </tr>

                                    <tr>
                                        <td class="title">Khu vực</td>
                                        <td>{{ $room->city->name }}</td>
                                    </tr>

                                    <tr>
                                        <td class="title">Loại tin rao:</td>
                                        <td>{{ $room->category->name }}</td>
                                    </tr>

                                    <tr>
                                        <td class="title">Đối tượng thuê:</td>
                                        <td>{{ $room->subject_id }}</td>
                                    </tr>

                                    <tr>
                                        <td class="title">Gói tin:</td>
                                        <td>{{ $room->hot_service }}</td>
                                    </tr>

                                    <tr>
                                        <td class="title">Ngày đăng:</td>
                                        <td>{{ $room->starting_date }}</td>
                                    </tr>

                                    <tr>
                                        <td class="title">Ngày hết hạn:</td>
                                        <td>{{ $room->expiration_date }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="horizontal-line"></div>
                    <div class="__info-detail-section-container">
                        <h6>Bản đồ</h6>
                        <div class="map-container">
                            <span style="display: block; margin-bottom: 12px;">Địa chỉ: {{ $room->exact_address }}</span>
                            <iframe width="100%" height="100%" style="border:0" loading="lazy"
                                src="{{ $room->map }}"></iframe>
                        </div>
                    </div>

                    <div class="horizontal-line"></div>
                    <div class="__info-detail-section-container">
                        <h6>Phòng tương tự</h6>
                        <ul class="__info-detail-room-suggestion-list">
                            @foreach ($roomSuggestions as $item)
                                <li class="__info-detail-room-suggestion-item">
                                    <a href="{{ route('rooms.show', ['room' => $item->id, 'slug' => $item->slug]) }}">
                                        <div class="img-container">
                                            @php
                                                $image = $item->image->first() !== null ? $item->image->first()->path : 'no-avatar.jpg';
                                            @endphp
                                            <img src="{{ asset('images/' . $image) }}" alt="avatar">
                                        </div>

                                        <div class="post-meta">
                                            <span class="post-title">{{ $item->title }}</span>

                                            <div class="meta-row clearfix">
                                                <span class="post-price">{{ $item->price }}</span>
                                                <span class="post-area">{{ $item->area }} m<sup>2</sup></span>
                                                <span
                                                    class="post-brief-address">{{ $item->district->name . ', ' . $item->city->name }}</span>
                                                <time class="post-time">{{ $item->starting_date }}</time>
                                            </div>

                                            <pre class="post-summary">{{ $item->description }}</pre>

                                            {{-- <div class="meta-row">
                                                <div class="post-author">
                                                    <img src="{{ asset('images/' . $item->user->avatar) }}"
                                                        alt="">
                                                </div>
                                            </div> --}}
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        function formatMoney(n) {
            if (n < 1e3) return n + " đồng/tháng";
            if (n >= 1e3 && n < 1e6) return +(n / 1e3).toFixed(1) + " ngàn/tháng";
            if (n >= 1e6 && n < 1e9) return +(n / 1e6).toFixed(1) + " triệu/tháng";
            if (n >= 1e9 && n < 1e12) return +(n / 1e9).toFixed(1) + " tỷ/tháng";
            if (n >= 1e12) return +(n / 1e12).toFixed(1) + "T";
        }

        $(document).ready(function() {
            $('.post-price').each(function() {
                $(this).text(formatMoney($(this).text()));
            });

        });
    </script>
@endsection
