<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\StoreKegiatanRequest;
use App\Http\Requests\UpdateKegiatanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $tahun = $request->get('tahun');
        $sifat = $request->get('sifat');
        $perPage = $request->get('per_page', 10);

        $query = Kegiatan::with('user')
            ->orderBy('tanggal_pelaksanaan', 'desc');

        // Filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul_kegiatan', 'like', "%{$search}%")
                    ->orWhere('tempat', 'like', "%{$search}%")
                    ->orWhere('kapel_pj', 'like', "%{$search}%");
            });
        }

        // Filter tahun
        if ($tahun) {
            $query->byYear($tahun);
        }

        // Filter sifat
        if ($sifat) {
            $query->bySifat($sifat);
        }

        $kegiatans = $query->paginate($perPage);

        // Optimized statistics in one query
        $allStats = Kegiatan::selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN sifat = "internal" THEN 1 ELSE 0 END) as internal,
                SUM(CASE WHEN sifat = "eksternal" THEN 1 ELSE 0 END) as eksternal,
                SUM(CASE WHEN MONTH(tanggal_pelaksanaan) = ? AND YEAR(tanggal_pelaksanaan) = ? THEN 1 ELSE 0 END) as bulan_ini
            ', [now()->month, now()->year])
            ->first();

        $stats = [
            'total' => $allStats->total ?? 0,
            'internal' => $allStats->internal ?? 0,
            'eksternal' => $allStats->eksternal ?? 0,
            'bulan_ini' => $allStats->bulan_ini ?? 0,
        ];

        // Tahun yang tersedia untuk filter
        $availableYears = Kegiatan::selectRaw('DISTINCT tahun')
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('dashboard.kegiatan.index', compact(
            'kegiatans',
            'stats',
            'search',
            'tahun',
            'sifat',
            'perPage',
            'availableYears'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKegiatanRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $this->uploadAndConvert($request->file('gambar_utama'), 'uploads/kegiatan');
        }

        // Handle dokumentasi (multiple images)
        if ($request->hasFile('dokumentasi')) {
            $docs = [];
            foreach ($request->file('dokumentasi') as $file) {
                $docs[] = $this->uploadAndConvert($file, 'uploads/kegiatan/dokumentasi');
            }
            $validated['dokumentasi'] = $docs;
        }

        Kegiatan::create($validated);

        return redirect()->route('dashboard.kegiatan.index')
            ->with('success', 'Jadwal kegiatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        return view('dashboard.kegiatan.show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('dashboard.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKegiatanRequest $request, Kegiatan $kegiatan)
    {
        $validated = $request->validated();

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $this->uploadAndConvert($request->file('gambar_utama'), 'uploads/kegiatan', $kegiatan->gambar_utama);
        }

        // Handle dokumentasi (multiple images)
        if ($request->hasFile('dokumentasi')) {
            // Delete old documentation images
            if (is_array($kegiatan->dokumentasi)) {
                foreach ($kegiatan->dokumentasi as $oldImg) {
                    if (File::exists(public_path($oldImg))) {
                        File::delete(public_path($oldImg));
                    }
                }
            }

            $docs = [];
            foreach ($request->file('dokumentasi') as $file) {
                $docs[] = $this->uploadAndConvert($file, 'uploads/kegiatan/dokumentasi');
            }
            $validated['dokumentasi'] = $docs;
        }

        $kegiatan->update($validated);

        return redirect()->route('dashboard.kegiatan.index')
            ->with('success', 'Jadwal kegiatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        // Delete main photo
        if ($kegiatan->gambar_utama && File::exists(public_path($kegiatan->gambar_utama))) {
            File::delete(public_path($kegiatan->gambar_utama));
        }

        // Delete documentation images
        if (is_array($kegiatan->dokumentasi)) {
            foreach ($kegiatan->dokumentasi as $img) {
                if (File::exists(public_path($img))) {
                    File::delete(public_path($img));
                }
            }
        }

        $kegiatan->delete();

        return redirect()->route('dashboard.kegiatan.index')
            ->with('success', 'Jadwal kegiatan berhasil dihapus!');
    }
}
