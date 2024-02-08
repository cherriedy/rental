<?php

namespace App\Services\Page;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\Core\RoomService;
use App\Services\Core\GetRoomService;

class GetRoomByCategoryService
{
    public static function index(Request $request, Category $category)
    {
        $rooms = RoomService::getListRoom(
            $params = array_merge($request->all(), [
                'category_id' => $category->id,
            ]),
        );

        return compact('rooms', 'category');
    }
}
