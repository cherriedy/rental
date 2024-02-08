<?php

namespace App\Services\Page;

use App\Services\Core\RoomService;
use Illuminate\Http\Request;

class SearchRoomService
{
    public static function index(Request $request)
    {
        $params = array_merge($request->all(), [
            $params['city_id'] = $request['city_id'] ?? null,
            $params['ward_id'] = $request['ward_id'] ?? null,
            $params['area_id'] = $request['area_id'] ?? null,
            $params['district_id'] = $request['district_id'] ?? null,
            $params['price_range'] = $request['price_range'] ?? null,
        ]);

        $rooms = RoomService::getListRoom($request, $params);

        return compact('rooms');
    }
}
