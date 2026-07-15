@extends('layouts.dashboard')

@section('title', 'Tulis Artikel Baru')

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
                <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.01em;">TULIS ARTIKEL</h1>
                <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Berbagi Cerita &
                    Pengetahuan Alam Bebas</p>
            </div>
            <i class="bi bi-pencil-square"
                style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
        </div>

        <div class="p-4 p-lg-5">
            <form action="{{ route('dashboard.artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-5">
                    <div class="col-lg-8">
                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">JUDUL ARTIKEL <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="judul"
                                class="form-control admin-input @error('judul') is-invalid @enderror"
                                value="{{ old('judul') }}" placeholder="Contoh: Ekspedisi Puncak Semeru 2024" required
                                style="font-size: 1.25rem !important; font-weight: 800 !important; padding: 1.2rem 1.5rem !important;">
                            @error('judul') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">RINGKASAN SINGKAT</label>
                            <textarea name="excerpt" class="form-control admin-input @error('excerpt') is-invalid @enderror"
                                rows="2" placeholder="Pengantar singkat yang menarik pembaca..."
                                style="font-style: italic;">{{ old('excerpt') }}</textarea>
                            @error('excerpt') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">KONTEN UTAMA <span
                                    class="text-danger">*</span></label>
                            <textarea name="konten" class="form-control admin-input @error('konten') is-invalid @enderror"
                                rows="18" placeholder="Tuliskan isi artikel secara mendalam di sini..."
                                required>{{ old('konten') }}</textarea>
                            @error('konten') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
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
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>SIMPAN SEBAGAI
                                        DRAFT</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                        PUBLIKASIKAN SEKARANG</option>
                                </select>
                                @error('status') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Unggah Cover</label>
                                <input type="file" name="gambar_utama"
                                    class="form-control admin-input @error('gambar_utama') is-invalid @enderror"
                                    accept="image/*">
                                <div class="mt-2 x-small text-white-50 fw-bold">FORMAT: JPG, PNG, WEBP, HEIC, HEIF. MAKSIMAL 2MB.</div>
                                @error('gambar_utama') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pt-5" style="border-top: 1px solid rgba(255,255,255,0.05); margin-top: 3rem;">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('dashboard.artikel.index') }}"
                                class="btn btn-dark px-5 py-3 fw-black border-0 rounded-0"
                                style="background: rgba(255,255,255,0.05);">BATAL</a>
                            <button type="submit" class="btn btn-accent px-5 py-3 fw-black">
                                <i class="bi bi-cloud-upload-fill me-2"></i> PUBLIKASIKAN ARTIKEL
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection