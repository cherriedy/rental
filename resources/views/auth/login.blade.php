@extends('layouts.layout')

@section('title', 'Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            @include('shared.loading')

            <form class="form mt-5" action="" method="POST" id="login-form">
                @csrf
                <h3 class="text-center text-dark">Đăng nhập</h3>

                <div class="form-group">
                    <label for="email" class="text-dark">Email:</label><br>
                    <input type="text" name="email" class="form-control">
                </div>


                <div class="form-group mt-3">
                    <label for="password" class="text-dark">Mật khẩu:</label><br>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="remember-me" class="text-dark"></label><br>
                    <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
                </div>
                <div class="text-right mt-2">
                    <a href="/register" class="text-dark">Register here</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#login-form').submit(function(e) {
            e.preventDefault();

            $('#loading').show();

            var url = '{{ route('login') }}';
            let formData = $('#login-form').serialize();

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    $('#loading').hide();

                    if (response.status_code == 422) {
                        response.errors.forEach(error => {
                            $.notify(error, "error");
                        });
                    } else if (response.status_code == 200) {
                        $.notify(response.message, "success");

                        if (response.isAdmin) {
                            setTimeout(() => {
                                window.location.replace('{{ route('admins.dashboard') }}');
                            }, 1500);
                        } else {
                            setTimeout(() => {
                                window.location.replace('{{ route('index') }}');
                            }, 1500);
                        }
                    }
                },
                error: function(response) {
                    $('#loading').hide();

                    $.notify('Vui lòng kiểm tra lại email hoặc mật khẩu.', "error");
                }
            });
        });
    </script>
@endsection
