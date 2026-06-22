<?php

namespace App\Http\Controllers;

use App\Models\CatatanPerjalanan;
use App\Models\Kegiatan;
use App\Models\Pengurus;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Traits\ImageUploadTrait;

class CatatanPerjalananController extends Controller
{
    use ImageUploadTrait;
    public function index(Request $request)
    {
        $search = $request->get('search');
        $lokasi = $request->get('lokasi');
        $angkatan = $request->get('angkatan');
        $perPage = 9; // 3x3 grid

        $query = CatatanPerjalanan::published()
            ->with('user')
            ->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        if ($lokasi) {
            $query->where('lokasi', 'like', "%{$lokasi}%");
        }

        if ($angkatan) {
            $query->where('angkatan', 'like', "%{$angkatan}%");
        }

        $catatans = $query->paginate($perPage);

        // Get unique locations and batches for filter dropdowns
        $lokasis = CatatanPerjalanan::published()
            ->whereNotNull('lokasi')
            ->select('lokasi')
            ->distinct()
            ->pluck('lokasi');

        $angkatans = CatatanPerjalanan::published()
            ->whereNotNull('angkatan')
            ->select('angkatan')
            ->distinct()
            ->pluck('angkatan');

        return view('catatan.index', compact('catatans', 'search', 'lokasi', 'angkatan', 'lokasis', 'angkatans'));
    }

    public function show($slug)
    {
        $catatan = CatatanPerjalanan::published()
            ->with('user')
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views with session check to prevent artificial inflation
        $viewedKey = 'viewed_catatan_' . $catatan->id;
        if (!session()->has($viewedKey)) {
            $catatan->incrementViews();
            session()->put($viewedKey, true);
        }

        // Get other recent travel logs
        $recentCatatans = CatatanPerjalanan::published()
            ->where('id', '!=', $catatan->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('catatan.show', compact('catatan', 'recentCatatans'));
    }

    public function tambahForm(Request $request)
    {
        $kegiatans = Kegiatan::orderBy('tanggal_pelaksanaan', 'desc')->get();
        return view('catatan.tambah', compact('kegiatans'));
    }

    public function kirimOtp(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:50',
            'email' => 'required|email|max:100',
        ]);

        $nim = $request->nim;
        $email = $request->email;

        // Check if user is in Pengurus
        $isPengurus = Pengurus::where('nim', $nim)->exists();
        
        // Check if user is in Pendaftaran (approved / Diterima)
        $isAnggota = Pendaftaran::where('nim', $nim)
            ->where(function ($q) {
                $q->where('is_approved', 1)
                  ->orWhere('status', 'Diterima');
            })->exists();

        if (!$isPengurus && !$isAnggota) {
            return back()->withErrors(['nim' => 'NIM tidak terdaftar sebagai pengurus atau anggota aktif UKM Cakramanggala.'])->withInput();
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        
        // Save in session
        session()->put('travel_log_otp', $otp);
        session()->put('travel_log_otp_expires', now()->addMinutes(15));
        session()->put('travel_log_nim', $nim);
        session()->put('travel_log_email', $email);

        // Send OTP
        try {
            Mail::html("Halo,<br><br>Kode OTP Anda untuk menambahkan cerita pengalaman perjalanan di website UKM Cakra Manggala adalah: <strong>{$otp}</strong>.<br><br>Kode ini berlaku selama 15 menit. Mohon jangan membagikan kode ini kepada siapa pun.", function ($message) use ($email) {
                $message->to($email)
                    ->subject('[Cakramanggala] Kode OTP Pengisian Catatan Perjalanan');
            });
        } catch (\Exception $e) {
            logger()->error('Gagal mengirim email OTP: ' . $e->getMessage());
        }

        return back()->with('success_otp', "Kode OTP berhasil dikirim ke email {$email}. Silakan cek kotak masuk atau folder spam Anda.");
    }

    public function simpanCatatan(Request $request)
    {
        $request->validate([
            'otp' => 'required|string',
            'nama' => 'required|string|max:100',
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'judul' => 'required|string|max:150',
            'konten' => 'required|string',
            'gambar_dokumen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Verify OTP
        if (!session()->has('travel_log_otp') || !session()->has('travel_log_otp_expires')) {
            return back()->withErrors(['otp' => 'Sesi OTP tidak ditemukan. Silakan minta kode OTP baru.'])->withInput();
        }

        if (now()->gt(session('travel_log_otp_expires'))) {
            return back()->withErrors(['otp' => 'Kode OTP telah kedaluwarsa. Silakan minta kode OTP baru.'])->withInput();
        }

        if ($request->otp != session('travel_log_otp')) {
            return back()->withErrors(['otp' => 'Kode OTP yang Anda masukkan salah.'])->withInput();
        }

        $nim = session('travel_log_nim');
        $email = session('travel_log_email');

        // Fetch Kegiatan details
        $kegiatan = Kegiatan::findOrFail($request->kegiatan_id);

        // Create travel log as draft
        $catatan = new CatatanPerjalanan();
        $catatan->judul = $request->judul;
        $catatan->penulis = $request->nama;
        
        // Find if they belong to a certain batch, otherwise default to kegiatan year
        $pendaftar = Pendaftaran::where('nim', $nim)->first();
        if ($pendaftar) {
            // Find batch from pendaftar created year or generic batch
            $catatan->angkatan = 'Angkatan ' . date('Y', strtotime($pendaftar->created_at));
        } else {
            $catatan->angkatan = 'Tahun ' . $kegiatan->tahun;
        }

        $catatan->tanggal_perjalanan = $kegiatan->tanggal_pelaksanaan;
        $catatan->lokasi = $kegiatan->tempat;
        $catatan->konten = $request->konten;
        $catatan->status = 'draft'; // Needs approval from admin/moderator
        $catatan->kegiatan_id = $kegiatan->id;

        // Handle optional image upload
        if ($request->hasFile('gambar_dokumen')) {
            $catatan->gambar = $this->uploadAndConvert($request->file('gambar_dokumen'), 'uploads/catatan_perjalanan');
        }

        $catatan->save();

        // Clear OTP Session
        session()->forget(['travel_log_otp', 'travel_log_otp_expires', 'travel_log_nim', 'travel_log_email']);

        return redirect()->route('catatan-perjalanan.index')
            ->with('success', 'Cerita pengalaman Anda berhasil dikirim! Catatan perjalanan Anda telah disimpan sebagai draft dan akan ditinjau oleh Admin atau Moderator sebelum diterbitkan secara publik.');
    }

    public function resetTambahForm(Request $request)
    {
        session()->forget(['travel_log_otp', 'travel_log_otp_expires', 'travel_log_nim', 'travel_log_email']);
        return redirect()->route('catatan-perjalanan.tambah');
    }
}
