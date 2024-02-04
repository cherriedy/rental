@extends('layouts.layout')

@section('title', 'Tạo mật khẩu mới')

@section('content')
    <form action="" method="POST" id="set-new-password-form">
        @csrf
        <div class="form-group">
            <label for="password"></label>
            <input type="text" class="form-control" name="password">
        </div>

        <div class="form-group">
            <label for="password-confirmation"></label>
            <input type="text" class="form-control" name="password-confirmation">
        </div>

        <button class="btn btn-success" type="submit">Xác nhận</button>
    </form>
@endsection

@section('script')
    <script>
        $.('#set-new-password-form').submit(function(e) {
            e.preventDefault();

            var url = '{{route('get-password', ['user' => $user, 'token' => $token)}}'
        });
    </script>
@endsection
