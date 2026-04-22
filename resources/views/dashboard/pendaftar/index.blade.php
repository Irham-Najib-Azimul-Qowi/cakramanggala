@extends('layouts.dashboard')

@section('title', 'Data Pendaftar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Data Pendaftar</h3>
        <p class="text-muted small">Kelola seluruh calon anggota baru UKM Cakra Manggala.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard.pendaftar.export') }}" class="btn btn-premium-admin btn-sm px-3 rounded-pill">
            <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel
        </a>
    </div>
</div>

{{-- Filters --}}
<div class="card border-0 p-3 mb-4 rounded-4" style="background: var(--surface-panel); border: 1px solid var(--border-soft) !important;">
    <form action="{{ route('dashboard.pendaftar') }}" method="GET" class="row g-2">
        <div class="col-md-5">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Cari nama atau NIM..." value="{{ $search ?? '' }}">
            </div>
        </div>
        <div class="col-md-3">
            <select name="jurusan" class="form-select form-select-sm">
                <option value="">Semua Jurusan</option>
                <option value="Teknik" {{ ($jurusan ?? '') == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                <option value="Akuntansi" {{ ($jurusan ?? '') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                <option value="Administrasi Bisnis" {{ ($jurusan ?? '') == 'Administrasi Bisnis' ? 'selected' : '' }}>Administrasi Bisnis</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-sm w-100 rounded-pill">Filter</button>
        </div>
    </form>
</div>

{{-- Wide Horizontal Cards List --}}
<div class="vstack gap-3">
    @forelse($pendaftar as $p)
        <div class="wide-card p-3">
            <div class="row align-items-center g-3">
                <div class="col-auto">
                    <div class="avatar-wide">
                        @if($p->foto_diri)
                            <img src="{{ asset($p->foto_diri) }}" alt="{{ $p->nama_lengkap }}">
                        @else
                            {{ strtoupper(substr($p->nama_lengkap, 0, 1)) }}
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <h6 class="fw-bold mb-0">{{ $p->nama_lengkap }}</h6>
                        <span class="badge-status {{ $p->is_approved ? 'approved' : ($p->status == 'rejected' ? 'rejected' : 'pending') }}">
                            {{ $p->is_approved ? 'Disetujui' : ($p->status == 'rejected' ? 'Ditolak' : 'Checking') }}
                        </span>
                    </div>
                    <div class="text-muted smaller">
                        <span class="fw-bold text-primary">{{ $p->nim }}</span> • {{ $p->program_studi }} • {{ $p->jurusan }}
                    </div>
                </div>
                <div class="col-auto d-none d-md-block">
                    <div class="text-end">
                        <div class="small fw-bold">{{ $p->created_at->format('d M Y') }}</div>
                        <div class="smaller text-muted">{{ $p->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="{{ route('dashboard.pendaftar.show', $p->id) }}" class="btn btn-outline-primary btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="card border-0 p-5 text-center rounded-4" style="background: var(--surface-panel);">
            <i class="bi bi-person-x display-1 text-muted opacity-25"></i>
            <p class="text-muted mt-3">Tidak ada data pendaftar.</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $pendaftar->links() }}
</div>

<style>
    .wide-card {
        background: var(--surface-panel);
        border: 1px solid var(--border-soft);
        border-radius: 16px;
        transition: all 0.25s ease;
    }

    .wide-card:hover {
        transform: scale(1.01);
        border-color: var(--accent);
        box-shadow: 0 10px 30px rgba(7, 17, 12, 0.05);
    }

    .avatar-wide {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        background: var(--surface-soft);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.2rem;
        overflow: hidden;
    }

    .avatar-wide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .badge-status {
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .badge-status.approved { background: #e6f7ef; color: #1a4331; }
    .badge-status.rejected { background: #fef2f2; color: #991b1b; }
    .badge-status.pending { background: #fffbeb; color: #92400e; }

    .smaller { font-size: 0.75rem; }
</style>
@endsection
