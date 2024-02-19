@if (isset($districts))
    <div class="container-fluid room-list-secion top-location-bar">
        <ul class="relative-district-list clearfix">
            @foreach ($districts as $district)
                <li>
                    <a href="{{ route('districts.index', ['district' => $district->id, 'slug' => $district->slug]) }}"
                        class="relative-distict-item">{{ $district->name }}</a>
                    <span class="relative-district-room-count">({{ $district->roomDistrict->count() }})</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid room-list-body clearfix">
    <div class="room-list-body__left-side">
        <div class="card">
            <div class="card-header">
                <div class="card-header__info clearfix">
                    <span class="card-title">Tổng {{ number_format($rooms->count() ? $rooms->count() : 0, 0, '', '.') }}
                        kết quả</span>

                    <span class="updated-at">
                        Cập nhật:
                        <time>23:44 18/02/2024</time>
                    </span>
                </div>

                <div class="card-header__sortBy">
                    <span>Sắp xếp: </span>
                    <a class="btn btn-sm __sortBy-btn" href="{{ request()->url() . '?orderBy=defualt' }}">Mặc định</a>

                    <a class="btn btn-sm __sortBy-btn" href="{{ request()->url() . '?orderBy=newest' }}">Mới nhất</a>

                    <a class="btn btn-sm __sortBy-btn" href="{{ request()->url() . '?orderBy=video' }}">Có video</a>
                </div>
            </div>

            <div class="card-body">
                <ul class="post-list clearfix">
                    @foreach ($rooms as $room)
                        <li class="post-list-item goitin__noibat">
                            <figure class="post-thumb">
                                <a href="{{ route('rooms.show', ['room' => $room->id, 'slug' => $room->slug]) }}">
                                    <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cm9vbXxlbnwwfHwwfHx8MA%3D%3D"
                                        alt="">
                                </a>

                                <span class="post-number-images">11 ảnh</span>
                            </figure>

                            <div class="post-meta">
                                <div class="post-title">
                                    <a href="{{ route('rooms.show', ['room' => $room->id, 'slug' => $room->slug]) }}">
                                        {{ $room->title }}
                                    </a>
                                </div>

                                <div class="meta-row clearfix">
                                    <div class="post-price">{{ $room->price }}</div>
                                    <div class="post-area">{{ $room->area }}m²</div>
                                    <div class="post-brief-address">
                                        {{ $room->district->name . ', ' . $room->city->name }}</div>
                                    <time class="post-time">{{ $room->starting_date }}</time>
                                </div>

                                <div class="meta-row">
                                    <div class="meta-summary">
                                        {{ $room->description }}
                                    </div>
                                </div>

                                <div class="meta-row">
                                    <div class="post-owner">
                                        <img src="{{ asset('images/' . $room->user->avatar) }}" alt="owner-avatar">
                                        <span>{{ $room->user->name }}</span>
                                    </div>

                                    <a href="tel:{{ $room->user->phone }}" class="quick-call-btn">Gọi
                                        {{ $room->user->phone }}</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @include('shared.room-list-aside')
</div>
