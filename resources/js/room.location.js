var get_location = get_location || {};
get_location = {
    body: $(document.body),
    Window: $(window),
    current_district_id: 0,
    current_ward_id: 0,
    current_street_id: 0,
    is_requesting: false,

    getDistrict: function (city_id, current_district_id) {
        var self = this;
        self.current_district_id = current_district_id || 0;
        if (city_id == 0 || city_id == "") return;

        if (self.is_requesting) return;
        self.is_requesting = true;

        $.ajax({
            type: "POST",
            url: "/api/location/districts",
            data: {
                "city_id": city_id,
            },
            dataType: "JSON",
            success: function (response) {
                self.is_requesting = false;
                if (response.status_code == 200) {
                    $(".js-select-ward").empty();
                    $(".js-select-ward").select2({
                        "data": [{
                            id: "",
                            text: "-- Phường/Xã --"
                        }]
                    });

                    $(".js-select-street").empty();
                    $(".js-select-street").select2({
                        "data": [{
                            id: "",
                            text: "-- Đường/Phố --"
                        }]
                    });

                    $(".js-select-district").empty();
                    var results = $.map(response.districts, function (_district) {
                        return {
                            "id": _district.id,
                            "text": _district.name
                        };
                    });

                    results.unshift({
                        id: "",
                        text: "-- Quận/huyện --",
                    });
                    $('.js-select-district').select2({
                        'data': results,
                        placeholder: "Chọn quận / huyện"
                    });

                    if (self.current_district_id) {
						$(".js-select-district").val(self.current_district_id).trigger("change");
					}
                }
            },
            error: function (response) {
                self.is_requesting = false;
            }
        });
    },

    getWard: function (district_id, current_ward_id) {
        var self = this;

        self.current_ward_id = current_ward_id || 0;
        if (district_id == 0 || district_id == "") return;
        // if ($('.js-select-ward').length() <= 0) return;

        $.ajax({
            type: "POST",
            url: "/api/location/wards",
            data: {
                "district_id": district_id,
            },
            dataType: "JSON",
            success: function (response) {
                self.is_requesting = false;
                if (response.status_code == 200) {
                    $(".js-select-ward").empty();
                    var results = $.map(response.wards, function (_ward) {
                        return {
                            "id": _ward.id,
                            "text": _ward.name
                        };
                    });

                    results.unshift({
                        id: "",
                        text: "Chọn phường xã",
                    });

                    $(".js-select-ward").select2({
                        "data": results,
                        placeholder: "Chọn phường xã",
                    });

                    if (self.current_ward_id) {
                        $(".js-select-ward").val(self.current_ward_id).trigger("change");
                    }
                }
            },
            error: function (response) {
                self.is_requesting = false;
            }
        });
    },

    getStreet: function (district_id, current_street_id) {
        var self = this;

        self.current_street_id = current_street_id || 0;
        if (district_id == 0 || district_id == "") return;

        if (self.is_requesting) return;
        self.is_requesting = true;

        $.ajax({
            type: "POST",
            url: "/api/location/streets",
            data: {
                "district_id": district_id,
            },
            dataType: "JSON",
            success: function (response) {
                self.is_requesting = false;

                if (response.status_code == 200) {
                    $(".js-select-street").empty();
                    var results = $.map(response.streets, function (_street) {
                        return {
                            "id": _street.id,
                            "text": _street.name
                        };
                    });

                    results.unshift({
                        id: "",
                        text: "Chọn đường",
                    });

                    $(".js-select-street").select2({
                        "data": results,
                        placeholder: "Chọn đường",
                    });

                    if (self.current_street_id) {
                        $(".js-select-street").val(self.current_street_id).trigger("change");
                    }
                }
            },
            error: function (response) {
                self.is_requesting = false;
            }
        });
    },

    layoutFront: function () {
        var self = this;

        if ($.fn.select2) {
            $(".js-select-city").select2().on("change", function () {
                var city_id = $(this).val();

                if (city_id) {
                    self.getDistrict(city_id, self.current_district_id);
                }
            });

            $(".js-select-district").select2().on("change", function () {
                var district_id = $(this).val();

                if (district_id) {
                    self.getWard(district_id, self.current_ward_id);
                    self.getStreet(district_id, self.current_street_id);
                }
            });

            $(".js-select-street").select2({});
            $(".js-select-ward").select2({});
        }
    },

    init: function () {
        this.layoutFront();
    }
};

jQuery(document).ready(function ($) {
    get_location.init();
});
