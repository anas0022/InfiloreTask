<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'type' => 'admin',
        ]);
        
        User::create([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'User 3',
            'email' => 'user3@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
