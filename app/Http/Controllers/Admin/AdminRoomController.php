<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRoomController extends Controller
{
    public function index() {
        $rooms = Room::orderbyDesc('created_at')->get();

        return view('admin.pages.rooms.index', compact('rooms'));
    }

    public function success(Room $room) {
        $room->status = Room::STATUS_ACTIVE;
        $room->save();

        return redirect()->back();
    }

    public function hide(Room $room) {
        $room->status = Room::STATUS_HIDE;
        $room->save();

        return redirect()->back();
    }

    public function expries(Room $room) {
        $room->status = Room::STATUS_EXPRIED;
        $room->save();

        return redirect()->back();
    }

    public function cancel(Room $room) {
        $room->status = Room::STATUS_CANCEL;
        $room->save();

        return redirect()->back();
    }
}
