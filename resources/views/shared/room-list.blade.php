<div class="container" id="category">
    <div class="left-col">
        <section class="card">
            <div class="card-header">
                <span class="card-title">Tổng {{ $rooms->count() ? $rooms->count() : 0 }} kết
                    quả</span>

                <div class="sort-by">
                    <span>Sắp xếp: </span>
                    <a href="">Mặc định</a>
                    <a href="">Mới nhất</a>
                    <a href="">Có video</a>
                </div>
            </div>

            @foreach ($rooms ?? [] as $room)
                <div class="card-body">
                    <div class="card-item">
                        <div class="card-item-img">
                            <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cm9vbXxlbnwwfHwwfHx8MA%3D%3D"
                                alt="" style="width: 100%; height: 100%; object-fit: cover;">

                        </div>

                        <div class="card-info">
                            <span class="post-title"><a
                                    href="{{ route('rooms.show', ['slug' => $room->slug, 'room' => $room->id]) }}">{{ $room->title }}</a></span>

                            <div class="post-row">
                                <span class="post-price">{{ number_format($room->price, 0, '', ',') }}
                                    vnđ/tháng</span>
                                <span class="post-area">{{ $room->area }}m²</span>
                                <span class="post-location">{{ $room->exact_address }}</span>
                                <span class="post-time">{{ date('Y-m-d', $room->created_at) }}</span>
                            </div>

                            <div class="post-row">
                                <p class="post-summary">{{ $room->description }}</p>
                            </div>
                            {{--
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
                            </div> --}}
                        </div>
                    </div>
                </div>

                <hr>
            @endforeach

        </section>
    </div>

    <div class="right-col">
        @include('shared.room-list-aside')
    </div>
</div>
