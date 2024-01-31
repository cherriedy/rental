@extends('layouts.layout')

@section('title', 'Tìm kiếm theo danh mục')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item active">{{ $category->name }}</li>
    </ol>

    <h3 class="h3" style="font-weight: 600">{{ $category->title }}</h3>
    <small>{{ $category->description }}</small>

    @include('shared.room-list')
@endsection
