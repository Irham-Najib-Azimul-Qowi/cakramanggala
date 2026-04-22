@extends('layouts.dashboard')

@section('title', 'Tulis Artikel Baru')

@section('content')
<div class="mb-4">
    <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card card-premium border-0 overflow-hidden">
            <div class="bg-primary p-4 text-white">
                <h4 class="fw-bold mb-1">Tulis Artikel Baru</h4>
                <p class="mb-0 opacity-75 small">Bagikan berita, pengalaman, atau edukasi alam bebas.</p>
            </div>
            
            <div class="card-body p-4 p-lg-5">
                <form action="{{ route('dashboard.artikel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-4">
                        {{-- Judul dan Slug --}}
                        <div class="col-12">
                            <label class="form-label fw-bold small text-uppercase text-muted">Judul Artikel <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                                value="{{ old('judul') }}" placeholder="Contoh: Ekspedisi Merapi 2024" required>
                            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Ringkasan --}}
                        <div class="col-12">
                            <label class="form-label fw-bold small text-uppercase text-muted">Ringkasan Singkat (Excerpt)</label>
                            <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" 
                                rows="2" placeholder="Tuliskan 1-2 kalimat pengantar untuk pembaca...">{{ old('excerpt') }}</textarea>
                            <div class="form-text smaller">Muncul di halaman depan sebagai preview.</div>
                            @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Konten Utama --}}
                        <div class="col-12">
                            <label class="form-label fw-bold small text-uppercase text-muted">Isi Artikel Lengkap <span class="text-danger">*</span></label>
                            <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" 
                                rows="12" placeholder="Tuliskan isi artikel Anda di sini..." required>{{ old('konten') }}</textarea>
                            @error('konten') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Pengaturan Media & Status --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-uppercase text-muted">Gambar Utama</label>
                            <div class="image-upload-wrapper">
                                <input type="file" name="gambar_utama" class="form-control @error('gambar_utama') is-invalid @enderror" id="fotoInput">
                                <div class="mt-2 small text-muted">Format: JPG, PNG, WEBP. Maks 2MB.</div>
                                @error('gambar_utama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-uppercase text-muted">Status Publikasi <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publikasikan Langsung</option>
                            </select>
                            <div class="form-text smaller">Draft hanya bisa dilihat oleh admin.</div>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 pt-4 border-top mt-5">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-premium-admin px-5">
                                    <i class="bi bi-send-fill"></i> Simpan Artikel
                                </button>
                                <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-light px-4 rounded-pill">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control, .form-select {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1.5px solid #eee;
        background: #fcfcfc;
        transition: 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(26, 67, 49, 0.08);
        background: white;
    }

    .form-control-lg {
        font-weight: 700;
        font-size: 1.25rem;
    }
</style>
@endsection