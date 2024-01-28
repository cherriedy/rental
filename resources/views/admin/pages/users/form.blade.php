<form method="POST" id="create-category-form">
    @csrf
    <h1>@yield('header')</h1>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="col-form-label">Tên người dùng</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name ?? '' }}">
            </div>

            <div class="form-group">
                <label for="email" class="col-form-label">Email</label>
                <input type="text" name="email" class="form-control" value="{{ $user->email ?? '' }}">
            </div>

            <div class="form-group">
                <label for="phone" class="col-form-label">Số điện thoại</label>
                <input type="tel" name="phone" class="form-control" value="{{ $user->phone ?? '' }}">
            </div>

            <div class="form-group">
                <label for="password" class="col-form-label">Mật khẩu</label>
                <input type="text" name="password" class="form-control" value="" {{ $user->password != null ? 'disabled' : '' }}>
            </div>

            <div class="mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isAdmin" value="1"
                        {{ ($user->isAdmin ?? -1) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="isAdmin">Quản trị viên</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isAdmin" value="0"
                        {{ ($user->isAdmin ?? -1) == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="isAdmin">Người dùng</label>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Xác nhận</button>
</form>
