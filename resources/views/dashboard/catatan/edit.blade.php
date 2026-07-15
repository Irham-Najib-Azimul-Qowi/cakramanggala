@extends('layouts.dashboard')

@section('title', 'Edit Catatan Perjalanan')

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.catatan-perjalanan.index') }}"
            class="btn btn-sm d-inline-flex align-items-center gap-2 border-0 rounded-0"
            style="background: rgba(255,255,255,0.05); color: #fff; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.8rem 1.5rem;">
            <i class="bi bi-arrow-left"></i> KEMBALI
        </a>
    </div>

    <div class="admin-card p-0 overflow-hidden border-0 shadow-lg mb-5">
        <div class="p-4 p-lg-5" style="background: var(--primary); color: #fff; position: relative; overflow: hidden;">
            <div style="position: relative; z-index: 2;">
                <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.01em;">EDIT CATATAN PERJALANAN</h1>
                <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Ubah Arsip & Jurnal Perjalanan</p>
            </div>
            <i class="bi bi-compass" style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
        </div>

        <div class="p-4 p-lg-5">
            <form action="{{ route('dashboard.catatan-perjalanan.update', $catatanPerjalanan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-5">
                    <div class="col-lg-8">
                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">JUDUL CATATAN <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control admin-input @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $catatanPerjalanan->judul) }}" required
                                style="font-size: 1.25rem !important; font-weight: 800 !important; padding: 1.2rem 1.5rem !important;">
                            @error('judul') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">RINGKASAN SINGKAT</label>
                            <textarea name="deskripsi" class="form-control admin-input @error('deskripsi') is-invalid @enderror"
                                rows="2" placeholder="Deskripsi ringkas mengenai isi jurnal perjalanan ini...">{{ old('deskripsi', $catatanPerjalanan->deskripsi) }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">ISI JURNAL / KONTEN LENGKAP <span class="text-danger">*</span></label>
                            <textarea name="konten" class="form-control admin-input @error('konten') is-invalid @enderror"
                                rows="18" placeholder="Tuliskan seluruh isi catatan perjalanan, evaluasi, rute, dan log harian..." required>{{ old('konten', $catatanPerjalanan->konten) }}</textarea>
                            @error('konten') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="admin-card mb-4" style="background: rgba(255,255,255,0.02); border-color: rgba(255,255,255,0.05); padding: 2rem;">
                            <h2 class="h6 fw-black text-white text-uppercase mb-4" style="letter-spacing: 0.15em;">METADATA</h2>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">PILIH KEGIATAN <span class="text-danger">*</span></label>
                                <select name="kegiatan_id" class="form-select admin-select @error('kegiatan_id') is-invalid @enderror" required>
                                    <option value="">-- PILIH KEGIATAN --</option>
                                    @foreach($kegiatans as $k)
                                        <option value="{{ $k->id }}" {{ old('kegiatan_id', $catatanPerjalanan->kegiatan_id) == $k->id ? 'selected' : '' }}>
                                            {{ $k->judul_kegiatan }} ({{ $k->tahun }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('kegiatan_id') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Penulis Dokumen <span class="text-danger">*</span></label>
                                <input type="text" name="penulis" class="form-control admin-input @error('penulis') is-invalid @enderror"
                                    value="{{ old('penulis', $catatanPerjalanan->penulis) }}" required>
                                @error('penulis') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Angkatan / Kategori</label>
                                <input type="text" name="angkatan" class="form-control admin-input @error('angkatan') is-invalid @enderror"
                                    value="{{ old('angkatan', $catatanPerjalanan->angkatan) }}">
                                @error('angkatan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Lokasi Perjalanan</label>
                                <input type="text" name="lokasi" class="form-control admin-input @error('lokasi') is-invalid @enderror"
                                    value="{{ old('lokasi', $catatanPerjalanan->lokasi) }}">
                                @error('lokasi') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Tanggal Perjalanan</label>
                                <input type="date" name="tanggal_perjalanan" class="form-control admin-input @error('tanggal_perjalanan') is-invalid @enderror"
                                    value="{{ old('tanggal_perjalanan', $catatanPerjalanan->tanggal_perjalanan ? $catatanPerjalanan->tanggal_perjalanan->format('Y-m-d') : '') }}">
                                @error('tanggal_perjalanan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Status Publikasi</label>
                                <select name="status" class="form-select admin-select @error('status') is-invalid @enderror" required>
                                    <option value="draft" {{ old('status', $catatanPerjalanan->status) == 'draft' ? 'selected' : '' }}>SIMPAN SEBAGAI DRAFT</option>
                                    <option value="published" {{ old('status', $catatanPerjalanan->status) == 'published' ? 'selected' : '' }}>PUBLIKASIKAN SEKARANG</option>
                                </select>
                                @error('status') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Ganti Gambar Utama (Opsional)</label>
                                <input type="file" name="gambar_dokumen" class="form-control admin-input @error('gambar_dokumen') is-invalid @enderror"
                                    accept="image/*">
                                <div class="mt-2 x-small text-white-50 fw-bold">FORMAT: JPG, PNG, WEBP, HEIC, HEIF. MAKSIMAL 2MB.</div>
                                @error('gambar_dokumen') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror

                                @if($catatanPerjalanan->gambar)
                                    <div class="mt-3 p-2 rounded text-center" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
                                        <div class="x-small fw-bold text-white mb-2">Gambar Saat Ini:</div>
                                        <img src="{{ $catatanPerjalanan->gambar_url }}" class="img-fluid rounded" style="max-height: 120px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold x-small text-white-50 text-uppercase mb-2"
                                    style="letter-spacing: 0.1em; font-size: 0.6rem;">Ganti Berkas Lampiran (.PDF / .DOCX / .EML)</label>
                                <input type="file" name="file_dokumen" class="form-control admin-input @error('file_dokumen') is-invalid @enderror"
                                    accept=".pdf,.docx,.eml">
                                <div class="mt-2 x-small text-white-50 fw-bold">UKURAN MAKSIMAL 10MB.</div>
                                @error('file_dokumen') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror

                                @if($catatanPerjalanan->file_path)
                                    <div class="mt-3 p-3 text-white-50 rounded" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
                                        <div class="small fw-bold text-white mb-1"><i class="bi bi-file-earmark-check text-accent me-1"></i>Berkas Terpasang:</div>
                                        <div class="x-small text-truncate mb-2">{{ basename($catatanPerjalanan->file_path) }}</div>
                                        <a href="{{ $catatanPerjalanan->file_url }}" target="_blank" class="btn btn-sm btn-accent text-uppercase py-2 px-3 fw-bold w-100" style="font-size: 0.65rem;">
                                            <i class="bi bi-download me-1"></i> Unduh Berkas
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pt-5" style="border-top: 1px solid rgba(255,255,255,0.05); margin-top: 3rem;">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('dashboard.catatan-perjalanan.index') }}"
                                class="btn btn-dark px-5 py-3 fw-black border-0 rounded-0"
                                style="background: rgba(255,255,255,0.05);">BATAL</a>
                            <button type="submit" class="btn btn-accent px-5 py-3 fw-black">
                                <i class="bi bi-cloud-upload-fill me-2"></i> UPDATE CATATAN
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
