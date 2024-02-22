{{-- <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
            <div class="col-md-10">
                <div class="row g-2">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                    </div>

                    <div class="col-md-4">
                        <select class="form-select border-0 py-3">
                            <option selected>Property Type</option>
                            <option value="1">Property Type 1</option>
                            <option value="2">Property Type 2</option>
                            <option value="3">Property Type 3</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-select border-0 py-3">
                            <option selected>Property Type</option>
                            <option value="1">Property Type 1</option>
                            <option value="2">Property Type 2</option>
                            <option value="3">Property Type 3</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-select border-0 py-3">
                            <option selected>Location</option>
                            <option value="1">Location 1</option>
                            <option value="2">Location 2</option>
                            <option value="3">Location 3</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-dark border-0 w-100 py-3">Search</button>
            </div>
    </div>
</div> --}}

<div class="filter-top-inner">
    <section class="filter-top bg-primary">
        <div class="filter-body">
            <div class="filter-item active post-category js-show-popup-category">
                <span class="item-content">Phòng trọ, nhà trọ</span>
                <span class="item-delete"></span>
            </div>

            <div class="filter-item post-location js-show-popup-city">
                <span class="item-content">Toàn quốc</span>
            </div>

            <div class="filter-item post-price js-show-popup-price">
                <span class="item-content">Chọn giá</span>
            </div>

            <div class="filter-item post-area js-show-popup-area">
                <span class="item-content">Chọn diện tích</span>
            </div>

            <div class="filter-item submit">
                <span class="item-content">Tìm kiếm</span>
            </div>
        </div>

        <div class="filter-popup js-filter-popup js-filter-popup-category">
            <div class="filter-popup-header">
                <span class="header-label">Chọn dạnh mục</span>
                <div class="popup-close _js-filter-popup-close _js-filter-popup-city-close">Đóng</div>
            </div>

            <div class="filter-popup-body">
                <div id="filter-popup-category-option" class="filter-popup-option">
                    <ul>
                        @foreach ($_CATEGORY as $category)
                            <li>{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="filter-popup js-filter-popup js-filter-popup-city">
            <div class="filter-popup-header">
                <span class="header-label">Chọn tỉnh thành</span>
                <div class="popup-close _js-filter-popup-close _js-filter-popup-city-close">Đóng</div>
            </div>

            <div class="filter-popup-body">
                <div id="filter-popup-city-option" class="filter-popup-option">
                    <ul>
                        @foreach ($_CITY as $city)
                            <li>{{ $city->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="black-overlay js-black-overlay"></div>
</div>

<script>
    $(document).ready(function () {
        var categoryPopUp = $('');

        if (createBundleRenderer).on('click', function () {
            $('.js-black-overlay').css('display', 'block');
        });
    });
</script>
