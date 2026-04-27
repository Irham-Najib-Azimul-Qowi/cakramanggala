@extends('layouts.dashboard')

@section('title', 'Data Pendaftar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.02em;">CALON ANGGOTA</h1>
            <p class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Manajemen Rekrutmen Cakra
                Manggala</p>
        </div>
        <a href="{{ route('dashboard.pendaftar.export') }}" class="btn btn-accent d-inline-flex align-items-center gap-2">
            <i class="bi bi-file-earmark-spreadsheet-fill"></i> EXPORT DATA
        </a>
    </div>

    {{-- Filters --}}
    <div class="admin-card mb-5" style="padding: 1.5rem 2.5rem;">
        <form action="{{ route('dashboard.pendaftar') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="small text-white-50 fw-bold text-uppercase mb-2 d-block"
                    style="letter-spacing: 0.1em; font-size: 0.65rem;">Cari Mahasiswa</label>
                <input type="text" name="search" class="form-control admin-input" placeholder="Nama atau NIM..."
                    value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-4">
                <label class="small text-white-50 fw-bold text-uppercase mb-2 d-block"
                    style="letter-spacing: 0.1em; font-size: 0.65rem;">Jurusan</label>
                <select name="jurusan" class="form-select admin-select">
                    <option value="">Semua Jurusan</option>
                    <option value="Teknik" {{ ($jurusan ?? '') == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                    <option value="Akuntansi" {{ ($jurusan ?? '') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                    <option value="Administrasi Bisnis" {{ ($jurusan ?? '') == 'Administrasi Bisnis' ? 'selected' : '' }}>
                        Administrasi Bisnis</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100 py-2 border-0 rounded-0 fw-bold"
                    style="background: var(--primary); height: 50px; letter-spacing: 0.1em;">FILTER</button>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>NIM</th>
                    <th class="d-none d-md-table-cell">Jurusan</th>
                    <th class="d-none d-md-table-cell text-center">Status</th>
                    <th class="d-none d-md-table-cell">Terdaftar</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftar as $p)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-sm">
                                    @if($p->foto_diri)
                                        <img src="{{ asset($p->foto_diri) }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        {{ strtoupper(substr($p->nama_lengkap, 0, 1)) }}
                                    @endif
                                </div>
                                <span class="fw-bold">{{ $p->nama_lengkap }}</span>
                            </div>
                        </td>
                        <td class="font-monospace small text-white-50">{{ $p->nim }}</td>
                        <td class="small text-white-50 d-none d-md-table-cell">{{ $p->jurusan }}</td>
                        <td class="d-none d-md-table-cell text-center">
                            @if($p->is_approved)
                                <span class="admin-badge admin-badge--success">APPROVED</span>
                            @elseif($p->status == 'rejected')
                                <span class="admin-badge admin-badge--danger">REJECTED</span>
                            @else
                                <span class="admin-badge admin-badge--warning">PENDING</span>
                            @endif
                        </td>
                        <td class="small text-white-50 d-none d-md-table-cell text-uppercase">
                            {{ $p->created_at->format('d M Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('dashboard.pendaftar.show', $p->id) }}"
                                class="btn btn-sm btn-outline-light border-0 rounded-0 fw-bold px-3"
                                style="font-size: 0.7rem; background: rgba(255,255,255,0.05); letter-spacing: 0.1em;">LIHAT</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-white-50 italic">Tidak ada pendaftar yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $pendaftar->links() }}
    </div>
@endsection