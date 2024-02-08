<?php

namespace App\Services\Page;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\Core\RoomService;

class GetRoomByLocationService
{
    public static function indexByCity(Request $request, Location $location)
    {
        $params = $request->all();
        $params['city_id'] = $location->id;

        $rooms = RoomService::getListRoom($request, $params);
        // $districts = Location::withCount('roomDistricts')
        //     ->where('parent_id', $location->id)
        //     ->limit(24)
        //     ->get();

        $districts = Location::where('parent_id', $location->id)
            ->limit(24)
            ->get();

        return compact('location', 'districts', 'rooms');
    }

    public static function indexByDistrict(Request $request, Location $location)
    {
        $wards = Location::where('parent_id', $location->id)->get();

        if ($request->has('price_range') && $request->has('area_range') && $request->has('ward_id')) {
            $rooms = RoomService::getListRoom(
                $params = [
                    'district_id' => $location->id,
                    'price_range' => $request['price_range'] ? $request['price_range'] : -1,
                    'area_range' => $request['area_range'] ? $request['area_range'] : -1,
                    'ward_id' => $request['ward_id'] ? $request['ward_id'] : -1,
                ],
            );
        } elseif ($request->has('price_range')) {
            $rooms = RoomService::getListRoom([
                'district_id' => $location->id,
                'price_range' => $request['price_range'] ? $request['price_range'] : -1,
            ]);
        } elseif ($request->has('area_range')) {
            $rooms = RoomService::getListRoom([
                'district_id' => $location->id,
                'area_range' => $request['area_range'] ? $request['area_range'] : -1,
            ]);
        } elseif ($request->has('ward_id')) {
            $rooms = RoomService::getListRoom([
                'district_id' => $location->id,
                'ward_id' => $request['ward_id'] ? $request['ward_id'] : -1,
            ]);
        } else {
            $rooms = RoomService::getListRoom([
                'district_id' => $location->id,
            ]);
        }

        return compact('location', 'wards', 'rooms');
    }

    public static function indexByWard(Request $request, Location $location)
    {
        if ($request->has('price_range') && $request->has('area_range')) {
            $rooms = RoomService::getListRoom($request, [
                'ward_id' => $location->id,
                'price_range' => $request['price_range'] ? $request['price_range'] : -1,
                'area_range' => $request['area_range'] ? $request['area_range'] : -1,
            ]);
        } elseif ($request->has('price')) {
            $rooms = RoomService::getListRoom($request, [
                'ward_id' => $location->id,
                'price_range' => $request['price_range'] ? $request['price_range'] : -1,
            ]);
        } elseif ($request->has('area')) {
            $rooms = RoomService::getListRoom($request, [
                'ward_id' => $location->id,
                'area_range' => $request['area_range'] ? $request['area_range'] : -1,
            ]);
        } else {
            $rooms = RoomService::getListRoom($request, [
                'ward_id' => $location->id,
            ]);
        }

        return compact('location', 'rooms');
    }
}
