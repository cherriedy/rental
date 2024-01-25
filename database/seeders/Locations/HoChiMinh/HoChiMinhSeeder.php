<?php

namespace Database\Seeders\Locations\HoChiMinh;

use Exception;
use Carbon\Carbon;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\Locations\HoChiMinh\TanBinhSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HoChiMinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CityName = 'Thành phố Hồ Chí Minh';
        try {
            Location::create([
                'name' => $CityName,
                'slug' => Str::slug($CityName),
                'title' => $CityName,
                'description' => $CityName,
                'parent_id' => 0,
                'type' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } catch (Exception $exception) {
        }

        $this->call(TanBinhSeeder::class);
        $this->call(TanPhuSeeder::class);
    }
}
