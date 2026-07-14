<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index()
    {
        $penguruses = Pengurus::where('status', 'active')->orderBy('urutan')->get();

        // Grouping for the structure page might be tricky if we don't have categories.
        // But for now, we can just pass them all or filter by jabatan.
        return view('struktur-kepengurusan', compact('penguruses'));
    }

    public function anggota(Request $request)
    {
        $search = $request->get('search');
        $query = \App\Models\Pendaftaran::where(function ($q) {
            $q->where('is_approved', 1)
              ->orWhere('status', 'Diterima');
        });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('program_studi', 'like', "%{$search}%");
            });
        }

        $members = $query->orderBy('nama_lengkap', 'asc')->paginate(16)->withQueryString();

        return view('anggota', compact('members', 'search'));
    }
}
