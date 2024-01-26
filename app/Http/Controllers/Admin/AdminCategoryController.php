<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class AdminCategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create(Request $request) {
        return view('admin.pages.categories.create');
    }

    public function store(Request $request) {
        try {
            $category = $request->except('_token');

            $category['slug'] = Str::slug($category['name']);
            $category['created_at'] = Carbon::now();

            return redirect()->route('admins.categories.index');
        } catch (Exception $exception) {
        }
    }
}
