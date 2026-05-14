<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\InventoryKegiatan;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $stats = [
            'total_alat' => Alat::sum('total_qty'),
            'alat_tersedia' => Alat::sum('available_qty'),
            'alat_dipakai' => Alat::sum('total_qty') - Alat::sum('available_qty'),
            'kegiatan_aktif' => InventoryKegiatan::whereIn('status', ['ongoing'])->count(),
        ];

        $alats = Alat::latest()->get();
        $kegiatans = InventoryKegiatan::withCount('alats')->latest()->get();

        // Data for chart: Tool usage by category or status
        $chartData = [
            'labels' => ['Tersedia', 'Dipakai'],
            'data' => [$stats['alat_tersedia'], $stats['alat_dipakai']]
        ];

        return view('dashboard.inventaris.index', compact('stats', 'alats', 'kegiatans', 'chartData'));
    }

    public function showInventoryKegiatan($id)
    {
        $kegiatan = InventoryKegiatan::with(['alats', 'creator'])->findOrFail($id);
        return view('dashboard.inventaris.kegiatan_detail', compact('kegiatan'));
    }
}
