@extends('layouts.layout')

@section('title', $user->name)

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item ">Profile</li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
    </ol>

    <div>
        @include('shared.success-message')
        @include('shared.error-message')
    </div>

    <div class="col-6">
        <div class="card">
            <div class="px-3 pt-4 pb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img style="width: 150px; height: 150px;" class="me-3 avatar-sm rounded-circle"
                            src="{{ url('storage/' . $user->avatar) }}" alt="{{ $user->name }}">

                        <div>
                            <h3 class="card-title mb-0"><a href="/profile">{{ $user->name }}</a></h3>
                            <span class="fs-6 text-muted">@~{{ $user->name }}</span>
                        </div>

                    </div>

                    <div>
                        @can('update', $user)
                            <div class="mt-3">
                                <a href="{{ route('users.settings.edit') }}" class="btn btn-primary">Edit</a>
                            </div>
                        @endcan
                    </div>
                </div>

                <div class="px-2 mt-4">
                    <h5 class="fs-5"> Số dư khả dụng : </h5>
                    <p class="fs-6 fw-light">{{ number_format($user->account_balance, 0, '', ',') }} vnđ</p>

                    <h5 class="fs-5"> Email : </h5>
                    <p class="fs-6 fw-light">{{ $user->email }}</p>

                    <h5 class="fs-5"> Phone : </h5>
                    <p class="fs-6 fw-light">{{ $user->phone }}</p>

                    <h5 class="fs-5"> Facebook : </h5>
                    <p class="fs-6 fw-light">{{ $user->facebook }}</p>

                </div>
            </div>
        </div>
    </div>
@endsection
