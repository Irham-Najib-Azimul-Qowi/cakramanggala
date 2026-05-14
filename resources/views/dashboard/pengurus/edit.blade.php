@extends('layouts.dashboard')

@section('title', 'Edit Data Pengurus')

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
                        <p class="mb-2 text-accent x-small fw-black text-uppercase"
                            style="letter-spacing: 0.2em; font-size: 0.65rem;">SUNTING PERSONEL</p>
                        <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.01em;">{{ strtoupper($pengurus->nama) }}</h1>
                        <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">JABATAN:
                            {{ strtoupper($pengurus->jabatan) }}
                        </p>
                    </div>
                    <i class="bi bi-pencil-square"
                        style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
                </div>

                <div class="p-4 p-lg-5">
                    <form action="{{ route('dashboard.pengurus.update', $pengurus->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-12 text-center mb-4">
                                <div class="avatar-lg mx-auto mb-3"
                                    style="width: 120px; height: 120px; border: 4px solid var(--accent); background: #000; overflow: hidden;">
                                    @if($pengurus->foto)
                                        <img src="{{ asset($pengurus->foto) }}" class="w-100 h-100" style="object-fit: cover;">
                                    @else
                                        <div class="h-100 d-flex align-items-center justify-content-center text-accent fw-black"
                                            style="font-size: 3rem;">
                                            {{ strtoupper(substr($pengurus->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <span class="x-small fw-black text-white-50 text-uppercase"
                                    style="letter-spacing: 0.1em;">FOTO SAAT INI</span>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">NAMA LENGKAP <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama"
                                    class="form-control admin-input @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $pengurus->nama) }}" required>
                                @error('nama') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">JABATAN <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="jabatan"
                                    class="form-control admin-input @error('jabatan') is-invalid @enderror"
                                    value="{{ old('jabatan', $pengurus->jabatan) }}" required>
                                @error('jabatan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">PRODI & SEMESTER</label>
                                <input type="text" name="prodi_semester"
                                    class="form-control admin-input @error('prodi_semester') is-invalid @enderror"
                                    value="{{ old('prodi_semester', $pengurus->prodi_semester) }}"
                                    placeholder="Contoh: Teknik Elektro / Semester 4">
                                @error('prodi_semester') <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">URL INSTAGRAM</label>
                                <input type="url" name="instagram_url"
                                    class="form-control admin-input @error('instagram_url') is-invalid @enderror"
                                    value="{{ old('instagram_url', $pengurus->instagram_url) }}"
                                    placeholder="https://instagram.com/username">
                                @error('instagram_url') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">URUTAN <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="urutan"
                                    class="form-control admin-input @error('urutan') is-invalid @enderror"
                                    value="{{ old('urutan', $pengurus->urutan) }}" required>
                                @error('urutan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">STATUS <span
                                        class="text-danger">*</span></label>
                                <select name="status" class="form-select admin-select @error('status') is-invalid @enderror"
                                    required>
                                    <option value="active" {{ old('status', $pengurus->status) == 'active' ? 'selected' : '' }}>AKTIF</option>
                                    <option value="inactive" {{ old('status', $pengurus->status) == 'inactive' ? 'selected' : '' }}>NON-AKTIF</option>
                                </select>
                                @error('status') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-black small text-uppercase text-accent mb-3"
                                    style="letter-spacing: 0.15em; font-size: 0.7rem;">GANTI FOTO PROFIL</label>
                                <input type="file" name="foto"
                                    class="form-control admin-input @error('foto') is-invalid @enderror" accept="image/*">
                                <div class="mt-2 x-small text-white-50 fw-bold">BIARKAN KOSONG JIKA TIDAK INGIN MENGUBAH
                                    FOTO. MAKSIMAL 2MB.</div>
                                @error('foto') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 pt-5"
                                style="border-top: 1px solid rgba(255,255,255,0.05); margin-top: 3rem;">
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-accent px-5 py-3 fw-black">
                                        <i class="bi bi-check2-all me-2"></i> PERBARUI DATA
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