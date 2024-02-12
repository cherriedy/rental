@extends('layouts.layout')

@section('title', 'Đăng tin mới')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/profile" class="text-decoration-none">{{ Auth::user()->name }}</a></li>
        <li class="breadcrumb-item"><a href="\rooms" class="text-decoration-none">Quản lý phòng</a></li>
        <li class="breadcrumb-item active">Sửa tin</li>
    </ol>

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="h1">Sửa bài đăng (Mã tin: {{ $room->id }})</h1>
    </div>

    <hr>

    <form id="update-room-form" action="/" method="POST" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PUT')

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
                                    <option value="{{ $city->id }}"
                                        {{ ($room->city_id ?? 0) == $city->id ? 'selected' : '' }}>{{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="district_id" class="col-form-label ">Quận/Huyện</label>
                            <select name="district_id" class="form-control js-select2 js-select-district">
                                @foreach ($districts ?? [] as $district)
                                    <option value="{{ $district->id }}"
                                        {{ ($room->district_id ?? 0) == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ward_id" class="col-form-label ">Phường/Xã</label>
                            <select name="ward_id" class="form-control js-select2 js-select-ward">
                                @foreach ($wards ?? [] as $ward)
                                    <option value="{{ $ward->id }}"
                                        {{ ($room->ward_id ?? 0) == $ward->id ? 'selected' : '' }}>{{ $ward->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="street_id" class="col-form-label ">Đường/Phố</label>
                            <select name="street_id" class="form-control js-select2 js-select-street">
                                @foreach ($streets ?? [] as $street)
                                    <option value="{{ $street->id }}"
                                        {{ ($room->street_id ?? 0) == $street->id ? 'selected' : '' }}>{{ $street->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="apartment_number" class="col-form-label">Số nhà</label>
                        <div class="input-group">
                            <input type="text" name="apartment_number" class="form-control js-input-apartment_number"
                                value="{{ $room->apartment_number }}">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exact_address" class="col-form-label">Địa chỉ chính xác</label>
                            <input type="text" class="form-control" name="exact_address" readonly
                                value="{{ $room->exact_address }}">
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
                                <option value="{{ $category->id }}"
                                    {{ $room->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <label for="title" class="col-form-label">Tiêu đề</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="title" value="{{ $room->title }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <label for="description" class="col-form-label">Nội dung mô tả</label>
                    <div class="col-md-8">
                        <textarea name="description" class="form-control" rows="10" spellcheck="false" data-gram="false">{{ $room->description }}</textarea>
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
                            <input type="text" name="price" class="form-control"
                                value="{{ number_format($room->price, 0, '', ',') }}">

                            <div class="input-group-append">
                                <span class="input-group-text">đồng / tháng</span>
                            </div>
                        </div>
                    </div>

                    <small class="form-text text-muted">Nhập đầy đủ số, ví dụ 1 triệu thì nhập là
                        1000000</small>
                    <small class="text text-success"></small>
                </div>

                <div class="row mt-3">
                    <label for="area" class="col-form-label">Diện tích</label>

                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="number" pattern="[0-9.]+" name="area" class="form-control valid"
                                min="0" max="1000" aria-invalid="false" value="{{ $room->area }}">

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
                            <option value="0" {{ $room->subject_id == 0 ? 'selected' : '' }}>-- Tất cả --</option>
                            <option value="1" {{ $room->subject_id == 1 ? 'selected' : '' }}>Nam</option>
                            <option value="2" {{ $room->subject_id == 2 ? 'selected' : '' }}>Nữ</option>
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
                <div id="maps" style="width: 100%; height: 300px; margin-bottom: 30px;">
                    <iframe width="100%" height="100%" style="border:0" loading="lazy"
                        src="https://www.google.com/maps/embed/v1/place?q={{ $room->exact_address }}&key=AIzaSyCSlzzTKznvOMweDsjQG5Bc0n3CG9H2oHs"></iframe>
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
    <script type="text/javascript">
        var routes = {
            rooms: {
                update: "{{ route('rooms.update', $room->id) }}"
            },
            images: {
                store: "{{ route('images.store') }}",
                destroy: "{{ route('images.destroy') }}",
            },
            redirect: "{{ route('rooms.index') }}",
            csrf_token: "{{ csrf_token() }}"
        }
    </script>

    <script src="{{ Vite::asset('resources/js/room/room.edit.js') }}"></script>
@endsection
