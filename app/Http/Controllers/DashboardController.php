<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use App\Models\Pesan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        $recent_pendaftar = Pendaftaran::latest()->limit(8)->get();

        $stats = [
            'total_pendaftar' => Pendaftaran::count(),
            'artikel_bulan_ini' => Artikel::whereMonth('created_at', now()->month)->count(),
            'kegiatan_aktif' => Kegiatan::where('tanggal_pelaksanaan', '>=', now()->toDateString())->count(),
            'pesan_baru' => Pesan::where('is_read', false)->count(),
        ];

        return view('dashboard.index', compact('user', 'stats', 'recent_pendaftar'));
    }

    /**
     * Display a listing of messages.
     */
    public function messages()
    {
        $pesans = Pesan::latest()->paginate(10);
        return view('dashboard.pesan.index', compact('pesans'));
    }

    /**
     * Display the specified message.
     */
    public function showMessage(Pesan $pesan)
    {
        $pesan->update(['is_read' => true]);
        
        return view('dashboard.pesan.show', compact('pesan'));
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroyMessage(Pesan $pesan)
    {
        $pesan->delete();

        return redirect()->route('dashboard.pesan')->with('success', 'Pesan berhasil dihapus!');
    }
}

