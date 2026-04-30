<?php
// File: app/Http/Controllers/Dashboard/ArtikelController.php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $perPage = $request->get('per_page', 10);

        $query = Artikel::with('user')->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $artikels = $query->paginate($perPage);

        // Statistics
        $stats = [
            'total' => Artikel::count(),
            'published' => Artikel::where('status', 'published')->count(),
            'draft' => Artikel::where('status', 'draft')->count(),
            'total_views' => Artikel::sum('views')
        ];

        return view('dashboard.artikel.index', compact(
            'artikels', 
            'stats', 
            'search', 
            'status', 
            'perPage'
        ));
    }

    public function create()
    {
        return view('dashboard.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:200',
            'konten' => 'required',
            'excerpt' => 'nullable|max:300',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $data = $request->all();
        
        // Gunakan Auth::id() yang lebih eksplisit
        $data['user_id'] = Auth::id();

        $baseSlug = Str::slug($request->judul);
        $slug = $baseSlug;
        $counter = 1;

        while (Artikel::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        // Upload gambar jika ada - SOLUSI BARU
        if ($request->hasFile('gambar_utama')) {
            // Pastikan folder ada
            $uploadPath = public_path('uploads/articles');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            // Generate nama file unik
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $request->file('gambar_utama')->getClientOriginalExtension();
            
            // Upload langsung ke public/uploads/articles/
            $request->file('gambar_utama')->move($uploadPath, $filename);
            
            // Simpan path relatif ke database
            $data['gambar_utama'] = 'uploads/articles/' . $filename;
        }

        Artikel::create($data);

        return redirect()->route('dashboard.artikel.index')
            ->with('success', 'Artikel berhasil dibuat!');
    }

    public function show(Artikel $artikel)
    {
        return view('dashboard.artikel.show', compact('artikel'));
    }

    public function edit(Artikel $artikel)
    {
        return view('dashboard.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|max:200',
            'konten' => 'required',
            'excerpt' => 'nullable|max:300',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $data = $request->all();

        // Update slug jika judul berubah
        if ($request->judul !== $artikel->judul) {
            $baseSlug = Str::slug($request->judul);
            $slug = $baseSlug;
            $counter = 1;
            
            while (Artikel::where('slug', $slug)->where('id', '!=', $artikel->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $data['slug'] = $slug;
        }

        // Upload gambar baru jika ada - SOLUSI BARU
        if ($request->hasFile('gambar_utama')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar_utama && File::exists(public_path($artikel->gambar_utama))) {
                File::delete(public_path($artikel->gambar_utama));
            }
            
            // Pastikan folder ada
            $uploadPath = public_path('uploads/articles');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            // Generate nama file unik
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $request->file('gambar_utama')->getClientOriginalExtension();
            
            // Upload langsung ke public/uploads/articles/
            $request->file('gambar_utama')->move($uploadPath, $filename);
            
            // Simpan path relatif ke database
            $data['gambar_utama'] = 'uploads/articles/' . $filename;
        }

        $artikel->update($data);

        return redirect()->route('dashboard.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Artikel $artikel)
    {
        // Hapus gambar jika ada - SOLUSI BARU
        if ($artikel->gambar_utama && File::exists(public_path($artikel->gambar_utama))) {
            File::delete(public_path($artikel->gambar_utama));
        }

        $artikel->delete();

        return redirect()->route('dashboard.artikel.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    public function toggleStatus(Artikel $artikel)
    {
        $newStatus = $artikel->status === 'published' ? 'draft' : 'published';
        $artikel->update(['status' => $newStatus]);

        $message = $newStatus === 'published' 
            ? 'Artikel berhasil dipublikasikan!' 
            : 'Artikel berhasil diubah menjadi draft!';

        return redirect()->back()->with('success', $message);
    }
}