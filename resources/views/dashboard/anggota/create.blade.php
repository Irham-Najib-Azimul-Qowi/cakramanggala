@extends('layouts.dashboard')

@section('title', 'Tambah Anggota Baru')

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.anggota.index') }}"
            class="btn btn-sm d-inline-flex align-items-center gap-2 border-0 rounded-0"
            style="background: rgba(255,255,255,0.05); color: #fff; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.8rem 1.5rem;">
            <i class="bi bi-arrow-left"></i> KEMBALI
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="admin-card p-0 overflow-hidden border-0 shadow-lg">
                <div class="p-4 p-lg-5"
                    style="background: var(--primary); color: #fff; position: relative; overflow: hidden;">
                    <div style="position: relative; z-index: 2;">
                        <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.01em;">TAMBAH ANGGOTA</h1>
                        <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Daftarkan Anggota Baru Cakra Manggala</p>
                    </div>
                    <i class="bi bi-person-plus-fill"
                        style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
                </div>

                <div class="p-4 p-lg-5">
                    <form action="{{ route('dashboard.anggota.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">NAMA LENGKAP <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama"
                                    class="form-control admin-input @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}" placeholder="Contoh: Najib Azimul Qowi" required>
                                @error('nama') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">NIM (Nomor Induk Mahasiswa)</label>
                                <input type="text" name="nim"
                                    class="form-control admin-input @error('nim') is-invalid @enderror"
                                    value="{{ old('nim') }}" placeholder="Contoh: 210411100001">
                                @error('nim') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">Email Anggota</label>
                                <input type="email" name="email"
                                    class="form-control admin-input @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="Contoh: anggota@domain.com">
                                @error('email') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">NIA (Nomor Induk Anggota)</label>
                                <input type="text" name="nia"
                                    class="form-control admin-input @error('nia') is-invalid @enderror"
                                    value="{{ old('nia') }}" placeholder="Contoh: CM-XIV-098">
                                @error('nia') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">ANGKATAN <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="angkatan"
                                    class="form-control admin-input @error('angkatan') is-invalid @enderror"
                                    value="{{ old('angkatan') }}" placeholder="Contoh: XIV" required>
                                @error('angkatan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">STATUS ANGGOTA <span
                                        class="text-danger">*</span></label>
                                <select name="status" class="form-select admin-input @error('status') is-invalid @enderror" required>
                                    <option value="anggota baru" {{ old('status') == 'anggota baru' ? 'selected' : '' }}>Anggota Baru</option>
                                    <option value="anggota" {{ old('status', 'anggota') == 'anggota' ? 'selected' : '' }}>Anggota Aktif</option>
                                    <option value="demisioner" {{ old('status') == 'demisioner' ? 'selected' : '' }}>Demisioner</option>
                                    <option value="alumni" {{ old('status') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                                </select>
                                @error('status') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">FOTO PROFIL</label>
                                <input type="file" name="foto"
                                    class="form-control admin-input @error('foto') is-invalid @enderror" accept="image/*">
                                <div class="text-white-50 mt-2" style="font-size: 0.7rem;">Rekomendasi rasio 1:1 (Square), format: JPG, JPEG, PNG, WEBP (Maks 2MB)</div>
                                @error('foto') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 mt-5">
                                <hr class="border-secondary opacity-25">
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('dashboard.anggota.index') }}"
                                        class="btn btn-outline-light rounded-0 px-4 fw-bold"
                                        style="font-size: 0.75rem; letter-spacing: 0.1em;">BATAL</a>
                                    <button type="submit" class="btn btn-accent rounded-0 px-4 fw-bold"
                                        style="font-size: 0.75rem; letter-spacing: 0.1em;">SIMPAN DATA</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
