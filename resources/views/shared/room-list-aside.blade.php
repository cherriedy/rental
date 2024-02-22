<aside class="post-list-aside" id="aside">
    <section class="section section-sublink">
        <div class="section-header">
            <span class="section-title">Xem theo giá</span>
        </div>

        <ul class="link-list price clearfix" style="padding: 0">
            @foreach ($_PRICE_RANGE as $key => $value)
                <li>
                    <a href="{{ request()->url() . '?price_range=' . $key }}">{{ $value }}</a>
                </li>
            @endforeach
        </ul>
    </section>

    <section class="section section-sublink">
        <div class="section-header">
            <span class="section-title">Xem theo diện tích</span>
        </div>

        <ul class="link-list area clearfix" style="padding: 0">
            @foreach ($_AREA_RANGE as $key => $value)
                <li>
                    <a href="{{ request()->url() . '?area_range=' . $key }}">{{ $value }}</a>
                </li>
            @endforeach
        </ul>
    </section>

    <section class="section section-aside__new-post">
        <div class="section-header">
            <span class="section-title">Tin mới đăng</span>
        </div>

        <ul class="post-list aside clearfix">
            @foreach ($_SIDEBAR_ROOM_NEW as $item)
                <li class="post-list-item">
                    @php
                        $thumb = $item->images !== null ? $item->images->first()->path : 'no-avatar.jpg';
                    @endphp

                    <a href="{{ route('rooms.show', ['room' => $item->id, 'slug' => $item->slug]) }}">
                        <figure class="post-thumb">
                            <img src="{{ asset('images/' . $thumb) }}" alt="post-thumb">
                        </figure>

                        <div class="post-meta">
                            <span class="post-title">{{ $item->title }}</span>
                            <span class="post-price">{{ $item->price }}</span>
                            <span class="post-time">{{ $item->starting_date }}</span>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

    </section>

</aside>
