<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Access\Response;

class RoomPolicy
{
    public function update(User $user, Room $room): bool
    {
        return $room->user()->is($user);
    }

    // public function delete(User $user, Room $room): bool {
    //     return $room->user()->is($user) || $user->isAdmin;
    // }

    // public function restore(User $user, Room $room): bool {
    // }

    public function getSellerPhone(User $user, Room $room) {
        return !($room->user()->is($user));
    }

    public function hideRoom(User $user, Room $room) {
        if ($room->getRawOriginal('status') == Room::STATUS_ACTIVE && $room->user()->is($user)) {
            return true;
        }

        return false;
    }

    public function activeRoom(User $user, Room $room) {
        if ($room->getRawOriginal('status') == Room::STATUS_HIDE && $room->user()->is($user)) {
            return true;
        }

        return false;
    }

    public function hotServiceIndex(User $user, Room $room)
    {
        return $room->user()->is($user) &&
            ($room->getRawOriginal('status') == Room::STATUS_EXPIRED ||
                $room->getRawOriginal('status') == Room::STATUS_DEFAULT);
    }

    public function hotServiceProcess(User $user, Room $room, $totalMoney)
    {
        return $room->user()->is($user) &&
            ($room->getRawOriginal('status') == Room::STATUS_EXPIRED ||
                $room->getRawOriginal('status') == Room::STATUS_DEFAULT) && $user->account_balance >= $totalMoney;
    }
}
