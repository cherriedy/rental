<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Image;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Room\CreateRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;

class UserRoomController extends Controller
{
    public function index()
    {
        $rooms = Auth::user()->room;

        return view('rooms.index', compact('rooms'));
    }

    public function show($slug, Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function create()
    {
        $cities = Location::where('type', 1)->get();
        $districts = Location::where('type', 2)->get();
        $wards = Location::where('type', 3)->get();
        $streets = Location::where('type', 4)->get();
        $categories = Category::select('id', 'name')->get();

        return view('rooms.create', compact('cities', 'districts', 'wards', 'categories', 'streets'));
    }

    // public function store(CreateRoomRequest $request)
    // {
    //     $validated = $request->validated();

    //     $validated['slug'] = Str::slug($validated['title']);

    //     /* DEVELOPER */
    //     $validated['exact_address'] = 'NULL';
    //     $validated['expiration_date'] = Carbon::now();

    //     Room::create($validated);

    //     return redirect()->route('rooms.index')->with('success', 'Đăng bài thành công!');
    // }

    protected function mappingPrice($validated)
    {
        $validated['price_range'] = match (true) {
            $validated['price'] < 1000000 => 1,
            $validated['price'] >= 1000000 && $validated['price'] < 2000000 => 2,
            $validated['price'] >= 2000000 && $validated['price'] < 3000000 => 3,
            $validated['price'] >= 3000000 && $validated['price'] < 5000000 => 4,
            $validated['price'] >= 5000000 && $validated['price'] < 7000000 => 5,
            $validated['price'] >= 7000000 && $validated['price'] < 10000000 => 6,
            $validated['price'] >= 10000000 && $validated['price'] < 15000000 => 7,
            $validated['price'] >= 15000000 => 8,
        };

        return $validated;
    }

    protected function mappingArea($validated)
    {
        $validated['area_range'] = match (true) {
            $validated['area'] < 20 => 1,
            $validated['area'] >= 20 && $validated['area'] < 30 => 2,
            $validated['area'] >= 30 && $validated['area'] < 50 => 3,
            $validated['area'] >= 50 && $validated['area'] < 60 => 4,
            $validated['area'] >= 60 && $validated['area'] < 70 => 5,
            $validated['area'] >= 70 && $validated['area'] < 80 => 6,
            $validated['area'] >= 80 && $validated['area'] < 100 => 7,
            $validated['area'] >= 100 && $validated['area'] < 120 => 8,
            $validated['area'] >= 120 && $validated['area'] < 150 => 9,
            $validated['area'] >= 150 => 10,
        };

        return $validated;
    }

    /* Store with AJAX */
    public function store(CreateRoomRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title']);
        $validated = $this->mappingPrice($validated);
        $validated = $this->mappingArea($validated);

        /* DEVELOPER */
        $validated['expiration_date'] = Carbon::now();
        /*END DEVELOPER */

        if ($room = Room::create($validated)) {
            $temporaryFiles = TemporaryFile::all();

            foreach ($temporaryFiles as $temporaryFile) {
                Storage::copy('images/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename, 'images/' . $temporaryFile->folder . '/' . $temporaryFile->filename);

                Image::create([
                    'name' => $temporaryFile->filename,
                    'path' => $temporaryFile->folder . '/' . $temporaryFile->filename,
                    'room_id' => $room->id,
                ]);

                Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);

                $temporaryFile->delete();
            }

            return response()->json([
                'status_code' => '200',
                'message' => 'Đăng bài thành công!',
            ]);
        } else {
            $temporaryImages = TemporaryFile::all();

            foreach ($temporaryImages as $temporaryImage) {
                Storage::deleteDirectory('images/tmp/' . $temporaryImage->folder);
                $temporaryImage->delete();
            }
        }
    }

    public function edit(Room $room)
    {
        $this->authorize('update', $room);

        $cities = Location::where('type', 1)->get();
        $districts = Location::where('type', 2)->get();
        $wards = Location::where('type', 3)->get();
        $streets = Location::where('type', 4)->get();
        $categories = Category::select('id', 'name')->get();

        return view('rooms.edit', compact('room', 'cities', 'districts', 'wards', 'streets', 'categories'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $this->authorize('update', $room);

        $validated = $request->validated();

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']);
        $validated['exp_date'] = Carbon::now();
        $validated['price'] = Str::replace(',', '', $request['price']);
        $validated = $this->mappingPrice($validated);
        $validated = $this->mappingArea($validated);

        /* DEVELOPER */
        $validated['updated_at'] = Carbon::now();

        if ($room->update($validated)) {
            return response()->json([
                'status_code' => '200',
                'message' => 'Cập nhật thành công!',
            ]);
        } else {
            // return response()->json([
            //     'status_code' => '200',
            //     'message' => 'Cập nhật thành công!',
            //     'errors' => dd($validated),
            // ]);
        }

    }

    public function hide(Room $room)
    {
        $room->status = Room::STATUS_HIDE;
        $room->save();

        return redirect()->back();
    }

    public function active(Room $room)
    {
        $today = date('Y-m-d');
        $checkDateOfRoom = Room::where([['created_at', '<=', $today], ['expiration_date', '>=', $today]])->get();

        if ($checkDateOfRoom) {
            $room->status = Room::STATUS_ACTIVE;
            $room->save();

            return redirect()->back();
        }
    }
}
