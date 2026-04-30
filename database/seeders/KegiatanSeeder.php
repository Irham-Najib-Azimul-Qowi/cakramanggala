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
        if (!$user) return;

        $kegiatans = [
            [
                'tahun' => 2025,
                'judul_kegiatan' => 'Diksar 2025',
                'tanggal_pelaksanaan' => '2025-02-15',
                'materi' => 'Pendidikan Dasar: Navigasi darat, survival, dan materi dasar kepecintaan alam.',
                'tempat' => 'Hutan Lindung Gunung Slamet',
                'kapel_pj' => 'Ketua Pelaksana Diksar',
                'sifat' => 'internal',
                'gambar_utama' => 'image/fotobersejarah1.jpg',
            ],
            [
                'tahun' => 2025,
                'judul_kegiatan' => 'Dikjut 2025 di Lawu',
                'tanggal_pelaksanaan' => '2025-06-20',
                'materi' => 'Pendidikan Lanjutan: Manajemen ekspedisi dan spesialisasi gunung hutan.',
                'tempat' => 'Gunung Lawu, Karanganyar',
                'kapel_pj' => 'Kepala Bidang Operasional',
                'sifat' => 'internal',
                'gambar_utama' => 'image/fotobersejarah2.jpg',
            ],
            [
                'tahun' => 2025,
                'judul_kegiatan' => 'Dikhir 2025',
                'tanggal_pelaksanaan' => '2025-11-10',
                'materi' => 'Pendidikan Akhir: Penyusunan laporan akhir dan pelantikan anggota tetap.',
                'tempat' => 'Basecamp Cakra Manggala',
                'kapel_pj' => 'Dewan Pembina',
                'sifat' => 'internal',
                'gambar_utama' => 'image/fotobersejarah3.jpg',
            ],
        ];

        foreach ($kegiatans as $data) {
            Kegiatan::updateOrCreate(
                ['judul_kegiatan' => $data['judul_kegiatan']],
                array_merge($data, ['user_id' => $user->id])
            );
        }
    }
}
