@extends('admin.layouts.layout')

@section('title', 'Quản lí phòng')

@section('css')
    <style>
        .intro {
            height: 100%;
        }

        table td,
        table th {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .card {
            border-radius: .5rem;
        }

        .mask-custom {
            background: rgba(24, 24, 16, .2);
            border-radius: 2em;
            backdrop-filter: blur(25px);
            border: 2px solid rgba(255, 255, 255, 0.05);
            background-clip: padding-box;
            box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
        }
    </style>
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Quản trị</li>
        <li class="breadcrumb-item active">Phòng</li>
        {{-- <li class="breadcrumb-item"></li> --}}
    </ol>

    <h3 class="h3">Quản trị phòng</h3>

    <section class="intro">
        <div class="bg-image h-100" style="background-color: #fff;">
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckDefault" />
                                                        </div>
                                                    </th>
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
                                                    <th scope="col">Ngày cập nhật</th>
                                                    <th scope="col">Ngày bắt đầu</th>
                                                    <th scope="col">Ngày kết thúc</th>
                                                    <th scope="col">Trạng thái</th>
                                                    <th scope="col">Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rooms as $room)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault7" />
                                                            </div>
                                                        </th>

                                                        <th scope="row">{{ $room->id }}</th>
                                                        <th scope="row" style="width: 50px; height: 50px;">
                                                            <img src="{{ url('storage/' . $room->avatar) }}"
                                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 100%; overflow: hidden;">
                                                        </th>
                                                        <td scope="row">{{ $room->title }}</td>
                                                        <td scope="row">{{ $room->getSubject() }}</td>
                                                        <td scope="row">{{ number_format($room->price, 0, '', ',') }}
                                                            <small>đồng/tháng</small>
                                                        </td>
                                                        <td scope="row">{{ $room->category->name }}</td>
                                                        <td scope="row">{{ $room->city->name }}</td>
                                                        <td scope="row">{{ $room->district->name }}</td>
                                                        <td scope="row">{{ $room->ward->name }}</td>
                                                        <td scope="row">{{ $room->street->name }}</td>
                                                        <td scope="row">
                                                            {{ date('d-m-Y', strtotime($room->created_at)) }}
                                                        </td>
                                                        <td scope="row">
                                                            {{ date('d-m-Y', strtotime($room->updated_at)) }}
                                                        </td>
                                                        <td scope="row" class="text text-success">
                                                            {{ date('d-m-Y', strtotime($room->starting_date)) }}
                                                        </td>
                                                        <td scope="row" class="text text-warning">
                                                            {{ date('d-m-Y', strtotime($room->expiration_date)) }}</td>
                                                        <td scope="row">{{ $room->getStatus() }}</td>
                                                        <td>
                                                            <a href="{{ route('admins.rooms.cancel', $room->id) }}"
                                                                class="btn btn-danger btn-sm px-3"><i
                                                                    class="fas fa-times"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
