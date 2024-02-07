@extends('layouts.layout')

@section('title', 'Quên mật khẩu')

@section('content')
    @include('shared.loading')

    <div class="b-auth">
        <div class="auth-header">
            <h1 class="title">Quên mật khẩu</h1>
        </div>
        <div class="auth-content">
            <form action="" method="POST" autocomplete="off" id="forget-password-form">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" require placeholder="" name="email">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-blue btn-submit" style="background-color: #102136"> Xác
                        nhận</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#forget-password-form').submit(function(e) {
            e.preventDefault();

            $('#loading').show();

            var url = '{{ route('forget-password') }}';
            let formData = $('#forget-password-form').serialize();

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#loading').hide();

                    if (response.status_code == 422) {
                        response.errors.forEach(error => {
                            $.notify(error, "error");
                        });
                    } else if (response.status_code == 200) {
                        $.notify(response.message, "success");
                        // window.location.replace('{{ route('index') }}'');
                    }
                },
                error: function(response) {
                    $('#loading').hide();
                    $.notify('Ầy, có vẻ là lỗi rồi!', "erorr");
                }
            });
        });
    </script>
@endsection
