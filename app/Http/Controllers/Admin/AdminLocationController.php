<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLocationController extends Controller
{
    public function index() {
        $locations = Location::where('type', 1)->get();

        return view('admin.pages.locations.index', compact('locations'));
    }

    public function create() {
        $cities = Location::where('type', 1)->get();

        return view('admin.pages.locations.create', compact('cities'));
    }

    public function store(Request $request) {
        try {
            $location = $request->except('_token');

            $location['slug'] = Str::slug($location['name']);
            $location['title'] = $location['title'] ?? $location['name'];
            $location['description'] = $location['description'] ?? 'Không có mô tả.';
            $location['created_at'] = Carbon::now();

            Location::create($location);

            return redirect()->route('admins.locations.index');
        } catch(Exception $exception) {
            return response()->json([
                'status_code' => '500',
                'message' => 'Ầy, có vẻ bạn đang gặp lỗi!',
            ]);
        }
    }
}
