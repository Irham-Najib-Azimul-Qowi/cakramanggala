<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KegiatanResource;
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
     * Display a listing of kegiatan.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $tahun = $request->get('tahun');
        $sifat = $request->get('sifat');

        $query = Kegiatan::latest('tanggal_pelaksanaan');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul_kegiatan', 'like', "%{$search}%")
                  ->orWhere('tempat', 'like', "%{$search}%");
            });
        }

        if ($tahun) $query->byYear($tahun);
        if ($sifat) $query->bySifat($sifat);

        $kegiatans = $query->paginate($request->get('per_page', 10));

        return KegiatanResource::collection($kegiatans);
    }

    /**
     * Store a newly created kegiatan.
     */
    public function store(StoreKegiatanRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $this->uploadAndConvert($request->file('gambar_utama'), 'uploads/kegiatan');
        }

        $kegiatan = Kegiatan::create($validated);

        return new KegiatanResource($kegiatan);
    }

    /**
     * Display the specified kegiatan.
     */
    public function show(Kegiatan $kegiatan)
    {
        return new KegiatanResource($kegiatan);
    }

    /**
     * Update the specified kegiatan.
     */
    public function update(UpdateKegiatanRequest $request, Kegiatan $kegiatan)
    {
        $validated = $request->validated();

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $this->uploadAndConvert($request->file('gambar_utama'), 'uploads/kegiatan', $kegiatan->gambar_utama);
        }

        $kegiatan->update($validated);

        return new KegiatanResource($kegiatan);
    }

    /**
     * Remove the specified kegiatan.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar_utama && File::exists(public_path($kegiatan->gambar_utama))) {
            File::delete(public_path($kegiatan->gambar_utama));
        }

        $kegiatan->delete();

        return response()->json(['message' => 'Kegiatan berhasil dihapus.']);
    }
}
