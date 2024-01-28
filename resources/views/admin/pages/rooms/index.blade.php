@extends('admin.layouts.layout')

@section('title', 'Quản lý danh mục')

@section('content')
    {{-- <a href="{{ route('admins.rooms.create') }}" class="btn btn-sm btn-outline-info">Thêm bài đăng</a> --}}

    <div class="container table-responsive py-5">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Đối tượng</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Chuyên mục</th>
                    <th scope="col">Tỉnh/Thành</th>
                    <th scope="col">Quận/Huyện</th>
                    <th scope="col">Phường/Xã</th>
                    <th scope="col">Đường</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <th scope="row">{{ $room->id }}</th>
                        <th scope="row" style="width: 50px; height: 50px;">
                            <img src="{{ url('storage/' . $room->avatar) }}"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 100%; overflow: hidden;">
                        </th>
                        <td scope="row">{{ $room->title }}</td>
                        <td scope="row">{{ $room->getSubject() }}</td>
                        <td scope="row">{{ number_format($room->price, 0, '', ',') }} <small>đồng/tháng</small></td>
                        <td scope="row">{{ $room->category->name }}</td>
                        <td scope="row">{{ $room->city->name }}</td>
                        <td scope="row">{{ $room->district->name }}</td>
                        <td scope="row">{{ $room->ward->name }}</td>
                        <td scope="row">{{ $room->street->name }}</td>
                        <td scope="row">{{ $room->getStatus() }}</td>
                        <td scope="row">{{ date('d-m-Y', strtotime($room->created_at)) }}</td>
                        <td scope="row">
                            {{-- <a href="{{ route('admins.rooms.update', $room->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('admins.rooms.delete', $room->id) }}"><i class="fa-solid fa-trash"></i></a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
