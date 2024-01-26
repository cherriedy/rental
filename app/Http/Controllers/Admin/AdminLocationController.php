<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Psr7\Response;

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

            $location = Location::create($location);

            return redirect()->route('admins.locations.index');
        } catch(Exception $exception) {
        }
    }

    public function edit(Location $location) {
        $cities = Location::where('type', 1)->get();

        return view('admin.pages.locations.update', compact('location', 'cities'));
    }

    public function update(Request $request, Location $location) {
        try {
            $locationData = $request->except('_token');

            if ($request->has('name')) {
                $locationData['slug'] = Str::slug($request['name']);
            }

            $locationData['updated_at'] = Carbon::now();

            $location->update($locationData);

            return redirect()->route('admins.locations.index');
        } catch(Exception $exception) {
        }
    }

    public function delete(Location $location) {
        $location->delete();
        return redirect()->route('admins.locations.index');
    }
}
