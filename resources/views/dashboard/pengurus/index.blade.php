@extends('layouts.dashboard')

@section('title', 'Manajemen Pengurus')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.02em;">DATA PENGURUS</h1>
            <p class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Manajemen Staf UKM Cakra
                Manggala</p>
        </div>
        <a href="{{ route('dashboard.pengurus.create') }}" class="btn btn-accent d-inline-flex align-items-center gap-2">
            <i class="bi bi-person-plus-fill"></i> TAMBAH PENGURUS
        </a>
    </div>

    <!-- Quick Settings Card for Period & Banner -->
    <div class="admin-card mb-5 p-4 p-lg-5">
        <h2 class="h5 fw-black text-white text-uppercase mb-4" style="letter-spacing: 0.05em;">
            <i class="bi bi-gear text-accent me-2"></i> PENGATURAN HALAMAN KEPENGURUSAN
        </h2>
        <form action="{{ route('dashboard.pengurus.quick-settings') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4 align-items-start">
                <div class="col-md-4">
                    <label class="form-label fw-black small text-uppercase text-accent mb-2" style="letter-spacing: 0.1em; font-size: 0.65rem;">PERIODE KEPENGURUSAN AKTIF</label>
                    <input type="text" name="periode_pengurus" class="form-control admin-input" value="{{ old('periode_pengurus', $periode) }}" placeholder="Contoh: auto atau PERIODE 2024 — 2025" required>
                    <div class="text-white-50 x-small mt-1" style="font-size: 0.65rem;">Gunakan <code>auto</code> untuk tanggal berjalan.</div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-black small text-uppercase text-accent mb-2" style="letter-spacing: 0.1em; font-size: 0.65rem;">ANGKATAN PENDAFTAR DEFAULT</label>
                    <input type="text" name="angkatan_pendaftaran_default" class="form-control admin-input" value="{{ old('angkatan_pendaftaran_default', $angkatanDefault) }}" placeholder="Contoh: 14" required>
                    <div class="text-white-50 x-small mt-1" style="font-size: 0.65rem;">Otomatis disematkan saat approve.</div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-black small text-uppercase text-accent mb-2" style="letter-spacing: 0.1em; font-size: 0.65rem;">BANNER HALAMAN STRUKTUR</label>
                    <input type="file" name="banner_pengurus" class="form-control admin-input" accept="image/*">
                    @if($banner)
                        <div class="mt-2 x-small text-white-50" style="font-size: 0.65rem;">
                            <span class="text-accent fw-bold">Banner Saat Ini:</span> <a href="{{ asset($banner) }}" target="_blank" class="text-accent text-decoration-underline">{{ basename($banner) }}</a>
                        </div>
                    @else
                        <div class="mt-2 x-small text-white-50" style="font-size: 0.65rem;">Menggunakan banner bawaan system.</div>
                    @endif
                </div>
                <div class="col-md-2" style="margin-top: 1.85rem;">
                    <button type="submit" class="btn btn-accent w-100 py-3 fw-black text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.1em;">
                        <i class="bi bi-save-fill me-1"></i> SIMPAN
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-0 text-center fw-bold mb-4 py-3" style="background: rgba(25, 135, 84, 0.1); color: #20c997; border-left: 4px solid #20c997 !important;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 80px;">Urutan</th>
                    <th>Nama & Jabatan</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penguruses as $p)
                    <tr>
                        <td class="text-center">
                            @if($p->urutan == 0)
                                <span class="fw-black text-accent">0</span>
                                <div class="x-small text-white-50 fw-bold" style="font-size: 0.55rem; letter-spacing: 0.05em;">PEMBINA</div>
                            @else
                                <span class="fw-black text-accent">{{ $p->urutan }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-sm">
                                    @if($p->foto)
                                        <img src="{{ asset($p->foto) }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        {{ strtoupper(substr($p->nama, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold text-white">{{ $p->nama }}</div>
                                    <div class="x-small text-white-50 fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                                        {{ $p->jabatan }} @if($p->nim) | NIM. {{ $p->nim }} @endif @if($p->email) | {{ $p->email }} @endif</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($p->status == 'active')
                                <span class="admin-badge admin-badge--success">AKTIF</span>
                            @else
                                <span class="admin-badge">NON-AKTIF</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard.pengurus.edit', $p->id) }}"
                                    class="btn btn-sm btn-outline-light border-0 rounded-0 fw-bold px-3"
                                    style="font-size: 0.7rem; background: rgba(255,255,255,0.05); letter-spacing: 0.1em;">EDIT</a>
                                <form action="{{ route('dashboard.pengurus.destroy', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus data pengurus ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm border-0 rounded-0 fw-bold px-3"
                                        style="font-size: 0.7rem; background: rgba(255,99,102,0.1); color: #ff6366; letter-spacing: 0.1em;">HAPUS</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-white-50 italic">Data pengurus belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection