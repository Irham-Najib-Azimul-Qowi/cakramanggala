<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user)
            return;

        $artikels = [
            [
                'judul' => 'Ekspedisi Puncak Semeru: Catatan Perjalanan Angkatan XIV',
                'konten' => '<p>Perjalanan dimulai dari pos Ranu Pani menuju Ranu Kumbolo. Cuaca sangat cerah saat itu. Kami belajar banyak tentang manajemen logistik dan kerjasama tim saat mendaki salah satu gunung tertinggi di Jawa ini.</p><p>Pengalaman ini memberikan perspektif baru tentang ketangguhan fisik dan mental yang diperlukan oleh seorang anggota Cakra Manggala.</p>',
                'status' => 'published',
                'views' => 1250,
                'gambar' => 'image/fotobersejarah1.jpg',
            ],
            [
                'judul' => 'Pentingnya Menjaga Kelestarian Hutan Mangrove di Pesisir Jawa',
                'konten' => '<p>Hutan mangrove bukan sekadar tanaman di pinggir pantai. Mereka adalah benteng pertahanan dari abrasi dan rumah bagi ribuan biota laut.</p><p>Melalui kegiatan penanaman mangrove bulan lalu, kami menyadari betapa rapuhnya ekosistem kita saat ini.</p>',
                'status' => 'published',
                'views' => 840,
                'gambar' => 'image/fotobersejarah2.jpg',
            ],
            [
                'judul' => 'Teknik Dasar Survival di Hutan Tropis untuk Pemula',
                'konten' => '<p>Survival adalah tentang pola pikir. Hal pertama yang harus dilakukan saat tersesat adalah STOP (Sit, Think, Observe, Plan).</p><p>Artikel ini merangkum teknik mencari sumber air dan membangun shelter darurat menggunakan bahan alam sekitar.</p>',
                'status' => 'published',
                'views' => 2100,
                'gambar' => 'image/fotobersejarah1.jpg',
            ],
            [
                'judul' => 'Sejarah Berdirinya UKM Cakra Manggala: Dari Semangat Menjadi Gerakan',
                'konten' => '<p>UKM Cakra Manggala resmi berdiri pada tahun yang penuh semangat perjuangan mahasiswa. Berawal dari sekelompok kecil mahasiswa yang gemar mendaki, kini bertransformasi menjadi organisasi pecinta alam yang disegani.</p>',
                'status' => 'published',
                'views' => 500,
                'gambar' => 'image/fotobersejarah2.jpg',
            ],
            [
                'judul' => 'Laporan Kegiatan Bersih Gunung Lawu 2026: Mengumpulkan 200kg Sampah',
                'konten' => '<p>Sangat disayangkan melihat banyaknya sampah plastik di sepanjang jalur pendakian. Dalam kegiatan kemarin, tim kami berhasil membawa turun lebih dari 200kg sampah anorganik.</p><p>Mari kita menjadi pendaki yang bertanggung jawab dengan tidak meninggalkan apapun kecuali jejak kaki.</p>',
                'status' => 'published',
                'views' => 320,
                'gambar' => 'image/fotobersejarah1.jpg',
            ],
            [
                'judul' => 'Tips Memilih Perlengkapan Mendaki yang Aman dan Nyaman',
                'konten' => '<p>Memilih tas carrier atau sepatu gunung tidak bisa sembarangan. Kenyamanan adalah kunci utama untuk menghindari cedera saat di lapangan.</p>',
                'status' => 'published',
                'views' => 950,
                'gambar' => 'image/fotobersejarah2.jpg',
            ],
        ];

        foreach ($artikels as $data) {
            $slug = Str::slug($data['judul']);
            Artikel::updateOrCreate(
                ['slug' => $slug],
                [
                    'judul' => $data['judul'],
                    'konten' => $data['konten'],
                    'excerpt' => Str::limit(strip_tags($data['konten']), 150),
                    'status' => $data['status'],
                    'user_id' => $user->id,
                    'views' => $data['views'],
                    'gambar_utama' => $data['gambar'],
                ]
            );
        }
    }
}
