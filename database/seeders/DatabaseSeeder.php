<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'moderator',
            ]
        );

        $this->call([
            UserSeeder::class,
            PendaftaranSeeder::class,
            ArtikelSeeder::class,
            KegiatanSeeder::class,
            PengurusSeeder::class,
        ]);
    }
}
