<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
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
            $query->where(function($q) use ($search) {
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

        // Statistik
        $stats = [
            'total' => Kegiatan::count(),
            'internal' => Kegiatan::where('sifat', 'internal')->count(),
            'eksternal' => Kegiatan::where('sifat', 'eksternal')->count(),
            'bulan_ini' => Kegiatan::whereMonth('tanggal_pelaksanaan', now()->month)
                                  ->whereYear('tanggal_pelaksanaan', now()->year)
                                  ->count(),
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 5),
            'judul_kegiatan' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'materi' => 'nullable|string',
            'tempat' => 'required|string|max:255',
            'kapel_pj' => 'required|string|max:255',
            'sifat' => 'required|in:internal,eksternal',
        ], [
            'tahun.required' => 'Tahun harus diisi',
            'tahun.integer' => 'Tahun harus berupa angka',
            'tahun.min' => 'Tahun minimal 2020',
            'tahun.max' => 'Tahun maksimal ' . (date('Y') + 5),
            'judul_kegiatan.required' => 'Judul kegiatan harus diisi',
            'judul_kegiatan.max' => 'Judul kegiatan maksimal 255 karakter',
            'tanggal_pelaksanaan.required' => 'Tanggal pelaksanaan harus diisi',
            'tanggal_pelaksanaan.date' => 'Format tanggal tidak valid',
            'tempat.required' => 'Tempat harus diisi',
            'tempat.max' => 'Tempat maksimal 255 karakter',
            'kapel_pj.required' => 'Ketua Pelaksana/PJ harus diisi',
            'kapel_pj.max' => 'Ketua Pelaksana/PJ maksimal 255 karakter',
            'sifat.required' => 'Sifat kegiatan harus dipilih',
            'sifat.in' => 'Sifat kegiatan harus internal atau eksternal',
        ]);

        $validated['user_id'] = Auth::id();

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
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 5),
            'judul_kegiatan' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'materi' => 'nullable|string',
            'tempat' => 'required|string|max:255',
            'kapel_pj' => 'required|string|max:255',
            'sifat' => 'required|in:internal,eksternal',
        ], [
            'tahun.required' => 'Tahun harus diisi',
            'tahun.integer' => 'Tahun harus berupa angka',
            'tahun.min' => 'Tahun minimal 2020',
            'tahun.max' => 'Tahun maksimal ' . (date('Y') + 5),
            'judul_kegiatan.required' => 'Judul kegiatan harus diisi',
            'judul_kegiatan.max' => 'Judul kegiatan maksimal 255 karakter',
            'tanggal_pelaksanaan.required' => 'Tanggal pelaksanaan harus diisi',
            'tanggal_pelaksanaan.date' => 'Format tanggal tidak valid',
            'tempat.required' => 'Tempat harus diisi',
            'tempat.max' => 'Tempat maksimal 255 karakter',
            'kapel_pj.required' => 'Ketua Pelaksana/PJ harus diisi',
            'kapel_pj.max' => 'Ketua Pelaksana/PJ maksimal 255 karakter',
            'sifat.required' => 'Sifat kegiatan harus dipilih',
            'sifat.in' => 'Sifat kegiatan harus internal atau eksternal',
        ]);

        $kegiatan->update($validated);

        return redirect()->route('dashboard.kegiatan.index')
            ->with('success', 'Jadwal kegiatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('dashboard.kegiatan.index')
            ->with('success', 'Jadwal kegiatan berhasil dihapus!');
    }
}