@extends('layouts.layout')

@section('title', 'Tìm kiếm theo danh mục')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Trang chủ</li>
        <li class="breadcrumb-item active">{{ $location->name }}</li>
    </ol>

    <h3 class="h3" style="font-weight: 600">{{ $location->title }}</h3>
    <small>{{ $location->description }}</small>

    @if (isset($districts) && !$districts->IsEmpty())
        <div class="row">
            <div class="col-md-8">
                <ul class="list-group list-group-horizontal-sm flex-fill">
                    @foreach ($districts as $district)
                        <li class="list-group-item">
                            <a
                                href="{{ route('districts.index', ['district' => $district->id, 'slug' => $district->slug]) }}">
                                {{ $district->name }}</a>
                            <small>{{ $district->roomDistrict->count() }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @include('shared.search-list-dev')
@endsection
