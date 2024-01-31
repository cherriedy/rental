<section class="card">
    <div class="card-header">
        <span class="card-title">Xem theo giá</span>
    </div>

    <ul class="d-flex flex-col flex-wrap" style="list-style:none; row-gap: 4px; column-gap: 8px;">
        @foreach ($_PRICE_RANGE as $key => $item)
            {{-- <li><a href="{{ request()->fullUrlWithQuery(['price_range' => $key]) }}">{{ $item }}</a></li> --}}
            <li><a href="{{ request()->url() . '?price_range=' . $key }}">{{ $item }}</a></li>
        @endforeach
    </ul>
</section>

<section class="card mt-3">
    <div class="card-header">
        <span class="card-title">Xem theo diện tích</span>
    </div>

    <ul class="d-flex flex-col flex-wrap" style="list-style:none; row-gap: 4px; column-gap: 8px;">
        @foreach ($_AREA_RANGE as $key => $item)
            {{-- <li><a href="{{ request()->fullUrlWithQuery(['area_range' => $key]) }}">{{ $item }}</a></li> --}}
            <li><a href="{{ request()->url() . '?area_range=' . $key }}">{{ $item }}</a></li>
        @endforeach
    </ul>
</section>

@if (isset($wards) && !$wards->IsEmpty())
    <section class="card mt-3">
        <div class="card-header">
            <span class="card-title">Xem theo phường</span>
        </div>

        <ul class="d-flex flex-col flex-wrap" style="list-style:none; row-gap: 4px; column-gap: 8px;">
            @foreach ($wards as $ward)
                {{-- <li><a href="{{ request()->fullUrlWithQuery(['ward_id' => $ward->id]) }}">{{ $ward->name }}</a></li> --}}
            <li><a href="{{ request()->url() . '?ward_id=' . $ward->id }}">{{ $ward->name }}</a></li>
            @endforeach
        </ul>
    </section>
@endif
