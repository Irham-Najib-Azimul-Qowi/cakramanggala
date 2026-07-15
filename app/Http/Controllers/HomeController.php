<?php

// File: app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Http\Requests\StorePendaftaranRequest;
use App\Http\Requests\StorePesanRequest;
use App\Models\Artikel;
use App\Models\Pendaftaran;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        // Get data with cache for performance (expires in 1 hour)
        $data = Cache::remember('home_data', 3600, function () {
            return [
                'artikels' => Artikel::published()
                    ->with(['user:id,name'])
                    ->select('id', 'judul', 'slug', 'excerpt', 'konten', 'gambar_utama', 'views', 'user_id', 'created_at')
                    ->latest()
                    ->limit(3)
                    ->get(),

                'kegiatans' => \App\Models\Kegiatan::select('id', 'judul_kegiatan', 'tanggal_pelaksanaan', 'tempat', 'sifat', 'materi', 'gambar_utama')
                    ->orderBy('tanggal_pelaksanaan', 'desc')
                    ->limit(3)
                    ->get(),

                'stats' => [
                    'total_artikel' => Artikel::published()->count(),
                    'total_pendaftar' => \App\Models\Pendaftaran::count(),
                    'total_kegiatan' => \App\Models\Kegiatan::count(),
                ]
            ];
        });

        return view('home', array_merge($data));
    }

    public function about()
    {
        return view('about');
    }

    public function history()
    {
        return view('sejarah');
    }

    public function activities(Request $request)
    {
        $search = $request->get('search');
        $tahun = $request->get('tahun');
        $sifat = $request->get('sifat');

        $query = \App\Models\Kegiatan::orderBy('tanggal_pelaksanaan', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul_kegiatan', 'like', "%{$search}%")
                    ->orWhere('tempat', 'like', "%{$search}%")
                    ->orWhere('materi', 'like', "%{$search}%");
            });
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        if ($sifat) {
            $query->where('sifat', $sifat);
        }

        $kegiatans = $query->get();
        return view('activities', compact('kegiatans', 'search'));
    }

    public function gunungHutan(Request $request)
    {
        $search = $request->get('search');
        $tahun = $request->get('tahun');

        $query = \App\Models\Kegiatan::where('sifat', 'gunung_hutan')
            ->orderBy('tanggal_pelaksanaan', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul_kegiatan', 'like', "%{$search}%")
                    ->orWhere('tempat', 'like', "%{$search}%")
                    ->orWhere('materi', 'like', "%{$search}%");
            });
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        $kegiatans = $query->get();

        // Ambil gambar dari kegiatan terbaru kategori gunung_hutan yang memiliki gambar_utama
        $latestKegiatan = \App\Models\Kegiatan::where('sifat', 'gunung_hutan')
            ->whereNotNull('gambar_utama')
            ->where('gambar_utama', '!=', '')
            ->orderBy('tanggal_pelaksanaan', 'desc')
            ->first();

        $heroImage = $latestKegiatan ? asset($latestKegiatan->gambar_utama) : asset('image/fotobersejarah2.jpg');

        return view('kegiatan.gunung_hutan', compact('kegiatans', 'search', 'heroImage'));
    }

    public function panjatTebing(Request $request)
    {
        $search = $request->get('search');
        $tahun = $request->get('tahun');

        $query = \App\Models\Kegiatan::where('sifat', 'panjat_tebing')
            ->orderBy('tanggal_pelaksanaan', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul_kegiatan', 'like', "%{$search}%")
                    ->orWhere('tempat', 'like', "%{$search}%")
                    ->orWhere('materi', 'like', "%{$search}%");
            });
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        $kegiatans = $query->get();

        // Ambil gambar dari kegiatan terbaru kategori panjat_tebing yang memiliki gambar_utama
        $latestKegiatan = \App\Models\Kegiatan::where('sifat', 'panjat_tebing')
            ->whereNotNull('gambar_utama')
            ->where('gambar_utama', '!=', '')
            ->orderBy('tanggal_pelaksanaan', 'desc')
            ->first();

        $heroImage = $latestKegiatan ? asset($latestKegiatan->gambar_utama) : asset('image/img1.jpeg');

        return view('kegiatan.panjat_tebing', compact('kegiatans', 'search', 'heroImage'));
    }

    public function activityDetail($id)
    {
        $kegiatan = \App\Models\Kegiatan::findOrFail($id);

        // Get related activities (random 3)
        $related = \App\Models\Kegiatan::where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('kegiatan.show', compact('kegiatan', 'related'));
    }

    public function join()
    {
        return view('join');
    }

    public function storePendaftaran(StorePendaftaranRequest $request)
    {
        $validated = $request->validated();

        // Upload foto ke public/uploads/pendaftaran
        if ($request->hasFile('foto_diri')) {
            $validated['foto_diri'] = $this->uploadAndConvert($request->file('foto_diri'), 'uploads/pendaftaran');
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

    public function sendContact(StorePesanRequest $request)
    {
        $validated = $request->validated();

        \App\Models\Pesan::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'subjek' => $validated['subject'],
            'pesan' => $validated['message'],
        ]);

        return redirect()->back()->with('success_contact', 'Pesan Anda berhasil dikirim! Tim kami akan segera memprosesnya.');
    }
}
