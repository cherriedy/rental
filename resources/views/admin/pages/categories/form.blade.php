<form method="POST" id="create-category-form">
    @csrf
    <h1>@yield('header')</h1>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="col-form-label">Tên danh mục</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name ?? '' }}">
            </div>

            <div class="form-group">
                <label for="title" class="col-form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ $category->title ?? '' }}">
            </div>

            <div class="form-group">
                <label for="description" class="col-form-label">Mô tả</label>
                <textarea name="description" rows="10" class="form-control"></textarea>
            </div>

            <div class="mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status-show" value="1">
                    <label class="form-check-label" for="status-show">Hiển thị</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status-hide" value="2">
                    <label class="form-check-label" for="status-hide">Tạm ẩn</label>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Xác nhận</button>
</form>
