@if (isset($districts))
    <div class="section section-relative-location">
        <ul class="location__district clearfix">
            @foreach ($districts as $district)
                <li>
                    <a href="" class="location__district-item">{{ $district->name }}</a>
                    <span class="count-item">{{ $district->roomDistrict->count() }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div id="left-side">
    <div class="section section-post-list">
        <div class="section-header clearfix">
            <span class="section-title">Tổng {{ $rooms->count() ? $rooms->count() : 0 }} kết
                quả</span>

            <div class="post-sort">
                <span>Sắp xếp: </span>
                <a class="active" href="{{ request()->url() . '?sortBy=default&page=1' }}">Mặc định</a>
                <a href="{{ request()->url() . '?sortBy=newest&page=1' }}">Mới nhất</a>
                <a href="{{ request()->url() . '?sortBy=video&page=1' }}">Có video</a>
            </div>

            <ul class="post-list clearfix">
                @foreach ($rooms ?? [] as $room)
                    <li class="post-list-item {{ $room->getHotService($room->hot_service)['class'] }}"
                        style="border-color: {{ $room->getHotService($room->hot_service)['color'] }}">
                        <figure class="post-thumb">
                            <a href="{{ route('rooms.show', ['room' => $room->id, 'slug' => $room->slug]) }}"
                                class="clearfix"></a>
                            <span class="post-number-images">{{ $room->image->count() }} ảnh</span>
                        </figure>

                        <div class="post-meta">
                            <h3 class="post-title"
                                style="color: {{ $room->getHotService($room->hot_service)['color'] }}">
                                {{ $room->title }}</h3>

                            <div class="meta-row clearfix">
                                <span class="post-price">{{ $room->price }}</span>
                                <span class="post-area">{{ $room->area }}m²</span>
                                <span
                                    class="post-brief-address">{{ $room->district->name . ', ' . $room->city->name }}</span>
                                <time class="post-time">{{ $room->starting_date }}</time>
                            </div>

                            <div class="meta-row clearfix">
                                <div class="post-summary">{{ $room->getBriefDescription() }}</div>
                            </div>

                            <div class="meta-row clearfix">
                                <div class="post-owner">
                                    <img src="{{ asset('images/' . $room->user->avatar) }}" alt="">
                                    <span class="owner-name">{{ $room->user->name }}</span>
                                </div>

                                @if ($room->user->phone != null)
                                    <a href="tel:{{ $room->user->phone }}" class="quick-call-btn">Gọi
                                        {{ $room->user->phone }}</a>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mt-3">
        {{ $rooms->links() }}
    </div>
</div>


<div class="main-content">
    @include('shared.room-list-aside')
</div>
