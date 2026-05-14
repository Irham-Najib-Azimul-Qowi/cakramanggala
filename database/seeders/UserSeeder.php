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
        // Hanya buat 1 akun admin utama
        User::updateOrCreate(
            ['email' => 'admin@cakramanggala.com'],
            [
                'name' => 'Admin Cakra Manggala',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}
