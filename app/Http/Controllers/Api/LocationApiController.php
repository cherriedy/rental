<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationApiController extends Controller
{
    public function getDistrict(Request $request)
    {
        $districts = location::select('id', 'name')
            ->where(['parent_id' => $request->city_id, 'type' => 2])
            ->get();

        if ($districts) {
            return response()->json([
                'districts' => $districts,
                'status_code' => 200,
            ]);
        }
    }

    public function getWard(Request $request)
    {
        $wards = location::select('id', 'name')
            ->where(['parent_id' => $request->district_id, 'type' => 3])
            ->get();

        if ($wards) {
            return response()->json([
                'wards' => $wards,
                'status_code' => 200,
            ]);
        }
    }

    public function getStreet(Request $request)
    {
        $streets = location::select('id', 'name')
            ->where(['parent_id' => $request->district_id, 'type' => 4])
            ->get();

        if ($streets) {
            return response()->json([
                'streets' => $streets,
                'status_code' => 200,
            ]);
        }
    }

}
