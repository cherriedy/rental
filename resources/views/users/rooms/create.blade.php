@extends('layouts.layout')

@section('title', 'Đăng tin mới')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/profile" class="text-decoration-none">{{ Auth::user()->name }}</a></li>
        <li class="breadcrumb-item"><a href="\rooms" class="text-decoration-none">Quản lý phòng</a></li>
        <li class="breadcrumb-item active">Đăng tin mới</li>
    </ol>

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="h1">Đăng tin mới</h1>
    </div>

    <hr>

    <form id="create-room-form" action="/" method="POST" enctype="multipart/form-data" class="form-horizontal">
        @csrf

        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Địa chỉ cho thuê</h3>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="city_id" class="col-form-label ">Tỉnh/Thành phố </label>
                            <select name="city_id" class="form-control js-select2 js-select-city">
                                <option value="">-- Chọn Tỉnh/TP --</option>
                                @foreach ($cities ?? [] as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="district_id" class="col-form-label ">Quận/Huyện</label>
                            <select name="district_id" class="form-control js-select2 js-select-district">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ward_id" class="col-form-label ">Phường/Xã</label>
                            <select name="ward_id" class="form-control js-select2 js-select-ward">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="street_id" class="col-form-label ">Đường/Phố</label>
                            <select name="street_id" class="form-control js-select2 js-select-street">
                            </select>
                        </div>
                    </div>
                </div>

                {{-- <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="apartment_number" class="col-form-label">Số nhà</label>
                        <div class="input-group">
                            <input type="text" name="apartment_number" class="form-control js-input-apartment_number">
                        </div>
                    </div>
                </div> --}}

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="apartment_number" class="col-form-label">Số nhà</label>
                        <div class="input-group">
                            <input type="text" name="apartment_number" class="form-control js-input-apartment_number"
                                value="">
                        </div>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exact_address" class="col-form-label">Địa chỉ chính xác</label>
                            <input type="text" class="form-control" name="exact_address" value="" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <h3>Thông tin mô tả</h3>
                </div>

                <div class="row mt-3">
                    <label for="category_id" class="col-form-label">Loại chuyên mục</label>
                    <div class="col-md-6">
                        <select name="category_id" class="form-control js-select2">
                            <option value="">-- Chọn loại chuyên mục --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <label for="title" class="col-form-label">Tiêu đề</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="title" value="">
                    </div>
                </div>

                <div class="row mt-3">
                    <label for="description" class="col-form-label">Nội dung mô tả</label>
                    <div class="col-md-8">
                        <textarea name="description" class="form-control" rows="10" spellcheck="false" data-gram="false"></textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <label for="name" class="col-form-label">Thông tin liên hệ</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="name" class="form-control valid"
                                value="{{ auth()->user()->name }}" disabled="disable" aria-invalid="false">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <label for="phone" class="col-form-label">Điện thoại</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="phone" name="phone" class="form-control valid"
                                value="{{ auth()->user()->phone }}" disabled="disable" aria-invalid="false">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <label for="price" class="col-form-label">Giá cho thuê</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="price" class="form-control" pattern="[0-9.]+">

                            <div class="input-group-append">
                                <span class="input-group-text">đồng / tháng</span>
                            </div>
                        </div>
                    </div>

                    <small class="form-text text-muted">Nhập đầy đủ số, ví dụ 1 triệu thì nhập là
                        1000000</small>
                </div>

                <div class="row mt-3">
                    <label for="area" class="col-form-label">Diện tích</label>

                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="number" pattern="[0-9.]+" name="area" class="form-control valid"
                                min="0" max="1000" aria-invalid="false">

                            <div class="input-group-append">
                                <span class="input-group-text">m2</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <label for="subject_id" class="col-form-label">Đối tượng cho thuê</label>

                    <div class="col-md-6">
                        <select name="subject_id" class="form-control">
                            <option value="0">-- Tất cả --</option>
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-8">
                        <h3>Hình ảnh</h3>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-8">
                        <input type="file" name="image" id="image" class="filepond" multiple
                            data-allow-reorder="true" data-max-file-size="3MB" data-max-files="10">
                    </div>
                </div>


                <div class="row mt-5">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Tiếp tục</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div style="width: 100%; height: 300px; margin-bottom: 30px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.8167703610898!2d106.71605791074683!3d10.825329989281883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752883dd4ceea5%3A0xb7add6f6be271dc7!2zQ2h1bmcgQ8awIE3hu7kgTG9uZw!5e0!3m2!1svi!2s!4v1705160517776!5m2!1svi!2s"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="card mb-5" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                    <div class="card-body">
                        <h4 class="card-title">Lưu ý khi đăng tin</h4>
                        <ul>
                            <li style="list-style-type: square;">Nội dung phải viết bằng tiếng Việt có dấu</li>
                            <li style="list-style-type: square;">Tiêu đề tin không dài quá 100 kí tự</li>
                            <li style="list-style-type: square;">Các bạn nên điền đầy đủ thông tin vào các mục để
                                tin
                                đăng
                                có hiệu quả hơn.</li>
                            <li style="list-style-type: square;">Để tăng độ tin cậy và tin rao được nhiều người
                                quan tâm hơn, hãy sửa vị trí tin rao của bạn trên bản đồ bằng cách kéo icon tới đúng vị
                                trí của tin rao.
                            </li>
                            <li style="list-style-type: square;">Tin đăng có hình ảnh rõ ràng sẽ được xem và gọi
                                gấp nhiều lần so với tin rao không có ảnh. Hãy đăng ảnh để được giao dịch nhanh chóng!
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);

        const inputElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                process: '{{ route('images.store') }}',
                revert: '{{ route('images.destroy') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            },
            allowImagePreview: true,
            imagePreviewMaxHeight: 150,
        });


        $('#create-room-form').submit(function(e) {
            e.preventDefault();

            var url = '{{ route('rooms.store') }}';
            let formData = $('#create-room-form').serialize();

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
                        window.location.replace('http://127.0.0.1:8000/rooms');
                    }
                },
                error: function(response) {
                    $.notify('Ầy, có vẻ là lỗi rồi!', "erorr");
                }
            });
        });
    </script>

@endsection
