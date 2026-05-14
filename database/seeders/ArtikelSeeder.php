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
                'judul' => 'Prinsip Dasar Konservasi Alam bagi Pecinta Alam',
                'konten' => '<p>Konservasi alam adalah upaya perlindungan, pemeliharaan, dan pemanfaatan sumber daya alam secara bijaksana. Sebagai pecinta alam, kita wajib menerapkan prinsip "Leave No Trace" (Tidak meninggalkan jejak) agar ekosistem tetap terjaga.</p><p>Langkah nyata bisa dimulai dari membawa pulang sampah sendiri dan tidak merusak flora selama pendakian.</p>',
                'status' => 'published',
                'views' => 150,
                'gambar' => 'image/fotobersejarah1.jpg',
            ],
            [
                'judul' => 'Panduan Keselamatan Mendaki Gunung untuk Pemula',
                'konten' => '<p>Keselamatan adalah prioritas utama. Sebelum mendaki, pastikan Anda melakukan riset jalur, menyiapkan fisik, dan membawa perlengkapan standar seperti headlamp, kompas, dan P3K.</p><p>Jangan pernah memaksakan diri mencapai puncak jika cuaca buruk atau kondisi fisik menurun.</p>',
                'status' => 'published',
                'views' => 240,
                'gambar' => 'image/fotobersejarah2.jpg',
            ],
            [
                'judul' => 'Teknik Survival: Mencari Sumber Air di Alam Bebas',
                'konten' => '<p>Dalam kondisi darurat, air adalah kebutuhan paling vital. Anda bisa mencari air dari tanaman liana, embun di dedaunan, atau melalui teknik distilasi tanah sederhana.</p><p>Selalu usahakan memasak air atau menggunakan tablet pemurni sebelum dikonsumsi untuk menghindari bakteri.</p>',
                'status' => 'published',
                'views' => 310,
                'gambar' => 'image/fotobersejarah3.jpg',
            ],
            [
                'judul' => 'Membangun Kesadaran Lingkungan di Era Digital',
                'konten' => '<p>Kesadaran lingkungan kini bisa dimulai dari ujung jari. Mengurangi penggunaan plastik sekali pakai dan mendukung kampanye reboisasi digital adalah langkah awal yang hebat bagi generasi muda.</p>',
                'status' => 'published',
                'views' => 120,
                'gambar' => 'image/fotobersejarah1.jpg',
            ],
            [
                'judul' => 'Mengenal Flora dan Fauna Endemik Indonesia',
                'konten' => '<p>Indonesia kaya akan biodiversitas. Mengenal spesies endemik membantu kita memahami betapa pentingnya menjaga habitat mereka dari kerusakan dan perburuan liar.</p>',
                'status' => 'published',
                'views' => 180,
                'gambar' => 'image/fotobersejarah2.jpg',
            ],
            [
                'judul' => 'Etika Berinteraksi dengan Penduduk Lokal saat Eksplorasi',
                'konten' => '<p>Saat menjelajahi daerah baru, kita adalah tamu. Menghormati adat istiadat dan kearifan lokal adalah bagian dari integritas seorang penjelajah sejati.</p>',
                'status' => 'published',
                'views' => 90,
                'gambar' => 'image/fotobersejarah3.jpg',
            ],
        ];

        foreach ($artikels as $data) {
            $slug = \Illuminate\Support\Str::slug($data['judul']);
            Artikel::updateOrCreate(
                ['slug' => $slug],
                [
                    'judul' => $data['judul'],
                    'konten' => $data['konten'],
                    'excerpt' => \Illuminate\Support\Str::limit(strip_tags($data['konten']), 150),
                    'status' => $data['status'],
                    'user_id' => $user->id,
                    'views' => $data['views'],
                    'gambar_utama' => $data['gambar'],
                ]
            );
        }
    }
}
