<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengurus;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Pengurus::truncate();

        $penguruses = [
            [
                'nama' => 'Satria Dwi Saputra',
                'jabatan' => 'Ketua Umum',
                'foto' => null,
                'urutan' => 1,
                'status' => 'active',
            ],
            [
                'nama' => 'Naufal Rohmanul Muhaimin',
                'jabatan' => 'Sekretaris',
                'foto' => null,
                'urutan' => 2,
                'status' => 'active',
            ],
            [
                'nama' => 'Alvina Qorik Cahyani',
                'jabatan' => 'Bendahara',
                'foto' => null,
                'urutan' => 3,
                'status' => 'active',
            ],
            [
                'nama' => 'Albert Setya Candra Wijaya',
                'jabatan' => 'Kabid. Logistik',
                'foto' => null,
                'urutan' => 4,
                'status' => 'active',
            ],
            [
                'nama' => 'Muhammad Dzakwan Alfaris',
                'jabatan' => 'Kabid. Publikasi & Dokumentasi',
                'foto' => null,
                'urutan' => 5,
                'status' => 'active',
            ],
            [
                'nama' => 'Maulaya Ilyasa Jayamagusta',
                'jabatan' => 'Kabid. Kaderisasi & PSDM',
                'foto' => null,
                'urutan' => 6,
                'status' => 'active',
            ],
            [
                'nama' => 'Erzal Abilla Saputra',
                'jabatan' => 'Kabid. Lingkungan & Pengmas',
                'foto' => null,
                'urutan' => 7,
                'status' => 'active',
            ],
        ];

        foreach ($penguruses as $p) {
            Pengurus::create($p);
        }
    }
}
