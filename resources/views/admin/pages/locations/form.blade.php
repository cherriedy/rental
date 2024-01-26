<form method="POST" id="create-location-form">
    @csrf
    <h1>@yield('header')</h1>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="col-form-label">Tên địa điểm</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="type" class="col-form-label">Phân loại</label>
                <select name="type" class="form-select">
                    <option value="2">Tỉnh/Thành</option>
                    <option value="1">Quận/Huyện</option>
                    <option value="3">Phường/Xã</option>
                    <option value="3">Đường</option>
                </select>
            </div>

            <div class="form-group">
                <label for="district" class="col-form-label">Tỉnh thành</label>
                <select name="district" class="form-select">
                    <option value="0">-------------</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status">
                    <label class="form-check-label" for="status">Nổi bật</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status">
                    <label class="form-check-label" for="status">Bình thường</label>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Xác nhận</button>
</form>
