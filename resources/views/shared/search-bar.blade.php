<div id="searchbar">
    <form method="POST" action="{{ route('search') }}" class="searchform js-form-submit-data">
        @csrf
        <div class="search_field container" style="justify-content: space-between">
            <style>
                .search_field_item {
                    width: 100% !important;
                }
            </style>
            <div class="search_field_item search_field_item_loaitin">
                <label class="search_field_item_label">Loại tin</label>
                <select class="form-control js_select2_room_type" name="category_id">
                    <option value="">Tất cả</option>
                    @foreach ($_CATEGORY as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="search_field_item search_field_item_quanhuyen ">
                <div class="form-group">
                    <label class="search_field_item_label">Tỉnh/Thành</label>
                    <select name="city_id" class="form-control js-select-city">
                        <option value="">Chọn tỉnh/thành</option>
                        @foreach ($_CITY as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="search_field_item search_field_item_quanhuyen ">
                <label class="search_field_item_label">Quận/Huyện</label>
                <select name="district_id" class="form-control js-select-district">
                    <option value="">Chọn phường xã</option>
                </select>
            </div>

            <div class="search_field_item search_field_item_quanhuyen ">
                <label class="search_field_item_label">Phường/Xã</label>
                <select name="ward_id" class="form-control js-select-ward">
                    <option value="">Chọn phường xã</option>
                </select>
            </div>

            <div class="search_field_item search_field_item_mucgia">
                <label class="search_field_item_label">Khoảng giá</label>
                <select class="form-control price js_select2_price" name="price_range">
                    <option value="">Chọn mức giá</option>
                    @foreach ($_PRICE_RANGE as $key => $item)
                        <option value="{{ $key }}"
                            {{ (request()->price_range ?? 0) == $key ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search_field_item search_field_item_dientich">
                <label class="search_field_item_label">Diện tích</label>
                <select name="area_range" class="form-control js_select2_acreage">
                    <option value="">Chọn diện tích</option>
                    @foreach ($_AREA_RANGE as $key => $item)
                        <option value="{{ $key }}"
                            {{ (request()->area_range ?? 0) == $key ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search_field_item search_field_item_submit">
                <label class="search_field_item_label mb-item-label">&nbsp;</label>
                <div>
                    <button type="submit" class="btn btn-default btn_search_box form-control"> Tìm kiếm </button>
                </div>
            </div>
        </div>
    </form>
</div>
