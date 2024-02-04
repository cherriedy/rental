@extends('admin.layouts.layout')

@section('title', 'Huỷ bài đăng')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Quản lí</li>
        <li class="breadcrumb-item">Phòng</li>
        <li class="breadcrumb-item active">Huỷ phòng</li>
    </ol>

    <h3 class="h3">Huỷ bài đăng phòng</h3>

    <form action="" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="reason">Lý do huỷ bài đăng</label>
            <textarea name="reason" cols="100" rows="10" class="form-control">{{ $room->cancel_reason ?? '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-sm btn-success mt-3">Lưu</button>
    </form>

@endsection
