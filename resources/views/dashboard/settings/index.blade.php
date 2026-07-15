@extends('layouts.dashboard')

@section('title', 'Pengaturan Web')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="admin-card p-0 overflow-hidden border-0 shadow-lg mb-5">
                <div class="p-4 p-lg-5" style="background: var(--primary); color: #fff; position: relative; overflow: hidden;">
                    <div style="position: relative; z-index: 2;">
                        <p class="mb-2 text-accent x-small fw-black text-uppercase"
                            style="letter-spacing: 0.2em; font-size: 0.65rem;">KONFIGURASI GLOBAL</p>
                        <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.01em;">PENGATURAN WEBSITE</h1>
                        <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">
                            Atur Hero Banner, Periode Pengurus, dan Konten Utama Halaman Publik
                        </p>
                    </div>
                    <i class="bi bi-gear"
                        style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
                </div>

                <div class="p-4 p-lg-5">
                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-0 text-center fw-bold mb-5 py-3" style="background: rgba(25, 135, 84, 0.1); color: #20c997; border-left: 4px solid #20c997 !important;">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dashboard.settings.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-5">
                            <!-- SECTION 1: HERO SECTION -->
                            <div class="col-12">
                                <h3 class="h6 fw-black text-white text-uppercase mb-4 pb-2" style="letter-spacing: 0.15em; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <i class="bi bi-layout-wtf text-accent me-2"></i> Hero Section Halaman Utama
                                </h3>

                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label fw-black small text-uppercase text-accent mb-2" style="letter-spacing: 0.15em; font-size: 0.7rem;">Judul Hero (Bisa pakai HTML/br)</label>
                                        <textarea name="hero_title" class="form-control admin-input @error('hero_title') is-invalid @enderror" rows="2" required>{{ old('hero_title', $settings['hero_title'] ?? '') }}</textarea>
                                        <div class="text-white-50 x-small mt-1">Gunakan tag <code>&lt;br&gt;</code> untuk baris baru, dan <code>&lt;span&gt;teks&lt;/span&gt;</code> untuk efek teks bergradasi oranye.</div>
                                        @error('hero_title') <div class="invalid-feedback fw-bold text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-black small text-uppercase text-accent mb-2" style="letter-spacing: 0.15em; font-size: 0.7rem;">Deskripsi / Sub-judul Hero</label>
                                        <textarea name="hero_description" class="form-control admin-input @error('hero_description') is-invalid @enderror" rows="3" required>{{ old('hero_description', $settings['hero_description'] ?? '') }}</textarea>
                                        @error('hero_description') <div class="invalid-feedback fw-bold text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">Gambar Latar Belakang (Fallback)</label>
                                        @if(!empty($settings['hero_image']))
                                            <div class="position-relative overflow-hidden mb-3" style="height: 140px; border: 1px solid rgba(255,255,255,0.1);">
                                                <img src="{{ asset($settings['hero_image']) }}" class="w-100 h-100" style="object-fit: cover; opacity: 0.6;">
                                                <div class="position-absolute bottom-0 start-0 w-100 p-2 bg-dark text-white-50 x-small text-center fw-bold" style="background: rgba(0,0,0,0.8) !important;">GAMBAR AKTIF</div>
                                            </div>
                                        @else
                                            <div class="mb-3 d-flex align-items-center justify-content-center bg-dark text-white-50 x-small fw-bold" style="height: 140px; border: 1px dashed rgba(255,255,255,0.1);">MENGGUNAKAN GAMBAR BAWAAN SYSTEM</div>
                                        @endif
                                        <input type="file" name="hero_image" class="form-control admin-input @error('hero_image') is-invalid @enderror" accept="image/*">
                                        <div class="mt-2 x-small text-white-50 fw-bold">FORMAT: JPG, PNG, WEBP, HEIC, HEIF. MAKSIMAL 2MB.</div>
                                        @error('hero_image') <div class="invalid-feedback fw-bold text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">Video Latar Belakang (Cinematic)</label>
                                        @if(!empty($settings['hero_video']))
                                            <div class="position-relative overflow-hidden mb-3" style="height: 140px; border: 1px solid rgba(255,255,255,0.1); background: #000;">
                                                <video class="w-100 h-100" style="object-fit: cover;" autoplay muted loop>
                                                    <source src="{{ asset($settings['hero_video']) }}" type="video/mp4">
                                                </video>
                                                <div class="position-absolute bottom-0 start-0 w-100 p-2 bg-dark text-white-50 x-small text-center fw-bold" style="background: rgba(0,0,0,0.8) !important;">VIDEO AKTIF</div>
                                            </div>
                                        @else
                                            <div class="mb-3 d-flex align-items-center justify-content-center bg-dark text-white-50 x-small fw-bold" style="height: 140px; border: 1px dashed rgba(255,255,255,0.1);">MENGGUNAKAN VIDEO BAWAAN SYSTEM</div>
                                        @endif
                                        <input type="file" name="hero_video" class="form-control admin-input @error('hero_video') is-invalid @enderror" accept="video/mp4,video/webm,video/ogg">
                                        <div class="mt-2 x-small text-white-50 fw-bold">FORMAT: MP4, WEBM, OGG. MAKSIMAL 10MB.</div>
                                        @error('hero_video') <div class="invalid-feedback fw-bold text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- SECTION 2: PERIODE PENGURUS -->
                            <div class="col-12 mt-5">
                                <h3 class="h6 fw-black text-white text-uppercase mb-4 pb-2" style="letter-spacing: 0.15em; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <i class="bi bi-clock-history text-accent me-2"></i> Periode Kepengurusan Aktif
                                </h3>

                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label fw-black small text-uppercase text-accent mb-2" style="letter-spacing: 0.15em; font-size: 0.7rem;">Teks Periode Pengurus</label>
                                        <input type="text" name="periode_pengurus" class="form-control admin-input @error('periode_pengurus') is-invalid @enderror" value="{{ old('periode_pengurus', $settings['periode_pengurus'] ?? 'PERIODE 2024 — 2025') }}" placeholder="Contoh: PERIODE 2024 — 2025" required>
                                        <div class="text-white-50 x-small mt-1">Teks ini akan ditampilkan pada halaman Struktur Kepengurusan publik.</div>
                                        @error('periode_pengurus') <div class="invalid-feedback fw-bold text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- SAVE BUTTON -->
                            <div class="col-12 pt-5" style="border-top: 1px solid rgba(255,255,255,0.05); margin-top: 4rem;">
                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('dashboard') }}" class="btn btn-dark px-5 py-3 fw-black border-0 rounded-0" style="background: rgba(255,255,255,0.05);">BATAL</a>
                                    <button type="submit" class="btn btn-accent px-5 py-3 fw-black">
                                        <i class="bi bi-shield-check me-2"></i> SIMPAN PENGATURAN
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
