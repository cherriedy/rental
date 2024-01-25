@extends('layouts.layout')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5" action="{{ route('register') }}" method="POST" id="create-user-form">
                @csrf
                <h3 class="text-center text-dark">Register</h3>

                <div class="form-group">
                    <label for="name" class="text-dark">Name:</label><br>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email" class="text-dark">Email:</label><br>
                    <input type="text" name="email" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="password" class="text-dark">Password:</label><br>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group mt-3">
                    <label for="password-confirmation" class="text-dark">Confirm Password:</label><br>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div>
                    @error('RegisterError')
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="remember-me" class="text-dark"></label><br>
                    <input type="submit" name="submit" class="btn btn-dark btn-md" value="Submit">
                </div>

                <div class="text-right mt-2">
                    <a href="/login" class="text-dark">Login here</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#create-user-form').submit(function(e) {
            e.preventDefault();

            var url = '{{ route('api.users.store') }}';
            let formData = $('#create-user-form').serialize();

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                dataType: "JSON",
                success: function(response) {
                    if (response.status_code == 422) {
                        response.errors.forEach(error => {
                            $.notify(error, "error");
                        });
                    } else if (response.status_code == 200) {
                        $.notify(response.message, "success");
                    }
                },
                error: function(response) {
                    $.notify('Ầy, có vẻ là lỗi rồi!', "erorr");
                }
            });
        });
    </script>
@endsection
