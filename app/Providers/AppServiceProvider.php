<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Location;
use App\Services\Core\RoomService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useBootstrapFive();

        $_PRICE_RANGE = [
            1 => 'Dưới 1 triệu',
            2 => '1 đến 2 triệu',
            3 => '2 đến 3 triệu',
            4 => '3 đến 5 triệu',
            5 => '5 đến 7 triệu',
            6 => '7 đến 10 triệu',
            7 => '10 đến 15 triệu',
            8 => 'Trên 15 triệu',
        ];

        $_AREA_RANGE = [
            1 => 'Dưới 20m2',
            2 => '20 đến 30m2',
            3 => '30 đến 50m2',
            4 => '50 đến 60m2',
            5 => '60 đến 70m2',
            6 => '70 đến 80m2',
            7 => '80 đến 100m2',
            8 => '100 đến 120m2',
            9 => '120 đến 150m2',
            10 => 'Trên 150m2',
        ];

        try {
            $_CATEGORY = Category::select('id', 'name', 'slug')->orderBy('name', 'ASC')->get();

            $_CITY = Location::select('id', 'name', 'slug')->where('type', 1)->get();

            $_SIDEBAR_ROOM_SPECIAL_SERVICE = RoomService::getSpecialServiceRoom();

            $_SIDEBAR_ROOM_NEW = RoomService::getRoomNew();
        } catch (\Exception $exception) {
        }

        View::share('_CATEGORY', $_CATEGORY ?? []);
        View::share('_CITY', $_CITY ?? []);
        View::share('_PRICE_RANGE', $_PRICE_RANGE ?? []);
        View::share('_AREA_RANGE', $_AREA_RANGE ?? []);
        View::share('_SIDEBAR_ROOM_SPECIAL_SERVICE', $_SIDEBAR_ROOM_SPECIAL_SERVICE ?? []);
        View::share('_SIDEBAR_ROOM_NEW', $_SIDEBAR_ROOM_NEW ?? []);
    }
}
