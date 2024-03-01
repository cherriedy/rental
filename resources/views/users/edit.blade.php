@extends('layouts.layout')

@section('title', $user->name)

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Thông tin cá nhân</h1>

                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                        </li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Thông tin cá nhân</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="{{ Vite::asset('resources/images/header.jpg') }}" alt="">
            </div>
        </div>
    </div>

    {{-- SEARCH BAR --}}
    @include('shared.blank-search-bar')

    {{-- MAIN CONTENT --}}
    <div class="main-content">
        <div class="row">
            <div class="col-md-3">
                <div class="section" style="padding: 12px; border-radius: 5px;">
                    <div class="section-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img style="width: 50px; height: 50px;" class="me-3 avatar-sm rounded-circle"
                                    src="{{ asset('images/' . $user->avatar) }}" alt="{{ $user->name }}">

                                <div>
                                    <h3 class="card-title fs-6 mb-0"><a
                                            href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></h3>
                                    <span class="text-muted" style="font-size: 12px;">@~{{ $user->name }}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="link-list area">
                        <ul style="padding-left: 0;">
                            <li><a href="">Thông tin cá nhân</a></li>
                            <li><a href="">Đổi mật khẩu</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">Hồ sơ cá nhân</h2>
                    </div>

                    <form method="POST" enctype="multipart/form-data" id="update-user-form">
                        @csrf
                        @method('PUT')

                        {{-- FILEPOND TEST --}}
                        {{-- <div style="width: 150px; height: 150px;" class="me-3">
                            <input type="file" class="filepond" name="image" id="image"
                                accept="image/png, image/jpeg, image/gif" />
                        </div> --}}

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="Họ và tên"
                                        value="{{ $user->name }}">
                                    <label for="name">Họ và tên</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" name="phone" placeholder="Số điện thoại"
                                        value="{{ $user->phone }}">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                        disabled>
                                    <label for="email">Email</label>
                                    <small class="form-text text-muted d-block mt-2">Email sử dụng để đăng nhập tài
                                        khoản.</small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="facebook" placeholder="Facebook"
                                        value="{{ $user->facebook }}">
                                    <label for="facebook">Facebook</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="introduction" placeholder="Viết vài dòng giới thiệu về gian hàng của bạn..."
                                        style="height: 150px;"></textarea>
                                    <label for="introduction">Giới thiệu</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-25 py-3">Lưu thay đổi</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
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
