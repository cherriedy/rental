<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Page\SearchRoomService;

class SearchRoomController extends Controller
{
    public function __invoke(Request $request) {
        $viewData = SearchRoomService::index($request);

        return view('public.pages.search-result.index', $viewData);
    }
}
