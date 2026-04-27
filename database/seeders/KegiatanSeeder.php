<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user)
            return;

        $kegiatans = [
            [
                'tahun' => 2026,
                'judul_kegiatan' => 'Pendidikan Dasar Angkatan XV',
                'tanggal_pelaksanaan' => now()->addMonths(2),
                'materi' => 'Navigasi Darat, Survival, Management Perjalanan',
                'tempat' => 'Lereng Gunung Wilis',
                'kapel_pj' => 'Dian Wijaya',
                'sifat' => 'internal',
            ],
            [
                'tahun' => 2026,
                'judul_kegiatan' => 'Bakti Lingkungan: Penanaman 1000 Bibit Pohon',
                'tanggal_pelaksanaan' => now()->addWeeks(3),
                'materi' => 'Konservasi Lahan Kritis',
                'tempat' => 'Hutan Kota Madiun',
                'kapel_pj' => 'Budi Santoso',
                'sifat' => 'eksternal',
            ],
            [
                'tahun' => 2025,
                'judul_kegiatan' => 'Ekspedisi Merah Putih: Puncak Mahameru',
                'tanggal_pelaksanaan' => now()->subMonths(8),
                'materi' => 'High Altitude Climbing',
                'tempat' => 'Gunung Semeru',
                'kapel_pj' => 'Rizky Pratama',
                'sifat' => 'internal',
            ],
            [
                'tahun' => 2025,
                'judul_kegiatan' => 'Latihan Gabungan Caving (Susur Goa)',
                'tanggal_pelaksanaan' => now()->subMonths(3),
                'materi' => 'Vertical Rescue & Mapping',
                'tempat' => 'Goa Luweng Jaran, Pacitan',
                'kapel_pj' => 'Sinta Amelia',
                'sifat' => 'internal',
            ],
            [
                'tahun' => 2026,
                'judul_kegiatan' => 'Seminar Lingkungan Hidup Nasional',
                'tanggal_pelaksanaan' => now()->addMonths(5),
                'materi' => 'Sustainable Living & Advocacy',
                'tempat' => 'Gedung Serbaguna Kampus',
                'kapel_pj' => 'Ketua Umum',
                'sifat' => 'eksternal',
            ],
        ];

        foreach ($kegiatans as $data) {
            Kegiatan::updateOrCreate(
                ['judul_kegiatan' => $data['judul_kegiatan']],
                [
                    'tahun' => $data['tahun'],
                    'tanggal_pelaksanaan' => $data['tanggal_pelaksanaan'],
                    'materi' => $data['materi'],
                    'tempat' => $data['tempat'],
                    'kapel_pj' => $data['kapel_pj'],
                    'sifat' => $data['sifat'],
                    'user_id' => $user->id,
                ]
            );
        }
    }
}
