<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index()
    {
        $periode = \App\Models\Setting::getValue('periode_pengurus', 'PERIODE 2024 — 2025');
        $penguruses = Pengurus::where('status', 'active')->where('urutan', '>', 0)->orderBy('urutan')->get();

        return view('struktur-kepengurusan', compact('penguruses', 'periode'));
    }

    public function anggota(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $angkatan = $request->get('angkatan');

        $query = \App\Models\Anggota::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nia', 'like', "%{$search}%")
                  ->orWhere('angkatan', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($angkatan) {
            $query->where('angkatan', $angkatan);
        }

        $members = $query->orderBy('angkatan', 'desc')->orderBy('nama', 'asc')->paginate(16)->withQueryString();

        $angkatans = \App\Models\Anggota::select('angkatan')
            ->whereNotNull('angkatan')
            ->where('angkatan', '!=', '')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan');

        $statuses = [
            'anggota baru' => 'Anggota Baru',
            'anggota' => 'Anggota Aktif',
            'demisioner' => 'Demisioner',
            'alumni' => 'Alumni'
        ];

        return view('anggota', compact('members', 'search', 'status', 'angkatan', 'angkatans', 'statuses'));
    }
}
