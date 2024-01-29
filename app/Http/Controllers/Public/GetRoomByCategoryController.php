<?php

namespace App\Http\Controllers\Public;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Page\GetRoomByCategoryService;

class GetRoomByCategoryController extends Controller
{
    public function index(Request $request, $slug, Category $category) {
        $viewData = GetRoomByCategoryService::index($request, $category);

        return view('public.pages.categories.index-dev', $viewData);
    }
}
