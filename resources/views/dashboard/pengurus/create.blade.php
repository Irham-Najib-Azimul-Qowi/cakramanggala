@extends('layouts.dashboard')

@section('title', 'Tambah Pengurus Baru')

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.pengurus.index') }}"
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
                        <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.01em;">TAMBAH PENGURUS</h1>
                        <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Daftarkan
                            Personel Pengurus Baru</p>
                    </div>
                    <i class="bi bi-person-plus-fill"
                        style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
                </div>

                <div class="p-4 p-lg-5">
                    <form action="{{ route('dashboard.pengurus.store') }}" method="POST" enctype="multipart/form-data">
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
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">NIM</label>
                                <input type="text" name="nim"
                                    class="form-control admin-input @error('nim') is-invalid @enderror"
                                    value="{{ old('nim') }}" placeholder="Contoh: 210411100001">
                                @error('nim') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">EMAIL</label>
                                <input type="email" name="email"
                                    class="form-control admin-input @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="Contoh: pengurus@domain.com">
                                @error('email') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">JABATAN <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="jabatan"
                                    class="form-control admin-input @error('jabatan') is-invalid @enderror"
                                    value="{{ old('jabatan') }}" placeholder="Contoh: Ketua Umum" required>
                                @error('jabatan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">PRODI & SEMESTER</label>
                                <input type="text" name="prodi_semester"
                                    class="form-control admin-input @error('prodi_semester') is-invalid @enderror"
                                    value="{{ old('prodi_semester') }}" placeholder="Contoh: Teknik Elektro / Semester 4">
                                @error('prodi_semester') <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">URL INSTAGRAM</label>
                                <input type="url" name="instagram_url"
                                    class="form-control admin-input @error('instagram_url') is-invalid @enderror"
                                    value="{{ old('instagram_url') }}" placeholder="https://instagram.com/username">
                                @error('instagram_url') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">URUTAN <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="urutan"
                                    class="form-control admin-input @error('urutan') is-invalid @enderror"
                                    value="{{ old('urutan', 1) }}" required>
                                @error('urutan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">STATUS <span
                                        class="text-danger">*</span></label>
                                <select name="status" class="form-select admin-select @error('status') is-invalid @enderror"
                                    required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>AKTIF</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>NON-AKTIF
                                    </option>
                                </select>
                                @error('status') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">FOTO PROFIL</label>
                                <input type="file" name="foto"
                                    class="form-control admin-input @error('foto') is-invalid @enderror" accept="image/*">
                                <div class="mt-2 x-small text-white-50 fw-bold">FORMAT: JPG, PNG, WEBP. MAKSIMAL 2MB.</div>
                                @error('foto') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 pt-5"
                                style="border-top: 1px solid rgba(255,255,255,0.05); margin-top: 3rem;">
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-accent px-5 py-3 fw-black">
                                        <i class="bi bi-save2-fill me-2"></i> SIMPAN DATA
                                    </button>
                                    <a href="{{ route('dashboard.pengurus.index') }}"
                                        class="btn btn-dark px-5 py-3 fw-black border-0 rounded-0"
                                        style="background: rgba(255,255,255,0.05);">BATAL</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection