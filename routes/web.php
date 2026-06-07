<?php

// File: routes/web.php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\ArtikelController as DashboardArtikelController;
use App\Http\Controllers\Dashboard\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\StrukturController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Fallback storage route to serve images on shared hosting where symbolic links might be missing
Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $file = file_get_contents($path);
    $type = mime_content_type($path);
    return response($file, 200)->header('Content-Type', $type);
})->where('folder', '[a-zA-Z0-9_\\-]+')->where('filename', '[a-zA-Z0-9_\\-\\.]+');

// Homepage routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home.alt');

// Static pages routes
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/kegiatan', [HomeController::class, 'activities'])->name('activities');
Route::get('/kegiatan/{id}', [HomeController::class, 'activityDetail'])->name('activities.show');
Route::get('/bergabung', [HomeController::class, 'join'])->name('join');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak/kirim', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/struktur-kepengurusan', [StrukturController::class, 'index'])->name('struktur-kepengurusan');

// Pendaftaran routes
Route::post('/bergabung', [HomeController::class, 'storePendaftaran'])->name('join.store')->middleware('recaptcha');
Route::get('/bergabung/sukses/{id}', [HomeController::class, 'joinSuccess'])->name('join.success');

// Frontend Artikel routes (PUBLIC - no auth required)
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('recaptcha');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data Pendaftar routes (ADMIN ONLY - Sensitive Data)
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/pendaftar', [PendaftarController::class, 'index'])->name('dashboard.pendaftar');
        Route::get('/dashboard/pendaftar/export', [PendaftarController::class, 'export'])->name('dashboard.pendaftar.export');
        Route::get('/dashboard/pendaftar/export-simple', [PendaftarController::class, 'exportSimple'])->name('dashboard.pendaftar.exportSimple');
        Route::get('/dashboard/pendaftar/{pendaftar}', [PendaftarController::class, 'show'])->name('dashboard.pendaftar.show');
        Route::patch('/dashboard/pendaftar/{pendaftar}/approve', [PendaftarController::class, 'approve'])->name('dashboard.pendaftar.approve');
        Route::patch('/dashboard/pendaftar/{pendaftar}/reject', [PendaftarController::class, 'reject'])->name('dashboard.pendaftar.reject');
        Route::get('/dashboard/pendaftar/{pendaftar}/edit', [PendaftarController::class, 'edit'])->name('dashboard.pendaftar.edit');
        Route::put('/dashboard/pendaftar/{pendaftar}', [PendaftarController::class, 'update'])->name('dashboard.pendaftar.update');
        Route::delete('/dashboard/pendaftar/{pendaftar}', [PendaftarController::class, 'destroy'])->name('dashboard.pendaftar.destroy');
    });

    // Dashboard Routes (Authenticated & Role Protected)
    Route::prefix('dashboard')->name('dashboard.')->middleware('role:admin')->group(function () {
        // Artikel CRUD
        Route::resource('artikel', DashboardArtikelController::class);

        // Toggle status artikel (publish/unpublish)
        Route::patch('artikel/{artikel}/toggle-status', [DashboardArtikelController::class, 'toggleStatus'])
            ->name('artikel.toggle-status');

        // Kegiatan CRUD
        Route::resource('kegiatan', KegiatanController::class);

        // Pengurus CRUD (ADMIN ONLY)
        Route::resource('pengurus', \App\Http\Controllers\Dashboard\PengurusController::class)->middleware('role:admin');

        // Pesan Management
        Route::get('pesan', [DashboardController::class, 'messages'])->name('pesan');
        Route::get('pesan/{pesan}', [DashboardController::class, 'showMessage'])->name('pesan.show');
        Route::delete('pesan/{pesan}', [DashboardController::class, 'destroyMessage'])->name('pesan.destroy');

        // Inventaris (Equipment Management)
        Route::get('inventaris', [\App\Http\Controllers\Dashboard\InventoryController::class, 'index'])->name('inventaris.index');
        Route::get('inventaris/kegiatan/{id}', [\App\Http\Controllers\Dashboard\InventoryController::class, 'showKegiatan'])->name('inventaris.kegiatan');
    });

    // Future routes for dashboard modules
    // Route::get('/dashboard/galeri', [DashboardController::class, 'galeri'])->name('dashboard.galeri');
});
