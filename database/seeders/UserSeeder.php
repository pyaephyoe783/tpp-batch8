<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'address' => 'Yangon',
            'phone' => '0912345678',
            'gender' => 'male',
            'status' => null,
            'image' => null,

        ]);
    }
}
