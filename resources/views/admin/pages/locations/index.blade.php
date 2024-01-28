@extends('admin.layouts.layout')

@section('title', 'Quản lý vị trí')

@section('content')
    <a href="{{ route('admins.locations.create') }}" class="btn btn-sm btn-outline-info">Thêm địa điểm</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Loại</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <th scope="row">{{ $location->id }}</th>
                    <td scope="row">{{ $location->name }}</td>
                    <td scope="row">{{ $location->getLocationType() }}</td>
                    <td scope="row">{{ date('d-m-Y', strtotime($location->created_at)) }}</td>
                    <td scope="row">{{ $location->getLocationStatus() }}</td>
                    <td scope="row">
                        <a href="{{ route('admins.locations.update', $location->id) }}"><i
                                class="fa-solid fa-pen-to-square"></i></a>

                        <a href="{{ route('admins.locations.delete', $location->id) }}"><i
                                class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
