@extends('layouts.dashboard')

@section('title', 'Edit Agenda Kegiatan')

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.kegiatan.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 border-0 rounded-0"
            style="background: rgba(255,255,255,0.05); color: #fff; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.8rem 1.5rem;">
            <i class="bi bi-arrow-left"></i> KEMBALI
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card p-0 overflow-hidden border-0 shadow-lg">
                <div class="p-4 p-lg-5" style="background: var(--primary); color: #fff; position: relative; overflow: hidden;">
                    <div style="position: relative; z-index: 2;">
                        <p class="mb-2 text-accent x-small fw-black text-uppercase" style="letter-spacing: 0.2em; font-size: 0.65rem;">SUNTING DATA</p>
                        <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.01em;">{{ strtoupper($kegiatan->judul_kegiatan) }}</h1>
                        <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">PERUBAHAN TERAKHIR: {{ $kegiatan->updated_at->translatedFormat('d M Y, H:i') }}</p>
                    </div>
                    <i class="bi bi-pencil-fill" style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
                </div>

                <div class="p-4 p-lg-5">
                    <form method="POST" action="{{ route('dashboard.kegiatan.update', $kegiatan) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">TAHUN ANGGARAN <span class="text-danger">*</span></label>
                                <select class="form-select admin-select @error('tahun') is-invalid @enderror" name="tahun" required>
                                    @for($year = 2020; $year <= date('Y') + 5; $year++)
                                        <option value="{{ $year }}" {{ old('tahun', $kegiatan->tahun) == $year ? 'selected' : '' }}>TAHUN {{ $year }}</option>
                                    @endfor
                                </select>
                                @error('tahun') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">KATEGORI KEGIATAN <span class="text-danger">*</span></label>
                                <select class="form-select admin-select @error('sifat') is-invalid @enderror" name="sifat" required>
                                    <option value="umum" {{ old('sifat', $kegiatan->sifat) == 'umum' ? 'selected' : '' }}>UMUM</option>
                                    <option value="gunung_hutan" {{ old('sifat', $kegiatan->sifat) == 'gunung_hutan' ? 'selected' : '' }}>GUNUNG HUTAN</option>
                                    <option value="panjat_tebing" {{ old('sifat', $kegiatan->sifat) == 'panjat_tebing' ? 'selected' : '' }}>PANJAT TEBING</option>
                                </select>
                                @error('sifat') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">JUDUL KEGIATAN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control admin-input @error('judul_kegiatan') is-invalid @enderror"
                                name="judul_kegiatan" value="{{ old('judul_kegiatan', $kegiatan->judul_kegiatan) }}" required>
                            @error('judul_kegiatan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">TANGGAL PELAKSANAAN <span class="text-danger">*</span></label>
                                <input type="date" class="form-control admin-input @error('tanggal_pelaksanaan') is-invalid @enderror"
                                    name="tanggal_pelaksanaan"
                                    value="{{ old('tanggal_pelaksanaan', $kegiatan->tanggal_pelaksanaan->format('Y-m-d')) }}" required>
                                @error('tanggal_pelaksanaan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">LOKASI / TEMPAT <span class="text-danger">*</span></label>
                                <input type="text" class="form-control admin-input @error('tempat') is-invalid @enderror" name="tempat"
                                    value="{{ old('tempat', $kegiatan->tempat) }}" required>
                                @error('tempat') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">KETUA PELAKSANA / PJ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control admin-input @error('kapel_pj') is-invalid @enderror" name="kapel_pj"
                                value="{{ old('kapel_pj', $kegiatan->kapel_pj) }}" required>
                            @error('kapel_pj') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">DESKRIPSI LENGKAP KEGIATAN <span class="text-danger">*</span></label>
                            <textarea class="form-control admin-input @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="8" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">DESKRIPSI MATERI / CATATAN <span class="text-muted">(OPSIONAL)</span></label>
                            <textarea class="form-control admin-input @error('materi') is-invalid @enderror" name="materi" rows="4">{{ old('materi', $kegiatan->materi) }}</textarea>
                            @error('materi') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">FOTO UTAMA (COVER)</label>
                                @if($kegiatan->gambar_utama)
                                    <div class="mb-3" style="max-width: 200px; border: 2px solid rgba(255,255,255,0.05);">
                                        <img src="{{ asset($kegiatan->gambar_utama) }}" class="w-100">
                                    </div>
                                @endif
                                <input type="file" name="gambar_utama" class="form-control admin-input @error('gambar_utama') is-invalid @enderror" accept="image/*">
                                <div class="mt-2 x-small text-white-50 fw-bold">FORMAT: JPG, PNG, WEBP, HEIC, HEIF. MAKSIMAL 2MB.</div>
                                @error('gambar_utama') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3" style="letter-spacing: 0.15em; font-size: 0.7rem;">FOTO DOKUMENTASI (MAKS 6)</label>
                                @if(is_array($kegiatan->dokumentasi) && count($kegiatan->dokumentasi) > 0)
                                    <div class="row g-2 mb-3">
                                        @foreach($kegiatan->dokumentasi as $doc)
                                            <div class="col-4">
                                                <div style="aspect-ratio: 1/1; border: 1px solid rgba(255,255,255,0.05);">
                                                    <img src="{{ asset($doc) }}" class="w-100 h-100 object-fit-cover">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <input type="file" name="dokumentasi[]" multiple class="form-control admin-input @error('dokumentasi') is-invalid @enderror" accept="image/*">
                                <div class="mt-2 x-small text-white-50 fw-bold">BISA PILIH HINGGA 6 GAMBAR. MENGUNGGAH BARU AKAN MENGGANTI SEMUA FOTO LAMA.</div>
                                @error('dokumentasi') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                                @error('dokumentasi.*') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-5" style="border-top: 1px solid rgba(255,255,255,0.05);">
                            <a href="{{ route('dashboard.kegiatan.index') }}" class="btn btn-dark px-5 py-3 fw-black border-0 rounded-0" style="background: rgba(255,255,255,0.05);">BATAL</a>
                            <button type="submit" class="btn btn-accent px-5 py-3 fw-black">
                                <i class="bi bi-check2-circle me-2"></i> UPDATE AGENDA
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card text-center" style="background: var(--primary) !important; border: none; padding: 2.5rem;">
                <h2 class="h6 fw-black text-accent text-uppercase mb-4" style="letter-spacing: 0.15em;">RIWAYAT SISTEM</h2>
                <div class="small text-start">
                    <div class="mb-4 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-1" style="letter-spacing: 0.1em; font-size: 0.6rem;">Dibuat Oleh</label>
                        <div class="fw-black text-white" style="font-size: 0.85rem;">{{ strtoupper($kegiatan->user->name) }}</div>
                    </div>
                    <div class="mb-4 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-1" style="letter-spacing: 0.1em; font-size: 0.6rem;">Waktu Input</label>
                        <div class="fw-black text-white">{{ $kegiatan->created_at->translatedFormat('d M Y, H:i') }}</div>
                    </div>
                    <div>
                        <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-1" style="letter-spacing: 0.1em; font-size: 0.6rem;">Pembaruan Terakhir</label>
                        <div class="fw-black text-white">{{ $kegiatan->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection