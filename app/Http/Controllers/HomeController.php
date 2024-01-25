<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function category(Request $request, $slug, $id)
    {
        $category = Category::find($id);

        if (!$category) { abort(404); }

        $rooms = Room::where('category_id', $id)->orderByDesc('id')->paginate(20);

        return view('home.categories', compact('category'));
    }
}
