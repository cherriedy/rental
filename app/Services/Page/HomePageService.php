<?php

namespace App\Services\Page;

use App\Models\Room;
use App\Services\Core\RoomService;

class HomePageService
{
    public static function home()
    {
        $rooms = Room::orderbyDesc('hot_service')->paginate(10);
        $VipRooms = RoomService::getSpecialServiceRoom(6);
        $NewRooms = RoomService::getRoomNew(6);

        return compact('VipRooms', 'NewRooms', 'rooms');
    }
}
