@extends('layouts.dashboard')

@section('title', 'Edit Artikel')

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.artikel.index') }}"
            class="btn btn-sm d-inline-flex align-items-center gap-2 border-0 rounded-0"
            style="background: rgba(255,255,255,0.05); color: #fff; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.8rem 1.5rem;">
            <i class="bi bi-arrow-left"></i> KEMBALI
        </a>
    </div>

    <div class="admin-card p-0 overflow-hidden border-0 shadow-lg mb-5">
        <div class="p-4 p-lg-5" style="background: var(--primary); color: #fff; position: relative; overflow: hidden;">
            <div style="position: relative; z-index: 2;">
                <p class="mb-2 text-accent x-small fw-black text-uppercase"
                    style="letter-spacing: 0.2em; font-size: 0.65rem;">MODIFIKASI KONTEN</p>
                <h1 class="h3 fw-black mb-1 text-truncate" style="letter-spacing: -0.01em; max-width: 800px;">
                    {{ strtoupper($artikel->judul) }}</h1>
                <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Terakhir
                    diperbarui: {{ $artikel->updated_at->translatedFormat('d F Y, H:i') }}</p>
            </div>
            <i class="bi bi-pencil-fill"
                style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
        </div>

        <div class="p-4 p-lg-5">
            <form method="POST" action="{{ route('dashboard.artikel.update', $artikel) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-5">
                    <div class="col-lg-8">
                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">JUDUL ARTIKEL <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="judul"
                                class="form-control admin-input @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $artikel->judul) }}" required
                                style="font-size: 1.25rem !important; font-weight: 800 !important; padding: 1.2rem 1.5rem !important;">
                            @error('judul') <div class="invalid-feedback fw-bold text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">RINGKASAN SINGKAT</label>
                            <textarea name="excerpt" class="form-control admin-input @error('excerpt') is-invalid @enderror"
                                rows="3" style="font-style: italic;">{{ old('excerpt', $artikel->excerpt) }}</textarea>
                            @error('excerpt') <div class="invalid-feedback fw-bold text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">KONTEN UTAMA <span
                                    class="text-danger">*</span></label>
                            <textarea name="konten" class="form-control admin-input @error('konten') is-invalid @enderror"
                                rows="18" required>{{ old('konten', $artikel->konten) }}</textarea>
                            @error('konten') <div class="invalid-feedback fw-bold text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="admin-card mb-4"
                            style="background: rgba(255,255,255,0.02); border-color: rgba(255,255,255,0.05); padding: 2rem;">
                            <h2 class="h6 fw-black text-white text-uppercase mb-4" style="letter-spacing: 0.15em;">
                                PENGATURAN</h2>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Status Publikasi</label>
                                <select name="status" class="form-select admin-select @error('status') is-invalid @enderror"
                                    required>
                                    <option value="draft" {{ old('status', $artikel->status) == 'draft' ? 'selected' : '' }}>
                                        SIMPAN SEBAGAI DRAFT</option>
                                    <option value="published" {{ old('status', $artikel->status) == 'published' ? 'selected' : '' }}>PUBLIKASIKAN</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-3"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Cover Saat Ini</label>
                                @if($artikel->gambar_utama)
                                    <div class="position-relative overflow-hidden mb-3"
                                        style="height: 180px; border: 1px solid rgba(255,255,255,0.1);">
                                        <img src="{{ asset($artikel->gambar_utama) }}" class="w-100 h-100"
                                            style="object-fit: cover; opacity: 0.7;">
                                        <div class="position-absolute bottom-0 start-0 w-100 p-2 bg-dark text-white-50 x-small text-center fw-bold"
                                            style="background: rgba(0,0,0,0.8) !important;">GAMBAR AKTIF</div>
                                    </div>
                                @else
                                    <div class="mb-3 d-flex align-items-center justify-content-center bg-dark text-white-50 small"
                                        style="height: 180px; border: 1px dashed rgba(255,255,255,0.1);">TIDAK ADA GAMBAR</div>
                                @endif

                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">{{ $artikel->gambar_utama ? 'Ganti Gambar' : 'Unggah Gambar' }}</label>
                                <input type="file" name="gambar_utama"
                                    class="form-control admin-input @error('gambar_utama') is-invalid @enderror"
                                    accept="image/*">
                                @error('gambar_utama') <div class="invalid-feedback fw-bold text-danger">{{ $message }}
                                </div> @enderror
                            </div>

                            <div class="pt-4 mt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="small text-white-50 fw-bold">VIEWS</span>
                                    <span
                                        class="badge bg-accent text-primary fw-black rounded-0">{{ number_format($artikel->views) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="small text-white-50 fw-bold">PENULIS</span>
                                    <span class="small fw-bold text-white">{{ strtoupper($artikel->user->name) }}</span>
                                </div>
                            </div>
                        </div>

                        @if($artikel->status == 'published')
                            <div class="admin-card border-0 text-center"
                                style="background: var(--secondary) !important; padding: 1.5rem;">
                                <p class="x-small fw-black text-accent mb-3" style="letter-spacing: 0.15em;">LINK PUBLIK</p>
                                <a href="{{ route('artikel.show', $artikel->slug) }}" target="_blank"
                                    class="btn btn-outline-light w-100 py-2 border-0 rounded-0 fw-bold small"
                                    style="background: rgba(255,255,255,0.05); letter-spacing: 0.1em;">
                                    <i class="bi bi-box-arrow-up-right me-2"></i> LIHAT LIVE
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 pt-5" style="border-top: 1px solid rgba(255,255,255,0.05); margin-top: 3rem;">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('dashboard.artikel.index') }}"
                                class="btn btn-dark px-5 py-3 fw-black border-0 rounded-0"
                                style="background: rgba(255,255,255,0.05);">BATAL</a>
                            <button type="submit" class="btn btn-accent px-5 py-3 fw-black">
                                <i class="bi bi-check2-all me-2"></i> UPDATE KONTEN
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection