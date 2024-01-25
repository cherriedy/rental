<?php

namespace Database\Seeders\Locations;

use Database\Seeders\Locations\HoChiMinh\HoChiMinhSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(HoChiMinhSeeder::class);
    }
}
