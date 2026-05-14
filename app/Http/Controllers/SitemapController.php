<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kegiatan;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $artikels = Artikel::published()->latest()->get();
        $kegiatans = Kegiatan::latest()->get();

        return response()->view('sitemap', [
            'artikels' => $artikels,
            'kegiatans' => $kegiatans,
        ])->header('Content-Type', 'text/xml');
    }
}
