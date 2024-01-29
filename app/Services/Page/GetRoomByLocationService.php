<?php

namespace App\Services\Page;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\Core\RoomService;

class GetRoomByLocationService
{
    public static function indexByCity(Request $request, Location $location) {
        $params = $request->all();
        $params['city_id'] = $location->id;

        $rooms = RoomService::getListRoom($request, $params);
        // $districts = Location::withCount('roomDistricts')
        //     ->where('parent_id', $location->id)
        //     ->limit(24)
        //     ->get();

        $districts = Location::where('parent_id', $location->id)->limit(24)->get();

        return compact('location', 'districts', 'rooms');
    }

    public static function indexByDistrict(Request $request, Location $location) {
        $wards = Location::where('parent_id', $location->id)->get();

        if ($request->has('price') && $request->has('area')) {
            $rooms = RoomService::getListRoom($request, [
                'district_id' => $location->id,
                'price' => $request['price'],
                'area' => $request['area'],
            ]);
        } elseif ($request->has('price')) {
            $rooms = RoomService::getListRoom($request, [
                'district_id' => $location->id,
                'price' => $request['price'],
            ]);
        } elseif($request->has('area')) {
            $rooms = RoomService::getListRoom($request, [
                'district_id' => $location->id,
                'area' => $request['area'],
            ]);
        } else {
            $rooms = RoomService::getListRoom($request, [
                'district_id' => $location->id,
            ]);
        }

        return compact('location', 'wards', 'rooms');
    }

    public static function indexByWard(Request $request, Location $location) {
        if ($request->has('price') && $request->has('area')) {
            $rooms = RoomService::getListRoom($request, [
                'ward_id' => $location->id,
                'price' => $request['price'],
                'area' => $request['area'],
            ]);
        } elseif($request->has('price')) {
            $rooms = RoomService::getListRoom($request, [
                'ward_id' => $location->id,
                'price' => $request['price'],
            ]);
        } elseif($request->has('area')) {
            $rooms = RoomService::getListRoom($request, [
                'ward_id' => $location->id,
                'area' => $request['area'],
            ]);
        } else {
            $rooms = RoomService::getListRoom($request, [
                'ward_id' => $location->id,
            ]);
        }

        return compact('location', 'rooms');
    }
}
