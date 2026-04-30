<?php
// File: database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Cakra Manggala',
            'email' => 'admin@cakramanggala.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Moderator',
            'email' => 'moderator@cakramanggala.com',
            'password' => Hash::make('moderator123'),
            'role' => 'moderator',
        ]);
    }
}