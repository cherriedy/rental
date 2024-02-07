@extends('layouts.layout')

@section('title', 'Tạo mật khẩu mới')

@section('content')
    @include('shared.loading')

    <form action="" method="POST" id="set-new-password-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="password">Nhập mật khẩu</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group my-3">
            <label for="password_confirmation">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>

        <button class="btn btn-success" type="submit">Xác nhận</button>
    </form>
@endsection

@section('script')
    <script>
        $('#set-new-password-form').submit(function(e) {
            e.preventDefault();

            $('#loading').show();

            var url = '{{ route('get-password', ['user' => $user, 'token' => $token]) }}'
            let formData = $('#set-new-password-form').serialize();

            $.ajax({
                type: "PUT",
                url: url,
                data: formData,
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
                },
                success: function(response) {
                    $('#loading').hide();

                    if (response.status_code == 422) {
                        response.errors.forEach(error => {
                            $.notify(error, "error");
                        });
                    } else if (response.status_code == 200) {
                        $.notify(response.message, "success");
                        setTimeout(() => {
                            window.location.replace('{{ route('login') }}');
                        }, 1500);
                    }
                },
                error: function(response) {
                    $('#loading').hide();
                    $.notify('Ầy, hình như có lỗi', "erorr");
                }
            });
        });
    </script>
@endsection
