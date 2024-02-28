@extends('layouts.layout')

@section('title', 'Dịch vụ tin nổi bật')

@section('content')
    {{-- HEADER --}}
    <div class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Gia hạn phòng</h1>

                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('profile') }}">{{ Auth::user()->name }}</a></li>
                        <li class="breadcrumb-item text-body" aria-current="page">Quản lý bài đăng</li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Gia hạn phòng</li>
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
        <div class="alert alert-dismissible alert-warning" role="alert">
            <h6 class="alert-heading">Nếu bạn đã từng đăng tin trên , hãy sử dụng chức năng ĐẨY TIN / GIA HẠN / NÂNG CẤP VIP
                trong mục QUẢN LÝ TIN ĐĂNG
                để làm mới, đẩy tin lên cao thay vì đăng tin mới. Tin đăng trùng nhau sẽ không được duyệt.</p>
                <h6>Xin cảm ơn!</p>
        </div>

        <form action="" method="POST" id="store-hot-service">
            @csrf
            <h5 class="h5">Chọn loại tin</h5>

            <div class="form-group">
                @foreach (config('rental.hotServiceOption') as $option => $service)
                    <div class="form-check">
                        <label for="ServiceID{{ $option }}" class="form-check-label">{{ $service['name'] }}</label>
                        <input type="radio" name="hotServiceOption" id="ServiceID{{ $option }}"
                            class="form-check-input" value="{{ $option }}"
                            {{ ($request['hotServiceOption'] ?? 0) == $option ? 'checked' : '' }}>
                    </div>
                @endforeach
            </div>

            <h5 class="h5 mt-3">Chọn ngày bắt đầu</h5>
            <input type="date" name="starting_date" id="starting_date">

            <h5 class="h5 mt-3">Chọn số ngày</h5>
            <div class="form-group mb-3 col-md-4">
                <input type="number" name="days" id="ServiceDay" class="form-control" min="1" max="20">
                <small class="d-block mt-2">Số ngày sử dụng không lớn hơn 20 ngày </small>
            </div>

            <button type="submit" class="btn btn-success">Xác nhận</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $('#store-hot-service').submit(function(e) {
            e.preventDefault();

            var url = '{{ route('rooms.hot-service', $room->id) }}';
            let formData = $('#store-hot-service').serialize();

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: "JSON",
                headers: [
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                ],
                success: function(response) {
                    if (response.status_code == 422) {
                        response.errors.forEach(erorr => {
                            $.notify(erorr, "error");
                        });
                    }
                },
                error: function(response) {
                    console.log('error');
                }
            });
        });
    </script>
@endsection
