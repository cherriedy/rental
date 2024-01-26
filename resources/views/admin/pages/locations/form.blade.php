<form method="POST" id="create-location-form">
    @csrf
    <h1>@yield('header')</h1>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="col-form-label">Tên địa điểm</label>
                <input type="text" name="name" class="form-control" value="{{ $location->name ?? '' }}">
            </div>

            <div class="form-group">
                <label for="type" class="col-form-label">Phân loại</label>
                <select name="type" class="form-select">
                    <option {{ ($location->type ?? 0) == 1 ? 'selected' : '' }} value="1">Tỉnh/Thành</option>
                    <option {{ ($location->type ?? 0) == 2 ? 'selected' : '' }} value="2">Quận/Huyện</option>
                    <option {{ ($location->type ?? 0) == 3 ? 'selected' : '' }} value="3">Phường/Xã</option>
                    <option {{ ($location->type ?? 0) == 4 ? 'selected' : '' }} value="4">Đường</option>
                </select>
            </div>

            <div class="form-group">
                <label for="parent_id" class="col-form-label">Tỉnh thành</label>
                <select name="parent_id" class="form-select">
                    <option value="0">-------------</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}"
                            {{ ($location->parent_id ?? 0) == $city->id ? 'selected' : '' }}>{{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status-hot" value="1"
                        {{ ($location->status ?? 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status-hot">Mặc định</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status-default" value="2"
                        {{ ($location->status ?? 0) == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status-default">Nổi bật</label>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Xác nhận</button>
</form>
