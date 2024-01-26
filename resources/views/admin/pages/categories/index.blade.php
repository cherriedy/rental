@extends('admin.layouts.layout')

@section('title', 'Quản lý danh mục')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td scope="row">{{ $category->name }}</td>
                    <td scope="row">{{ date('d-m-Y', strtotime($category->created_at)) }}</td>
                    <td scope="row">{{ $category->getCategoryStatus() }}</td>
                    <td scope="row">
                        <a href="{{ route('admins.categories.update', $category->id) }}"><i
                                class="fa-solid fa-pen-to-square"></i></a>

                        <a href="{{ route('admins.categories.delete', $category->id) }}"><i
                                class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
