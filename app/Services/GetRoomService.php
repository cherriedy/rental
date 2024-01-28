<?php

namespace App\Services;

use App\Models\Room;

class GetRoomService
{
    protected $col = ['id', 'name', 'slug', 'title', 'description', 'price', 'exact_address', 'updated_at', 'status'];

    public static function getRoomNew($limit = 5) {
        $self = new self();
        return Room::whereIn('Status', [Room::STATUS_ACTIVE, Room::STATUS_EXPRIED])
            ->limit($limit)
            ->select($self->col)
            ->orderbyDesc('updated_at')
            ->get();
    }

    public static function getListRoom() {
        $self = new self();
        $room = Room::whereIn('Status', [Room::STATUS_ACTIVE, Room::STATUS_EXPRIED]);

        // if ($)
    }
}
