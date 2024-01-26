<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create() {
        return view('admin.pages.categories.create');
    }

    public function store(Request $request) {
        try {
            $category = $request->except('_token');

            $category['slug'] = Str::slug($category['name']);
            $category['created_at'] = Carbon::now();
            Category::create($category);

            return redirect()->route('admins.categories.index');
        } catch (Exception $exception) {
        }
    }

    public function edit(Category $category) {
        return view('admin.pages.categories.update', compact('category'));
    }

    public function update(Request $request, Category $category) {
        try {
            $categoryData = $request->except('_token');

            if ($request->has('name')) {
                $categoryData['slug'] = Str::slug($categoryData['name']);
            }
            $categoryData['updated_at'] = Carbon::now();

            $category->update($categoryData);

            return redirect()->route('admins.categories.index');

        } catch(Exception $exception){
        }
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('admins.categories.index');
    }
}
