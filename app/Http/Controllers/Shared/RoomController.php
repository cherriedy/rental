<?php

namespace App\Http\Controllers\Shared;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Room\CreateRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Auth::user()->room;

        return view('rooms.index', compact('rooms'));
    }

    public function show(Room $room)
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

    public function edit(Room $room)
    {
        $this->authorize('update', $room);

        $cities = Location::where('type', 1)->get();
        $districts = Location::where('type', 2)->get();
        $wards = Location::where('type', 3)->get();
        $categories = Category::select('id', 'name')->get();

        return view('rooms.edit', compact('room', 'cities', 'districts', 'wards', 'categories'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $this->authorize('update', $room);

        $validated = $request->validated();

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']);
        $validated['exp_date'] = Carbon::now();
        $validated['price'] = Str::replace(',', '', $request['price']);

        $room->update($validated);

        return redirect()
            ->route('rooms.show', $room)
            ->with('success', 'Cập nhật tin thành công!');
    }
}
