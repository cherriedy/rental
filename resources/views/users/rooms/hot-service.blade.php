@extends('layouts.layout')

@section('title', 'Dịch vụ tin nổi bật')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ $room->user->name }}</li>
        <li class="breadcrumb-item">Quản lý phòng</li>
        <li class="breadcrumb-item active">Gia hạn phòng</li>
    </ol>

    <h1 class="h1">Gia hạn tin</h1>

    <div class="alert alert-dismissible alert-warning" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
                    <input type="radio" name="hotServiceOption" id="ServiceID{{ $option }}" class="form-check-input"
                        value="{{ $option }}" {{ ($request['hotServiceOption'] ?? 0) == $option ? 'checked' : '' }}>
                </div>
            @endforeach
        </div>

        <h5 class="h5">Chọn ngày bắt đầu</h5>
        <input type="date" name="starting_date" id="starting_date">

        <h5 class="h5">Chọn số ngày</h5>
        <div class="form-group mb-3 col-md-4">
            <label for="ServiceDay" class="">Số ngày sử dụng dịch vụ</label>
            <input type="number" name="days" id="ServiceDay" class="form-control" min="1" max="20">
        </div>

        <button type="submit" class="btn btn-success">Xác nhận</button>
    </form>
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
