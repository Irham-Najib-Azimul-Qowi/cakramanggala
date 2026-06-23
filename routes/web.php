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

Route::get('/cleanup-temp-data', function () {
    $kegiatan = \App\Models\Kegiatan::where('judul_kegiatan', 'Dikhir 2025')->first();
    $deletedLogs = 0;
    if ($kegiatan) {
        $deletedLogs = \App\Models\CatatanPerjalanan::where('kegiatan_id', $kegiatan->id)->delete();
    }
    $nims = ['250000001', '250000002', '244112034', '250000003', '250000004', '250000005', '243304065', '250000006', '250000007', '250000008', '244314048'];
    $deletedPengurus = \App\Models\Pengurus::whereIn('nim', $nims)->delete();
    return "Deleted logs: $deletedLogs, Deleted pengurus: $deletedPengurus";
});

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

// Frontend Catatan Perjalanan routes (PUBLIC - no auth required)
Route::get('/catatan-perjalanan', [\App\Http\Controllers\CatatanPerjalananController::class, 'index'])->name('catatan-perjalanan.index');
Route::get('/catatan-perjalanan/tambah', [\App\Http\Controllers\CatatanPerjalananController::class, 'tambahForm'])->name('catatan-perjalanan.tambah');
Route::post('/catatan-perjalanan/tambah/kirim-otp', [\App\Http\Controllers\CatatanPerjalananController::class, 'kirimOtp'])->name('catatan-perjalanan.kirim-otp');
Route::post('/catatan-perjalanan/tambah/simpan', [\App\Http\Controllers\CatatanPerjalananController::class, 'simpanCatatan'])->name('catatan-perjalanan.simpan');
Route::post('/catatan-perjalanan/tambah/reset', [\App\Http\Controllers\CatatanPerjalananController::class, 'resetTambahForm'])->name('catatan-perjalanan.reset');
Route::get('/catatan-perjalanan/{slug}', [\App\Http\Controllers\CatatanPerjalananController::class, 'show'])->name('catatan-perjalanan.show');

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

    // Dashboard Catatan Perjalanan CRUD (ADMIN & MODERATOR)
    Route::prefix('dashboard')->name('dashboard.')->middleware('role:admin,moderator')->group(function () {
        Route::resource('catatan-perjalanan', \App\Http\Controllers\Dashboard\CatatanPerjalananController::class);
        Route::patch('catatan-perjalanan/{catatan_perjalanan}/toggle-status', [\App\Http\Controllers\Dashboard\CatatanPerjalananController::class, 'toggleStatus'])
            ->name('catatan-perjalanan.toggle-status');
    });

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

// Temporary DB cleanup route
Route::get('/fix-travel-logs', function() {
    $catatans = \App\Models\CatatanPerjalanan::all();
    $count = 0;
    foreach ($catatans as $catatan) {
        $oldKonten = $catatan->konten;
        $oldDeskripsi = $catatan->deskripsi;

        // Replace literal \n (backslash + n) with actual newline
        $newKonten = str_replace(['\n', '\\n'], "\n", $oldKonten);
        $newDeskripsi = str_replace(['\n', '\\n'], "\n", $oldDeskripsi);

        // Replace multiple excessive newlines (e.g. 3 or more newlines) to tidy up the gap
        $newKonten = preg_replace("/\r\n/", "\n", $newKonten);
        $newKonten = preg_replace("/\n{3,}/", "\n\n", $newKonten);

        if ($oldKonten !== $newKonten || $oldDeskripsi !== $newDeskripsi) {
            $catatan->konten = $newKonten;
            $catatan->deskripsi = $newDeskripsi;
            $catatan->save();
            $count++;
        }
    }
    return "Successfully updated {$count} travel logs.";
});

Route::get('/debug-log', function() {
    $c = \App\Models\CatatanPerjalanan::first();
    if (!$c) return "No travel logs found.";
    return "JUDUL: " . $c->judul . "\n\nKONTEN RAW:\n" . $c->konten;
});

Route::get('/clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    return "Cache cleared successfully!";
});

Route::get('/debug-all', function() {
    $catatans = \App\Models\CatatanPerjalanan::all();
    $output = "";
    foreach ($catatans as $cat) {
        $hasSlashN = str_contains($cat->konten, '\n') || str_contains($cat->konten, '\\n');
        $isValidUtf8 = mb_check_encoding($cat->konten, 'UTF-8');
        
        $output .= "ID: {$cat->id}\n";
        $output .= "Judul: {$cat->judul}\n";
        $output .= "Has literal \\n: " . ($hasSlashN ? "YES" : "NO") . "\n";
        $output .= "Valid UTF-8: " . ($isValidUtf8 ? "YES" : "NO") . "\n";
        
        $safeKonten = mb_convert_encoding(substr($cat->konten, 0, 200), 'UTF-8', 'UTF-8');
        $output .= "Snippet: {$safeKonten}\n";
        $output .= "--------------------------------------------------\n\n";
    }
    return response($output)->header('Content-Type', 'text/plain');
});


