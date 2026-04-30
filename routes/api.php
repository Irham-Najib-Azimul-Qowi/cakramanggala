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

