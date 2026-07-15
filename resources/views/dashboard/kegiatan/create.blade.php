@extends('layouts.dashboard')

@section('title', 'Tambah Agenda Baru')

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.kegiatan.index') }}"
            class="btn btn-sm d-inline-flex align-items-center gap-2 border-0 rounded-0"
            style="background: rgba(255,255,255,0.05); color: #fff; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.8rem 1.5rem;">
            <i class="bi bi-arrow-left"></i> KEMBALI
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card p-0 overflow-hidden border-0 shadow-lg">
                <div class="p-4 p-lg-5"
                    style="background: var(--primary); color: #fff; position: relative; overflow: hidden;">
                    <div style="position: relative; z-index: 2;">
                        <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.01em;">TAMBAH AGENDA</h1>
                        <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Rencanakan
                            Kegiatan Cakra Manggala Selanjutnya</p>
                    </div>
                    <i class="bi bi-calendar-check-fill"
                        style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
                </div>

                <div class="p-4 p-lg-5">
                    <form method="POST" action="{{ route('dashboard.kegiatan.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">TAHUN ANGGARAN <span
                                        class="text-danger">*</span></label>
                                <select class="form-select admin-select @error('tahun') is-invalid @enderror" name="tahun"
                                    required>
                                    <option value="">PILIH TAHUN</option>
                                    @for($year = 2020; $year <= date('Y') + 5; $year++)
                                        <option value="{{ $year }}" {{ old('tahun', date('Y')) == $year ? 'selected' : '' }}>TAHUN
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                                @error('tahun') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">KATEGORI KEGIATAN <span
                                        class="text-danger">*</span></label>
                                <select class="form-select admin-select @error('sifat') is-invalid @enderror" name="sifat"
                                    required>
                                    <option value="">PILIH KATEGORI</option>
                                    <option value="umum" {{ old('sifat') == 'umum' ? 'selected' : '' }}>UMUM</option>
                                    <option value="gunung_hutan" {{ old('sifat') == 'gunung_hutan' ? 'selected' : '' }}>GUNUNG HUTAN</option>
                                    <option value="panjat_tebing" {{ old('sifat') == 'panjat_tebing' ? 'selected' : '' }}>PANJAT TEBING</option>
                                </select>
                                @error('sifat') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">JUDUL KEGIATAN <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control admin-input @error('judul_kegiatan') is-invalid @enderror"
                                name="judul_kegiatan" value="{{ old('judul_kegiatan') }}" required
                                placeholder="Contoh: DIKLABU XVII - Materi Navigasi Darat">
                            @error('judul_kegiatan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">TANGGAL PELAKSANAAN <span
                                        class="text-danger">*</span></label>
                                <input type="date"
                                    class="form-control admin-input @error('tanggal_pelaksanaan') is-invalid @enderror"
                                    name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" required>
                                @error('tanggal_pelaksanaan') <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">LOKASI / TEMPAT <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control admin-input @error('tempat') is-invalid @enderror"
                                    name="tempat" value="{{ old('tempat') }}" required
                                    placeholder="Contoh: Ruang Rapat Lt. 2 / Gunung Merbabu">
                                @error('tempat') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">KETUA PELAKSANA / PJ <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control admin-input @error('kapel_pj') is-invalid @enderror"
                                name="kapel_pj" value="{{ old('kapel_pj') }}" required
                                placeholder="Nama Lengkap Penanggung Jawab">
                            @error('kapel_pj') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">DESKRIPSI LENGKAP KEGIATAN <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control admin-input @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                rows="8" placeholder="Tuliskan deskripsi lengkap kegiatan di sini..." required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                style="letter-spacing: 0.15em; font-size: 0.7rem;">DESKRIPSI MATERI / CATATAN SINGKAT <span
                                    class="text-muted">(OPSIONAL)</span></label>
                            <textarea class="form-control admin-input @error('materi') is-invalid @enderror" name="materi"
                                rows="3" placeholder="Detail materi tambahan atau ringkasan...">{{ old('materi') }}</textarea>
                            @error('materi') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">FOTO UTAMA (COVER)</label>
                                <input type="file" name="gambar_utama" class="form-control admin-input @error('gambar_utama') is-invalid @enderror" accept="image/*">
                                <div class="mt-2 x-small text-white-50 fw-bold">FORMAT: JPG, PNG, WEBP, HEIC, HEIF. MAKSIMAL 2MB.</div>
                                @error('gambar_utama') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">FOTO DOKUMENTASI (MAKS 6)</label>
                                <input type="file" name="dokumentasi[]" multiple class="form-control admin-input @error('dokumentasi') is-invalid @enderror" accept="image/*">
                                <div class="mt-2 x-small text-white-50 fw-bold">BISA PILIH HINGGA 6 GAMBAR SEKALIGUS.</div>
                                @error('dokumentasi') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                                @error('dokumentasi.*') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-5"
                            style="border-top: 1px solid rgba(255,255,255,0.05);">
                            <a href="{{ route('dashboard.kegiatan.index') }}"
                                class="btn btn-dark px-5 py-3 fw-black border-0 rounded-0"
                                style="background: rgba(255,255,255,0.05);">BATAL</a>
                            <button type="submit" class="btn btn-accent px-5 py-3 fw-black">
                                <i class="bi bi-save2-fill me-2"></i> SIMPAN AGENDA
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-4" style="background: var(--primary) !important; border: none; padding: 2.5rem;">
                <h2 class="h6 fw-black text-accent text-uppercase mb-4" style="letter-spacing: 0.15em;"><i
                        class="bi bi-lightbulb-fill me-2"></i>PANDUAN INPUT</h2>
                <ul class="small text-white-50 fw-bold list-unstyled" style="line-height: 2;">
                    <li class="mb-3 d-flex gap-2"><i class="bi bi-check2-circle text-accent"></i> <span>Verifikasi tanggal
                            pelaksanaan agar tidak bentrok.</span></li>
                    <li class="mb-3 d-flex gap-2"><i class="bi bi-check2-circle text-accent"></i> <span>Tulis lokasi secara
                            spesifik agar mudah ditemukan.</span></li>
                    <li class="mb-3 d-flex gap-2"><i class="bi bi-check2-circle text-accent"></i> <span>Umum: Kegiatan umum organisasi Cakra Manggala.</span></li>
                    <li class="mb-3 d-flex gap-2"><i class="bi bi-check2-circle text-accent"></i> <span>Gunung Hutan: Aktivitas divisi Gunung Hutan (GH).</span></li>
                    <li class="d-flex gap-2"><i class="bi bi-check2-circle text-accent"></i> <span>Panjat Tebing: Aktivitas divisi Panjat Tebing (RC).</span></li>
                </ul>
            </div>

            <div class="admin-card"
                style="background: rgba(255,255,255,0.02); border-color: rgba(255,255,255,0.05); padding: 2rem;">
                <h2 class="h6 fw-black text-white text-uppercase mb-4" style="letter-spacing: 0.15em;"><i
                        class="bi bi-clock-history me-2"></i>AGENDA TERBARU</h2>
                @php $recentKegiatans = \App\Models\Kegiatan::latest()->take(5)->get(); @endphp
                <div class="d-grid gap-3">
                    @forelse($recentKegiatans as $recent)
                        <div class="d-flex align-items-center gap-3 p-3 border border-white-5"
                            style="background: rgba(255,255,255,0.01);">
                            <div class="flex-shrink-0 text-center" style="width: 40px;">
                                <div class="fw-black text-white mb-0" style="font-size: 1.1rem; line-height: 1;">
                                    {{ $recent->tanggal_pelaksanaan->format('d') }}</div>
                                <div class="x-small text-accent fw-bold" style="font-size: 0.6rem;">
                                    {{ strtoupper($recent->tanggal_pelaksanaan->translatedFormat('M')) }}</div>
                            </div>
                            <div class="overflow-hidden">
                                <div class="fw-bold small text-white text-truncate">{{ $recent->judul_kegiatan }}</div>
                                <div class="x-small text-white-50">{{ $recent->tempat }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-white-50 small italic text-center mb-0">Belum ada agenda terdaftar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .border-white-5 {
        border-color: rgba(255, 255, 255, 0.05) !important;
    }
</style>