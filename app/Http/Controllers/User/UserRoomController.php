<?php

namespace App\Http\Controllers\User;

use Exception;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Image;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        // dd($rooms);

        return view('users.rooms.index', compact('rooms'));
    }

    public function show($slug, Room $room)
    {
        return view('users.rooms.show', compact('room'));
    }

    public function create()
    {
        $cities = Location::where('type', 1)->get();
        $districts = Location::where('type', 2)->get();
        $wards = Location::where('type', 3)->get();
        $streets = Location::where('type', 4)->get();
        $categories = Category::select('id', 'name')->get();

        return view('users.rooms.create', compact('cities', 'districts', 'wards', 'categories', 'streets'));
    }

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
        $validated['expiration_date'] = Carbon::now();

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
        // $this->authorize('update', $room);

        $cities = Location::where('type', 1)->get();
        $districts = Location::where('type', 2)->get();
        $wards = Location::where('type', 3)->get();
        $streets = Location::where('type', 4)->get();
        $categories = Category::select('id', 'name')->get();

        return view('users.rooms.edit', compact('room', 'cities', 'districts', 'wards', 'streets', 'categories'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        // $this->authorize('update', $room);

        $validated = $request->validated();

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']);
        // $validated['exp_date'] = Carbon::now();
        $validated['price'] = Str::replace(',', '', $request['price']);
        $validated = $this->mappingPrice($validated);
        $validated = $this->mappingArea($validated);
        $validated['updated_at'] = Carbon::now();

        if ($room->update($validated)) {
            return response()->json([
                'status_code' => '200',
                'message' => 'Cập nhật thành công!',
            ]);
        }
    }

    public function hotServiceIndex(Room $room)
    {
        $this->authorize('hotServiceIndex', $room);
        return view('users.rooms.hot-service', compact('room'));
    }

    public function hotServiceStore(Request $request, Room $room)
    {
        try {
            $hotServiceOption = $request['hotServiceOption'];
            $price_PerDay_Of_hotService = config('rental.priceType')[$hotServiceOption];
            $days = $request['days'];

            $totalMoney = $price_PerDay_Of_hotService * $days;

            $this->authorize('hotServiceProcess', [$room, $totalMoney]);

            DB::beginTransaction();
            PaymentHistory::create([
                'user_id' => Auth::id(),
                'room_id' => $room->id,
                'amount' => $totalMoney,
                'service_id' => 0,
                'type' => $hotServiceOption,
                'status' => PaymentHistory::STATUS_SUCCESS,
                'created_at' => Carbon::now(),
            ]);

            DB::table('users')
                ->where('id', $room->user->id)
                ->decrement('account_balance', $totalMoney);

            $starting_date = Carbon::parse($request['starting_date']);
            $expiration_date = $starting_date->clone()->addDay($request['days']);

            $today = Carbon::today();
            $room->status = match (true) {
                $starting_date == $today => Room::STATUS_ACTIVE,
                $starting_date > $today => Room::STATUS_PAID,
                default => Room::STATUS_CANCEL,
            };

            $room->starting_date = $starting_date;
            $room->expiration_date = $expiration_date;
            $room->hot_service = $hotServiceOption;
            $room->updated_at = Carbon::now();
            $room->save();
            DB::commit();

            return redirect()->route('rooms.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::info('========HOT-SERVICE-STORE: ' . $exception);
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
