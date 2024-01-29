<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Services\Page\GetRoomByCategoryService;
use App\Services\Page\GetRoomByLocationService;
use Illuminate\Http\Request;

class GetRoomByLocationController extends Controller
{
    public function city($slug, Location $city, Request $request) {
        $viewDatas = GetRoomByLocationService::indexByCity($request, $city);

        return view('public.pages.locations.index', $viewDatas);
    }

    public function district($slug, Location $district, Request $request) {
        $viewData = GetRoomByLocationService::indexByDistrict($request, $district);

        return view('public.pages.locations.index', $viewData);
    }

    public function ward($slug, Location $ward, Request $request) {
        $viewData = GetRoomByLocationService::indexByWard($request, $ward);

        return view('public.pages.locations.index', $viewData);
    }

}
