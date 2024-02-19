import './bootstrap'
import 'bootstrap'
import './notify'
import 'select2'
import './jquery.donetyping'
import './room/room.location'
import './room/room.googlemap'

import.meta.glob(['../images/**']);


function formatMoney(n) {
    if (n < 1e3) return n + " đồng/tháng";
    if (n >= 1e3 && n < 1e6) return +(n / 1e3).toFixed(1) + " ngàn/tháng";
    if (n >= 1e6 && n < 1e9) return +(n / 1e6).toFixed(1) + " triệu/tháng";
    if (n >= 1e9 && n < 1e12) return +(n / 1e9).toFixed(1) + " tỷ/tháng";
    if (n >= 1e12) return +(n / 1e12).toFixed(1) + "T";
}

$(document).ready(function () {
    $('.post-price').each(function () {
        $(this).text(formatMoney($(this).text()));
    });

});
