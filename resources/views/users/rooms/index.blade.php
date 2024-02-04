@extends('layouts.layout')

@section('title', 'Quản lý đăng bài')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Home</li>
    </ol>

    <div>
        @include('shared.success-message')
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Mã tin</th>
                <th scope="col">Ảnh đại diện</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Giá</th>
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
                            <img src="https://phongtro123.com/img/thumb_default.jpg" alt=""
                                style="display: block; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </td>

                    <td>
                        <a href="{{ route('rooms.show', ['slug' => $room->slug, 'room' => $room->id]) }}"><span
                                class="badge bg-primary">{{ $room->category->name }}</span> {{ $room->title }}</a>
                        <p class="d-flex align-items-center mt-3">
                            @if ($room->status == \App\Models\Room::STATUS_EXPIRED)
                                <a href="#" class="text-decoration-none"><i class="fa fa-refresh"></i> Đăng lại</a>
                            @endif

                            <a href="{{ route('rooms.edit', $room->id) }}" class="text-decoration-none"><i
                                    class="fa fa-refresh"></i>
                                Sửa tin</a>

                            {{-- @if ($room->status == \App\Models\Room::STATUS_HIDE)
                                <a href="{{ route('rooms.active', $room->id) }}" class="text-decoration-none mx-3"><i
                                        class="fa fa-eye-slash"></i> Hiển thị</a>
                            @else
                                <a href="{{ route('rooms.hide', $room->id) }}" class="text-decoration-none mx-3"><i
                                        class="fa fa-eye-slash"></i> Ẩn tin</a>
                            @endif --}}

                            @if ($room->status == \App\Models\Room::STATUS_DEFAULT || $room->status == \App\Models\Room::STATUS_EXPIRED)
                                <a href="{{ route('rooms.hot-service', $room->id) }}" class="text-decoration-none mx-3"><i
                                        class="fa fa-eye-slash"></i>Mua gói dịch vụ HOT</a>
                            @endif
                        </p>
                    </td>
                    <td>{{ number_format($room->price, 0, '', ',') }} đồng / tháng</td>
                    <td>{{ date('Y-m-d', strtotime($room->created_at)) }}</td>
                    <td>{{ $room->expiration_date }}</td>
                    <td>{{ $room->getStatus() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
