<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CatatanPerjalanan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Traits\ImageUploadTrait;

class CatatanPerjalananController extends Controller
{
    use ImageUploadTrait;
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $perPage = $request->get('per_page', 10);

        $query = CatatanPerjalanan::with('user')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $catatans = $query->paginate($perPage);

        // Statistics for dashboard
        $allStats = CatatanPerjalanan::selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN status = "published" THEN 1 ELSE 0 END) as published,
                SUM(CASE WHEN status = "draft" THEN 1 ELSE 0 END) as draft,
                SUM(views) as total_views
            ')
            ->first();

        $stats = [
            'total' => $allStats->total ?? 0,
            'published' => $allStats->published ?? 0,
            'draft' => $allStats->draft ?? 0,
            'total_views' => $allStats->total_views ?? 0,
        ];

        return view('dashboard.catatan.index', compact(
            'catatans',
            'stats',
            'search',
            'status',
            'perPage'
        ));
    }

    public function create()
    {
        $kegiatans = Kegiatan::orderBy('tanggal_pelaksanaan', 'desc')->get();
        return view('dashboard.catatan.create', compact('kegiatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:150',
            'penulis' => 'required|string|max:100',
            'angkatan' => 'nullable|string|max:50',
            'tanggal_perjalanan' => 'nullable|date',
            'lokasi' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string|max:255',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'file_dokumen' => 'nullable|file|mimes:pdf,docx,eml|max:10240', // Max 10MB
            'gambar_dokumen' => 'nullable|image|mimes:jpeg,png,jpg,webp,heic,heif|max:2048', // Max 2MB
        ]);

        $validated['user_id'] = Auth::id();

        $baseSlug = Str::slug($request->judul);
        $slug = $baseSlug;
        $counter = 1;

        while (CatatanPerjalanan::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug . '-' . Str::random(5);

        // Handle file_dokumen upload
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $originalName = $file->getClientOriginalName();
            $safeName = Str::random(8) . '_' . $originalName;
            
            $storagePath = storage_path('app/public/catatan_perjalanan');
            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0755, true);
            }
            
            $file->move($storagePath, $safeName);
            $validated['file_path'] = 'catatan_perjalanan/' . $safeName;
        }

        // Handle gambar upload
        if ($request->hasFile('gambar_dokumen')) {
            $validated['gambar'] = $this->uploadAndConvert($request->file('gambar_dokumen'), 'uploads/catatan_perjalanan');
        }

        CatatanPerjalanan::create($validated);

        return redirect()->route('dashboard.catatan-perjalanan.index')
            ->with('success', 'Catatan perjalanan berhasil dibuat!');
    }

    public function show(CatatanPerjalanan $catatanPerjalanan)
    {
        return view('dashboard.catatan.show', compact('catatanPerjalanan'));
    }

    public function edit(CatatanPerjalanan $catatanPerjalanan)
    {
        $kegiatans = Kegiatan::orderBy('tanggal_pelaksanaan', 'desc')->get();
        return view('dashboard.catatan.edit', compact('catatanPerjalanan', 'kegiatans'));
    }

    public function update(Request $request, CatatanPerjalanan $catatanPerjalanan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:150',
            'penulis' => 'required|string|max:100',
            'angkatan' => 'nullable|string|max:50',
            'tanggal_perjalanan' => 'nullable|date',
            'lokasi' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string|max:255',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'file_dokumen' => 'nullable|file|mimes:pdf,docx,eml|max:10240', // Max 10MB
            'gambar_dokumen' => 'nullable|image|mimes:jpeg,png,jpg,webp,heic,heif|max:2048', // Max 2MB
        ]);

        if ($request->judul !== $catatanPerjalanan->judul) {
            $baseSlug = Str::slug($request->judul);
            $slug = $baseSlug;
            $counter = 1;

            while (CatatanPerjalanan::where('slug', $slug)->where('id', '!=', $catatanPerjalanan->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $validated['slug'] = $slug . '-' . Str::random(5);
        }

        // Handle file_dokumen upload
        if ($request->hasFile('file_dokumen')) {
            // Delete old file if exists
            if ($catatanPerjalanan->file_path && File::exists(storage_path('app/public/' . $catatanPerjalanan->file_path))) {
                File::delete(storage_path('app/public/' . $catatanPerjalanan->file_path));
            }

            $file = $request->file('file_dokumen');
            $originalName = $file->getClientOriginalName();
            $safeName = Str::random(8) . '_' . $originalName;
            
            $storagePath = storage_path('app/public/catatan_perjalanan');
            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0755, true);
            }
            
            $file->move($storagePath, $safeName);
            $validated['file_path'] = 'catatan_perjalanan/' . $safeName;
        }

        // Handle gambar upload
        if ($request->hasFile('gambar_dokumen')) {
            // Delete old image if exists
            if ($catatanPerjalanan->gambar) {
                $oldPath = str_starts_with($catatanPerjalanan->gambar, 'uploads/') 
                    ? public_path($catatanPerjalanan->gambar) 
                    : storage_path('app/public/' . $catatanPerjalanan->gambar);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $validated['gambar'] = $this->uploadAndConvert($request->file('gambar_dokumen'), 'uploads/catatan_perjalanan');
        }

        $catatanPerjalanan->update($validated);

        return redirect()->route('dashboard.catatan-perjalanan.index')
            ->with('success', 'Catatan perjalanan berhasil diperbarui!');
    }

    public function destroy(CatatanPerjalanan $catatanPerjalanan)
    {
        if ($catatanPerjalanan->file_path && File::exists(storage_path('app/public/' . $catatanPerjalanan->file_path))) {
            File::delete(storage_path('app/public/' . $catatanPerjalanan->file_path));
        }

        if ($catatanPerjalanan->gambar) {
            $oldPath = str_starts_with($catatanPerjalanan->gambar, 'uploads/') 
                ? public_path($catatanPerjalanan->gambar) 
                : storage_path('app/public/' . $catatanPerjalanan->gambar);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $catatanPerjalanan->delete();

        return redirect()->route('dashboard.catatan-perjalanan.index')
            ->with('success', 'Catatan perjalanan berhasil dihapus!');
    }

    public function toggleStatus(CatatanPerjalanan $catatanPerjalanan)
    {
        $newStatus = $catatanPerjalanan->status === 'published' ? 'draft' : 'published';
        $catatanPerjalanan->update(['status' => $newStatus]);

        $message = $newStatus === 'published'
            ? 'Catatan perjalanan berhasil dipublikasikan!'
            : 'Catatan perjalanan berhasil diubah menjadi draft!';

        return redirect()->back()->with('success', $message);
    }
}
