@extends('admin.layouts.layout')

@section('title', 'Quản lý danh mục')

@section('content')
    <a href="{{ route('admins.users.create') }}" class="btn btn-sm btn-outline-info">Thêm người dùng</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Tên</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Facebook</th>
                <th scope="col">Phân loại</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <th scope="row" style="width: 50px; height: 50px;">
                        <img src="{{ url('storage/' . $user->avatar) }}"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 100%; overflow: hidden;">
                    </th>
                    <td scope="row">{{ $user->name }}</td>
                    <td scope="row">{{ $user->email }}</td>
                    <td scope="row">{{ $user->phone }}</td>
                    <td scope="row">{{ $user->facebook }}</td>
                    <td scope="row">{{ $user->isAdmin ? 'Quản trị viên' : 'Người  dùng' }}</td>
                    <td scope="row">{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                    <td scope="row">
                        <a href="{{ route('admins.users.update', $user->id) }}"><i
                                class="fa-solid fa-pen-to-square"></i></a>

                        <a href="{{ route('admins.users.delete', $user->id) }}"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
