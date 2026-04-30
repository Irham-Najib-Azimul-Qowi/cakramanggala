<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtikelResource;
use App\Models\Artikel;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArtikelController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of articles.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status', 'published');

        $query = Artikel::with('user')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        if ($status && Auth::guard('sanctum')->check()) {
            $query->where('status', $status);
        } else {
            $query->published();
        }

        $artikels = $query->paginate($request->get('per_page', 10));

        return ArtikelResource::collection($artikels);
    }

    /**
     * Store a newly created article.
     */
    public function store(StoreArtikelRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $this->uploadAndConvert($request->file('gambar_utama'), 'uploads/articles');
        }

        $artikel = Artikel::create($validated);

        return new ArtikelResource($artikel->load('user'));
    }

    /**
     * Display the specified article.
     */
    public function show(Artikel $artikel)
    {
        if ($artikel->status !== 'published' && !Auth::guard('sanctum')->check()) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $artikel->incrementViews();
        return new ArtikelResource($artikel->load('user'));
    }

    /**
     * Update the specified article.
     */
    public function update(UpdateArtikelRequest $request, Artikel $artikel)
    {
        $validated = $request->validated();

        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $this->uploadAndConvert($request->file('gambar_utama'), 'uploads/articles', $artikel->gambar_utama);
        }

        $artikel->update($validated);

        return new ArtikelResource($artikel->load('user'));
    }

    /**
     * Remove the specified article.
     */
    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar_utama && File::exists(public_path($artikel->gambar_utama))) {
            File::delete(public_path($artikel->gambar_utama));
        }

        $artikel->delete();

        return response()->json(['message' => 'Artikel berhasil dihapus.']);
    }
}
