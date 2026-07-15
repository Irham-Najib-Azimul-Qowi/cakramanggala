<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index()
    {
        $periode = \App\Models\Setting::getValue('periode_pengurus', 'PERIODE 2024 — 2025');
        $penguruses = Pengurus::where('status', 'active')->orderBy('urutan')->get();

        return view('struktur-kepengurusan', compact('penguruses', 'periode'));
    }

    public function anggota(Request $request)
    {
        $search = $request->get('search');
        $query = \App\Models\Anggota::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nia', 'like', "%{$search}%")
                  ->orWhere('angkatan', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $members = $query->orderBy('angkatan', 'desc')->orderBy('nama', 'asc')->paginate(16)->withQueryString();

        return view('anggota', compact('members', 'search'));
    }
}
