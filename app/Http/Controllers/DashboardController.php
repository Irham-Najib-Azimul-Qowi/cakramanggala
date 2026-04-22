<?php

// File: app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $recent_pendaftar = class_exists('App\Models\Pendaftaran') ? \App\Models\Pendaftaran::latest()->limit(8)->get() : collect([]);

        $stats = [
            'total_pendaftar' => class_exists('App\Models\Pendaftaran') ? \App\Models\Pendaftaran::count() : 0,
            'artikel_bulan_ini' => class_exists('App\Models\Artikel') ? \App\Models\Artikel::whereMonth('created_at', now()->month)->count() : 0,
            'kegiatan_aktif' => class_exists('App\Models\Kegiatan') ? \App\Models\Kegiatan::where('tanggal_pelaksanaan', '>=', now())->count() : 0,
            'pesan_baru' => class_exists('App\Models\Pesan') ? \App\Models\Pesan::where('is_read', false)->count() : 0,
        ];

        return view('dashboard.index', compact('user', 'stats', 'recent_pendaftar'));
    }

    public function messages()
    {
        $pesans = \App\Models\Pesan::latest()->paginate(10);
        return view('dashboard.pesan.index', compact('pesans'));
    }

    public function showMessage($id)
    {
        $pesan = \App\Models\Pesan::findOrFail($id);
        $pesan->update(['is_read' => true]);
        
        return view('dashboard.pesan.show', compact('pesan'));
    }

    public function destroyMessage($id)
    {
        $pesan = \App\Models\Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('dashboard.pesan')->with('success', 'Pesan berhasil dihapus!');
    }
}
