<div id="searchbar">
    <form method="" action="" class="searchform js-form-submit-data">
        <div class="search_field container" style="justify-content: space-between">
            <style>
                .search_field_item {
                    width: 100% !important;
                }
            </style>
            <div class="search_field_item search_field_item_loaitin">
                <label class="search_field_item_label">Loại tin</label>
                <select id="search_room_type" class="form-control js_select2_room_type" name="danhmuc_id">
                    <option value="">Tất cả</option>
                </select>
            </div>

            <div class="search_field_item search_field_item_quanhuyen ">
                <label class="search_field_item_label">Phường xã</label>
                <select name="phuongxa_id" class="form-control " id="phuongxa_id"
                    data-placeholder="Click chọn quận huyện">
                    <option value="">Chọn phường xã</option>
                </select>
            </div>
            <div class="search_field_item search_field_item_mucgia">
                <label class="search_field_item_label">Khoảng giá</label>
                <select class="form-control price js_select2_price" name="price">
                    <option value="">Chọn mức giá</option>
                </select>
            </div>
            <div class="search_field_item search_field_item_dientich">
                <label class="search_field_item_label">Diện tích</label>
                <select id="search_dientich" name="khuvuc" class="form-control js_select2_acreage">
                    <option value="">Chọn diện tích</option>
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
