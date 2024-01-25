<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RoomPolicy
{

    public function update(User $user, Room $room): bool {
        return $room->user()->is($user);
    }

    public function delete(User $user, Room $room): bool {
        return $room->user()->is($user) || $user->isAdmin;
    }

    // public function restore(User $user, Room $room): bool {
    // }
}
