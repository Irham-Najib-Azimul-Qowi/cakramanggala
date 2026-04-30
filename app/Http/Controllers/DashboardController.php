<?php
// File: app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        
        // Dummy data untuk statistik
        $stats = [
            'total_pendaftar' => 45,
            'artikel_bulan_ini' => 12,
            'kegiatan_aktif' => 3,
            'anggota_aktif' => 78
        ];

        return view('dashboard.index', compact('user', 'stats'));
    }
}