<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;

class StrukturController extends Controller
{
    public function index()
    {
        $penguruses = Pengurus::where('status', 'active')->orderBy('urutan')->get();

        // Grouping for the structure page might be tricky if we don't have categories.
        // But for now, we can just pass them all or filter by jabatan.
        return view('struktur-kepengurusan', compact('penguruses'));
    }
}
