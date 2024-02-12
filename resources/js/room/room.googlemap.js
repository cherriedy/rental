jQuery(document).ready(function () {
    $('.js-select-city, .js-select-district, .js-select-ward, .js-select-street, .js-input-apartment_number').change(function () {
        getExactAddress();
    });

    // $('.js-input-apartment_number').donetyping(function () {
    //     getExactAddress();
    // });

    function getExactAddress() {
        var city = '';
        if ($('.js-select-city').val() != '' && $('.js-select-city').val() != 0) {
            city = $('.js-select-city option:selected').text();
        }

        var district = '';
        if ($('.js-select-district').val() != '' && $('.js-select-district').val() != 0) {
            district = $('.js-select-district option:selected').text() + ', ';
        }

        var ward = '';
        if ($('.js-select-ward').val() != '' && $('.js-select-ward').val() != 0) {
            ward = $('.js-select-ward option:selected').text() + ', ';
        }

        var street = '';
        if ($('.js-select-street').val() != '' && $('.js-select-street').val() != 0) {
            // var apartment_number = $('.js-input-apartment_number').val();
            // street = (apartment_number ? apartment_number + ' ' : '') + $('.js-select-street option:selected').text() + ', ';
            street = $('.js-select-street option:selected').text() + ', ';
        }

        var apartment_number = '';
        if ($('.js-input-apartment_number').val()) {
            apartment_number = $('.js-input-apartment_number').val() + ' ';
        }

        if ($('input[name="exact_address"]').length) {
            var _address = apartment_number + street + ward + district + city;
            $('input[name="exact_address"]').val(_address);
            $('input[name="exact_address"]').focus();
            $('input[name="exact_address"]').get(0).setSelectionRange(0, 0);
            $('#maps').find('iframe').attr('src', 'https://maps.googleapis.com/maps/embed/v1/place?key=AIzaSyCSlzzTKznvOMweDsjQG5Bc0n3CG9H2oHs&q=' + _address);
        }
    }
});
