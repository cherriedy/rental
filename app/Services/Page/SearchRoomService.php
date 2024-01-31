<?php

namespace App\Services\Page;

use App\Services\Core\RoomService;
use Illuminate\Http\Request;

class SearchRoomService
{
    public static function index(Request $request)
    {
        $params = request()->all();

        if (isset($request['city_id'])) {
            $params['city_id'] = $request['city_id'];
        }

        if (isset($request['district_id'])) {
            $params['district_id'] = $request['district_id'];
        }

        if (isset($request['ward_id'])) {
            $params['ward_id'] = $request['ward_id'];
        }

        if (isset($request['area'])) {
            $params['area'] = $request['area'];
        }

        if (isset($request['price_range'])) {
            $params['price_range'] = $request['price_range'];
        }

        $rooms = RoomService::getListRoom($request, $params);

        return compact('rooms');
    }
}
