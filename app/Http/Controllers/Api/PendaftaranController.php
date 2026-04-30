<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PendaftaranResource;
use App\Models\Pendaftaran;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\StorePendaftaranRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PendaftaranController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of pendaftaran (Admin only).
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $jurusan = $request->get('jurusan');

        $query = Pendaftaran::latest();

        if ($search) $query->search($search);
        if ($jurusan) $query->byJurusan($jurusan);

        $pendaftar = $query->paginate($request->get('per_page', 10));

        return PendaftaranResource::collection($pendaftar);
    }

    /**
     * Store a newly created pendaftaran (Public).
     */
    public function store(StorePendaftaranRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto_diri')) {
            $validated['foto_diri'] = $this->uploadAndConvert($request->file('foto_diri'), 'uploads/pendaftaran');
        }

        $pendaftaran = Pendaftaran::create($validated);

        return new PendaftaranResource($pendaftaran);
    }

    /**
     * Display the specified pendaftaran.
     */
    public function show(Pendaftaran $pendaftar)
    {
        return new PendaftaranResource($pendaftar);
    }

    /**
     * Approve pendaftaran.
     */
    public function approve(Pendaftaran $pendaftar)
    {
        $pendaftar->update([
            'status' => 'approved',
            'is_approved' => true
        ]);

        return new PendaftaranResource($pendaftar);
    }

    /**
     * Reject pendaftaran.
     */
    public function reject(Pendaftaran $pendaftar)
    {
        $pendaftar->update([
            'status' => 'rejected',
            'is_approved' => false
        ]);

        return new PendaftaranResource($pendaftar);
    }

    /**
     * Remove the specified pendaftaran.
     */
    public function destroy(Pendaftaran $pendaftar)
    {
        if ($pendaftar->foto_diri && File::exists(public_path($pendaftar->foto_diri))) {
            File::delete(public_path($pendaftar->foto_diri));
        }

        $pendaftar->delete();

        return response()->json(['message' => 'Data pendaftar berhasil dihapus.']);
    }
}
