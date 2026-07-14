<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'nama' => 'Najib Azimul Qowi',
                'nia' => 'CM-XIV-098',
                'angkatan' => 'XIV',
                'status' => 'anggota',
                'foto' => null,
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'nia' => 'CM-XIII-084',
                'angkatan' => 'XIII',
                'status' => 'demisioner',
                'foto' => null,
            ],
            [
                'nama' => 'Budi Santoso',
                'nia' => 'CM-XI-052',
                'angkatan' => 'XI',
                'status' => 'alumni',
                'foto' => null,
            ],
            [
                'nama' => 'Siti Aminah',
                'nia' => 'CM-XIV-102',
                'angkatan' => 'XIV',
                'status' => 'anggota baru',
                'foto' => null,
            ],
        ];

        foreach ($members as $member) {
            Anggota::create($member);
        }
    }
}
