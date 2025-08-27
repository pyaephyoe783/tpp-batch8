<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
            'address' => 'Yangon',
            'phone' => '0912345678',
            'gender' => 'male',
            'password' => Hash::make('user1234')

        ]);

        $student = User::create([
            'name' => 'Alice',
            'email' => 'alice@gmail.com',
            'address' => 'Yangon',
            'phone' => '0912345678',
            'gender' => 'male',
            'password' => Hash::make('user1234')

        ]);

        $admin->assignRole('Admin');
        $student->assignRole('Student');
    }
}
