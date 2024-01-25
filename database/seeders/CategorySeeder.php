<?php

namespace Database\Seeders;

use Exception;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $CategoryNames = ['Cho thuê phòng trọ', 'Nhà cho thuê', 'Tìm người ở ghép', 'Nhà cho thuê', 'Cho thuê căn hộ'];

        foreach ($CategoryNames as $Name) {
            try {
                Category::create([
                    'name' => $Name,
                    'title' => $Name,
                    'slug' => Str::slug($Name),
                    'description' => $Name,
                    'created_at' => Carbon::now(),
                ]);
            } catch (Exception $exception) {
            }
        }
    }
}
