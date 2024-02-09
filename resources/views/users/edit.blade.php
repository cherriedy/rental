@extends('layouts.layout')

@section('title', $user->name)

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item ">Profile</li>
        <li class="breadcrumb-item ">Edit</li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
    </ol>

    <div class="col-6">
        <div class="card">
            <div class="px-3 pt-4 pb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">

                        {{-- <img style="width: 150px" class="me-3 avatar-sm rounded-circle"
                            src="{{ url('storage/' . $user->avatar) }}" alt="{{ $user->name }}"> --}}

                        <div>
                            <h3 class="card-title mb-0"><a href="{{ route('profile') }}">{{ $user->name }}</a></h3>
                            <span class="fs-6 text-muted">@~{{ $user->name }}</span>
                        </div>

                    </div>
                </div>
            </div>

            <form class="px-4 py-4" method="POST" action="" enctype="multipart/form-data" id="update-user-form">
                @csrf
                @method('PUT')

                {{-- <div class="form-group">
                    <label for="" class="form-label mt-4">Avatar</label>
                    <input class="form-control" type="file" name="avatar">
                </div> --}}

                {{-- FILEPOND TEST --}}
                <div style="width: 150px; height: 150px;" class="me-3">
                    <input type="file" class="filepond" name="image" id="image"
                        accept="image/png, image/jpeg, image/gif" />
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label mt-4">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                    <small class="form-text text-muted">Email sử dụng để đăng nhập tài khoản!</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label mt-4">Phone</label>
                    <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label mt-4">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="{{ $user->facebook }}">
                </div>

                <a href="" class="d-block text-decoration-none mt-3">Đổi mật khẩu tài khoản</a>
                <a href="{{ route('profile') }}" class="btn btn-primary mt-2">Cancel</a>

                <button type="submit" class="btn btn-primary mt-2">Save</button>
            </form>
        </div>
    </div>
    </div>
@endsection

@section('script')


    <script type="module">
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
        );

        const inputElement = document.querySelector('input[name="image"]');
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                process: '{{ route('images.store') }}',
                revert: '{{ route('images.destroy') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            },
            allowImageEdit: true,
            labelIdle: `Kéo & thả ảnh hoặc <span class="filepond--label-action">Tải lên</span>`,
            imagePreviewHeight: 170,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
        });
    </script>

    <script type="text/javascript">
        $('#update-user-form').submit(function(e) {
            e.preventDefault();

            var url = '{{ route('users.settings.update') }}';
            let formData = $('#update-user-form').serialize();

            $.ajax({
                type: "PUT",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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
                        setTimeout(() => {
                            window.location.replace('{{ route('profile') }}');
                        }, 1500);
                    }
                },
                error: function(response) {
                    $.notify('Ầy, có vẻ là lỗi rồi!', "error");
                }
            });
        });
    </script>
@endsection
