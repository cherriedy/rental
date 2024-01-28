jQuery(document).ready(function () {
    $('.js-select-city, .js-select-district, .js-select-ward, .js-select-street').change(function () {
        getExactAddress();
        // console.log('okay');
    });

    // $('.js-input-apartment_number').donetyping(function() {
    //     getExactAddress();
    // }, 1000);

    // var typingTimer;
    // var doneTypingInterval = 1000;

    // $('.js-input-apartment_number').on('keyup', function () {
    //     clearTimeout(typingTimer);
    //     typingTimer = setTimeout(getExactAddress, doneTypingInterval);
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
            var aparment_number = $('.js-input-apartment_number').val();
            street = (aparment_number ? aparment_number + ' ' : '') + $('.js-select-street option:selected').text() +', ';
        }

        if ($('input[name="exact_address"]').length) {
            var _address = street + ward + district + city;
            $('input[name="exact_address"]').val(_address);
            $('input[name="exact_address"]').focus();
            $('input[name="exact_address"]').get(0).setSelectionRange(0, 0);
        }
    }
});
