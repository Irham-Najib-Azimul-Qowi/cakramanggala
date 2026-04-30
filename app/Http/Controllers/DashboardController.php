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

        // Optimize: Select only needed columns and use limit
        $recent_pendaftar = Pendaftaran::select('id', 'nama_lengkap', 'nim', 'jurusan', 'status', 'created_at')
            ->latest()
            ->limit(8)
            ->get();

        // Optimized: Combined stats query
        $allStats = \DB::table('pendaftaran')->selectRaw('
            COUNT(*) as total_pendaftar,
            SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) as pendaftar_bulan_ini
        ', [now()->startOfMonth()])->first();

        $stats = [
            'total_pendaftar' => $allStats->total_pendaftar ?? 0,
            'pendaftar_bulan_ini' => $allStats->pendaftar_bulan_ini ?? 0,
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

