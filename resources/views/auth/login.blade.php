<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Nhà tốt: Đăng nhập</title>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <main>
        @include('shared.spinner')
        @include('shared.loading')

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 login-section-wrapper">
                    <div class="brand-wrapper">
                        <a href="{{ route('index') }}">
                            <img src="{{ Vite::asset('resources/images/logo-no-background.png') }}" alt="logo"
                                class="logo">
                        </a>
                    </div>
                    <div class="login-wrapper my-auto">
                        <h1 class="login-title">Đăng nhập</h1>

                        <form action="" method="POST" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" id="rememberme" name="rememberme">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Lưu phiên đăng nhập cho lần
                                    sau</label>
                            </div>

                            <input name="login" id="login" class="btn btn-block login-btn" type="submit"
                                value="Đăng nhập">
                        </form>

                        <a href="{{ route('forget-password') }}" class="forgot-password-link">Quên mật khẩu ?</a>
                        <p class="login-wrapper-footer-text">Không có tài khoản? <a href="{{ route('register') }}"
                                class="text-reset">Đăng kí tại đây</a></p>
                    </div>
                </div>

                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="https://images.unsplash.com/photo-1556020685-ae41abfc9365?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="login image" class="login-img">
                </div>
            </div>
        </div>
    </main>

    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> --}}

    {{-- BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- JQUERY --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- PUBLIC.JS --}}
    <script src="{{ Vite::asset('resources/js/public_theme.js') }}"></script>

    <script type="text/javascript">
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
                            window.location.replace('{{ route('admins.dashboard') }}');
                        } else {
                            window.location.replace('{{ route('index') }}');
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

</body>

</html>
