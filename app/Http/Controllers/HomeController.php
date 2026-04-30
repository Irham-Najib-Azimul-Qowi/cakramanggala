<?php
// File: app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {

        // Get latest articles untuk section berita
        $artikels = Artikel::published()
        ->with('user')
        ->latest()
        ->limit(6) // Tampilkan 6 artikel terbaru
        ->get();

        // Get statistics (jika diperlukan)
        $stats = [
        'total_artikel' => Artikel::published()->count(),
        'total_pendaftar' => class_exists('App\Models\Pendaftar') ? \App\Models\Pendaftaran::count() : 0,
        // Tambahkan statistik lain sesuai kebutuhan
        ];

        return view('home', compact('artikels', 'stats'));    
    }

    public function about()
    {
        return view('about');
    }

    public function activities()
    {
        return view('activities');
    }

    public function join()
    {
        return view('join');
    }

    public function storePendaftaran(Request $request)
    {
        // Validasi form
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim' => 'required|string|unique:pendaftaran,nim|max:20',
            'jurusan' => 'required|in:Teknik,Akuntansi,Administrasi Bisnis',
            'program_studi' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Perempuan,Laki-laki',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'organisasi_yang_pernah_diikuti' => 'nullable|string',
            'alasan_bergabung' => 'required|string|min:20',
            'foto_diri' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'jurusan.required' => 'Jurusan wajib dipilih',
            'tanggal_lahir.before' => 'Tanggal lahir tidak valid',
            'alasan_bergabung.min' => 'Alasan bergabung minimal 20 karakter',
            'foto_diri.required' => 'Foto diri wajib diunggah',
            'foto_diri.image' => 'File harus berupa gambar',
            'foto_diri.max' => 'Ukuran foto maksimal 2MB',
        ]);

        // Upload foto ke public/uploads/pendaftaran
        if ($request->hasFile('foto_diri')) {
            // Buat folder jika belum ada
            $uploadPath = public_path('uploads/pendaftaran');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Generate nama file unik
            $file = $request->file('foto_diri');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Pindahkan file ke folder public
            $file->move($uploadPath, $fileName);
            
            // Simpan path relatif ke database
            $validated['foto_diri'] = 'uploads/pendaftaran/' . $fileName;
        }

        // Simpan ke database
        $pendaftaran = Pendaftaran::create($validated);

        // Redirect ke halaman sukses
        return redirect()->route('join.success', ['id' => $pendaftaran->id])
                        ->with('success', 'Pendaftaran berhasil dikirim!');
    }

    public function joinSuccess($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('join-success', compact('pendaftaran'));
    }

    public function contact()
    {
        return view('contact');
    }
}