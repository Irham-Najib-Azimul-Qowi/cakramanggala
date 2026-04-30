<?php
// File: database/seeders/PendaftaranSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendaftaranSeeder extends Seeder
{
    public function run()
    {
        $names = [
            'Ahmad Fadli Rahman', 'Siti Nurhaliza', 'Budi Santoso', 'Dewi Lestari', 'Rizki Pratama',
            'Maya Sari', 'Doni Setiawan', 'Rina Purnama', 'Arif Hidayat', 'Lina Marlina',
            'Yoga Permana', 'Sari Indah', 'Eko Prasetyo', 'Nisa Amelia', 'Firman Syahputra',
            'Ica Ramadhani', 'Agus Susanto', 'Wulan Dari', 'Bayu Aji', 'Tina Kartika',
            'Hendra Gunawan', 'Ratna Dewi', 'Andi Wijaya', 'Putri Maharani', 'Gilang Ramadhan',
            'Indira Sari', 'Fajar Nugroho', 'Yuni Astuti', 'Reza Pratama', 'Diah Ayu',
            'Kevin Saputra', 'Mira Anggraini', 'Rian Setiadi', 'Nanda Putri', 'Ivan Permana',
            'Citra Dewi', 'Aldy Firmansyah', 'Vina Melati', 'Ryan Maulana', 'Sinta Wulandari',
            'Dimas Prasetya', 'Lia Kusuma', 'Fikri Hakim', 'Yolanda Sari', 'Teguh Wijayanto',
            'Arum Puspita', 'Irfan Maulana', 'Desy Ratnasari', 'Wahyu Kurniawan', 'Eka Pratiwi'
        ];

        $jurusan = ['Teknik', 'Akuntansi', 'Administrasi Bisnis'];
        $programStudi = [
            'Teknik' => ['Teknik Informatika', 'Teknik Sipil', 'Teknik Mesin', 'Teknik Elektro'],
            'Akuntansi' => ['Akuntansi', 'Akuntansi Perpajakan'],
            'Administrasi Bisnis' => ['Administrasi Bisnis', 'Manajemen Pemasaran', 'Manajemen Keuangan']
        ];

        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        $tempatLahir = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Bekasi', 'Tangerang', 'Depok', 'Semarang',
            'Palembang', 'Makassar', 'Batam', 'Bogor', 'Pekanbaru', 'Bandar Lampung', 'Malang',
            'Yogyakarta', 'Solo', 'Denpasar', 'Balikpapan', 'Samarinda', 'Pontianak', 'Manado',
            'Mataram', 'Kupang', 'Ambon', 'Jayapura', 'Banda Aceh', 'Padang', 'Jambi', 'Bengkulu'
        ];

        $organisasi = [
            'BEM Universitas', 'Himpunan Mahasiswa Jurusan', 'Karang Taruna', 'PMR', 'Pramuka',
            'OSIS SMA', 'Rohis', 'English Club', 'Pencak Silat', 'Basket Club',
            'Futsal Club', 'Badminton Club', 'Photography Club', 'Music Club', 'Dance Club',
            'Tidak ada', 'Volunteer Komunitas', 'Pecinta Alam SMA', 'Tim Debat', 'Theater Club'
        ];

        $alasanBergabung = [
            'Ingin mengembangkan jiwa petualang dan cinta alam',
            'Tertarik dengan kegiatan outdoor dan pendakian gunung',
            'Ingin belajar survival skills dan teknik mountaineering',
            'Mengembangkan karakter kepemimpinan melalui alam',
            'Ingin berkontribusi dalam kegiatan pelestarian lingkungan',
            'Mencari pengalaman baru dan tantangan hidup',
            'Ingin membangun networking dengan sesama pecinta alam',
            'Mengembangkan mental dan fisik melalui kegiatan alam',
            'Tertarik dengan fotografi alam dan dokumentasi',
            'Ingin belajar navigasi dan orienteering',
            'Mengasah kemampuan teamwork dan kerjasama tim',
            'Mencintai alam dan ingin menjaganya untuk generasi mendatang',
            'Ingin merasakan ketenangan dan kedamaian di alam',
            'Mengembangkan kreativitas melalui kegiatan alam',
            'Tertarik dengan penelitian flora dan fauna'
        ];

        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $selectedJurusan = $jurusan[array_rand($jurusan)];
            $selectedProdi = $programStudi[$selectedJurusan][array_rand($programStudi[$selectedJurusan])];
            $selectedJK = $jenisKelamin[array_rand($jenisKelamin)];
            
            // Generate NIM berdasarkan tahun dan random
            $tahun = rand(2020, 2024);
            $nim = $tahun . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT) . str_pad($i + 1, 3, '0', STR_PAD_LEFT);
            
            // Generate tanggal lahir (usia 18-25 tahun)
            $umur = rand(18, 25);
            $tanggalLahir = Carbon::now()->subYears($umur)->subDays(rand(1, 365));
            
            // Generate created_at dalam 6 bulan terakhir
            $createdAt = Carbon::now()->subDays(rand(1, 180));

            $data[] = [
                'nama_lengkap' => $names[$i],
                'nim' => $nim,
                'jurusan' => $selectedJurusan,
                'program_studi' => $selectedProdi,
                'jenis_kelamin' => $selectedJK,
                'tempat_lahir' => $tempatLahir[array_rand($tempatLahir)],
                'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
                'no_hp' => '08' . rand(1, 9) . rand(10000000, 99999999),
                'alamat' => 'Jl. ' . $tempatLahir[array_rand($tempatLahir)] . ' No. ' . rand(1, 100) . ', RT ' . rand(1, 10) . '/RW ' . rand(1, 15),
                'organisasi_yang_pernah_diikuti' => $organisasi[array_rand($organisasi)],
                'alasan_bergabung' => $alasanBergabung[array_rand($alasanBergabung)],
                'foto_diri' => null, // Bisa ditambahkan nanti jika diperlukan
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        DB::table('pendaftaran')->insert($data);
        
        $this->command->info('50 data pendaftar berhasil ditambahkan!');
    }
}