<?php

use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KegiatanController;
use App\Http\Controllers\Api\PendaftaranController;
use App\Http\Controllers\Api\PengurusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Authentication (Strict Throttling)
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1'); // 5 attempts per minute

// Public Routes (General Throttling)
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/artikel', [ArtikelController::class, 'index']);
    Route::get('/artikel/{artikel:slug}', [ArtikelController::class, 'show']);

    Route::get('/kegiatan', [KegiatanController::class, 'index']);
    Route::get('/kegiatan/{kegiatan}', [KegiatanController::class, 'show']);

    Route::get('/pengurus', [PengurusController::class, 'index']);

    // Pendaftaran Public (Strict Throttling)
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->middleware('throttle:3,1');
});

// Authenticated Routes (Sanctum)
Route::middleware(['auth:sanctum', 'throttle:120,1'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Management (Admin Only)
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('artikel', ArtikelController::class)->except(['index', 'show']);
        Route::apiResource('kegiatan', KegiatanController::class)->except(['index', 'show']);
        Route::apiResource('pengurus', PengurusController::class)->except(['index']);
        
        Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
        Route::get('/pendaftaran/{pendaftar}', [PendaftaranController::class, 'show']);
        Route::patch('/pendaftaran/{pendaftar}/approve', [PendaftaranController::class, 'approve']);
        Route::patch('/pendaftaran/{pendaftar}/reject', [PendaftaranController::class, 'reject']);
        Route::delete('/pendaftaran/{pendaftar}', [PendaftaranController::class, 'destroy']);
    });
});

// V1 API for Perkapp (Mobile)
Route::prefix('v1')->name('api.v1.')->group(function () {
    // Auth
    Route::post('/auth/register', [App\Http\Controllers\Api\V1\AuthController::class, 'register']);
    Route::post('/auth/login', [App\Http\Controllers\Api\V1\AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/auth/me', [App\Http\Controllers\Api\V1\AuthController::class, 'me']);
        Route::post('/auth/logout', [App\Http\Controllers\Api\V1\AuthController::class, 'logout']);

        // Kegiatan
        Route::apiResource('kegiatan', App\Http\Controllers\Api\V1\KegiatanController::class);
        Route::get('/kegiatan/{id}/alat', [App\Http\Controllers\Api\V1\KegiatanAlatController::class, 'getAlatByKegiatan']);

        // Alat
        Route::apiResource('alat', App\Http\Controllers\Api\V1\AlatController::class);

        // Kegiatan Alat (Add tool to activity)
        Route::post('/kegiatan-alat', [App\Http\Controllers\Api\V1\KegiatanAlatController::class, 'store']);

        // Image Upload
        Route::post('/upload-image', [App\Http\Controllers\Api\V1\ImageUploadController::class, 'upload']);
    });
});
