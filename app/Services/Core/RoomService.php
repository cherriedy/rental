<?php

namespace App\Services\Core;

use App\Models\Room;
use Illuminate\Support\Arr;

class RoomService
{
    protected $col = ['id', 'slug', 'title', 'description', 'price', 'exact_address', 'updated_at', 'status', 'starting_date', 'city_id', 'district_id', 'user_id', 'area', 'hot_service'];

    public static function getSpecialServiceRoom($limit = 5)
    {
    public static function getSpecialServiceRoom($limit = 5)
    {
        $self = new self();


        return Room::whereIn('Status', [Room::STATUS_ACTIVE, Room::STATUS_EXPIRED])
            ->where('hot_service', Room::SERVICE_SPECIAL)
            ->where('hot_service', Room::SERVICE_SPECIAL)
            ->limit($limit)
            ->select($self->col)
            ->orderbyDesc('updated_at')
            ->get();
    }

    public static function getRoomNew($limit = 10)
    {
        $self = new self();

        return Room::whereIn('Status', [Room::STATUS_ACTIVE, Room::STATUS_EXPIRED])
            ->limit($limit)
            ->select($self->col)
            ->orderbyDesc('starting_date')
            ->get();
    }

    public static function getRoomNew($limit = 10)
    {
        $self = new self();

        return Room::whereIn('Status', [Room::STATUS_ACTIVE, Room::STATUS_EXPIRED])
            ->limit($limit)
            ->select($self->col)
            ->orderbyDesc('starting_date')
            ->get();
    }

    public static function getListRoom($params = [])

    {
        $self = new self();
        $rooms = Room::whereIn('Status', [Room::STATUS_ACTIVE, Room::STATUS_EXPIRED]);

        if ($categoryID = Arr::get($params, 'category_id')) {
            $rooms->where('category_id', $categoryID);
        }

        if ($cityID = Arr::get($params, 'city_id')) {
            $rooms->where('city_id', $cityID);
        }

        if ($districtID = Arr::get($params, 'district_id')) {
            $rooms->where('district_id', $districtID);
        }

        if ($wardID = Arr::get($params, 'ward_id')) {
            $rooms->where('ward_id', $wardID);
        }

        if ($priceRANGE = Arr::get($params, 'price_range')) {
            $rooms->where('price_range', $priceRANGE);
        }

        if ($areaRANGE = Arr::get($params, 'area_range')) {
            $rooms->where('area_range', $areaRANGE);
        }

        if ($limit = Arr::get($params, 'limit')) {
            $rooms->limit($limit);
        }

        if (Arr::get($params, 'inRandomOrder') == true) {
            return $rooms
                ->select($self->col)
                ->orderbyDesc('hot_service')
                ->inRandomOrder()
                ->paginate(10);
        }

        return $rooms
            ->select($self->col)
            ->orderbyDesc('hot_service')
            ->paginate(5);
    }
}
