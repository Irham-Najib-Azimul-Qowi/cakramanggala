<?php
// File: app/Http/Controllers/ArtikelController.php (untuk frontend)

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = 9; // 3x3 grid

        $query = Artikel::published()
            ->with('user')
            ->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $artikels = $query->paginate($perPage);

        return view('artikel.index', compact('artikels', 'search'));
    }

    public function show($slug)
    {
        $artikel = Artikel::published()
            ->with('user')
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $artikel->incrementViews();

        // Get related articles (3 artikel terbaru lainnya)
        $relatedArtikels = Artikel::published()
            ->where('id', '!=', $artikel->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('artikel.show', compact('artikel', 'relatedArtikels'));
    }

    // Method untuk mendapatkan artikel terbaru untuk home page
    public function getLatestForHome($limit = 6)
    {
        return Artikel::published()
            ->with('user')
            ->latest()
            ->limit($limit)
            ->get();
    }
}