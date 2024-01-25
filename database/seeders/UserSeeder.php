<?php

namespace Database\Seeders;

use Exception;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        try {
            User::create([
                'name' => 'huyTest',
                'email' => 'huy5a@gmail.com',
                'phone' => '0816232452',
                // 'avatar' => 'https://api.dicebear.com/6.x/fun-emoji/svg?seed=huy',
                'password' => '123',
                // 'is' => '1',
                'isVerified' => false,
            ]);
        } catch (Exception $exception) {
        }
    }
}
