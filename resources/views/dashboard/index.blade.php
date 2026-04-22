@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card-summary p-4">
            <div class="icon-box"><i class="bi bi-people"></i></div>
            <div>
                <div class="label">Total Pendaftar</div>
                <div class="value">{{ $stats['total_pendaftar'] }}</div>
                <div class="trend text-success"><i class="bi bi-arrow-up"></i> 12% New</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card-summary p-4">
            <div class="icon-box"><i class="bi bi-journal-text"></i></div>
            <div>
                <div class="label">Artikel Baru</div>
                <div class="value">{{ $stats['artikel_bulan_ini'] }}</div>
                <div class="trend text-muted">Bulan ini</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card-summary p-4">
            <div class="icon-box"><i class="bi bi-calendar-event"></i></div>
            <div>
                <div class="label">Kegiatan Aktif</div>
                <div class="value">{{ $stats['kegiatan_aktif'] }}</div>
                <div class="trend text-muted">Mendatang</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card-summary p-4">
            <div class="icon-box"><i class="bi bi-chat-dots"></i></div>
            <div>
                <div class="label">Pesan Baru</div>
                <div class="value text-danger">{{ $stats['pesan_baru'] }}</div>
                <div class="trend text-muted">Belum dibaca</div>
            </div>
        </div>
    </div>
</div>

{{-- Wide Horizontal Scroll List --}}
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Pendaftar Terbaru</h5>
        <a href="{{ route('dashboard.pendaftar') }}" class="text-decoration-none small fw-bold text-primary">
            Kelola Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    
    <div class="scroll-wrapper">
        <div class="horizontal-scroll">
            @forelse($recent_pendaftar as $pendaftar)
                <a href="{{ route('dashboard.pendaftar.show', $pendaftar->id) }}" class="scroll-card">
                    <div class="sc-avatar">
                        @if($pendaftar->foto_diri)
                            <img src="{{ asset($pendaftar->foto_diri) }}" alt="{{ $pendaftar->nama_lengkap }}">
                        @else
                            {{ strtoupper(substr($pendaftar->nama_lengkap, 0, 1)) }}
                        @endif
                    </div>
                    <div class="sc-info">
                        <div class="sc-name">{{ Str::limit($pendaftar->nama_lengkap, 16) }}</div>
                        <div class="sc-sub">{{ substr($pendaftar->jurusan, 0, 3) }} • {{ $pendaftar->nim }}</div>
                    </div>
                </a>
            @empty
                <p class="text-muted small">Belum ada pendaftar baru.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 p-4 rounded-4" style="background: var(--surface-panel); border: 1px solid var(--border-soft) !important;">
            <h6 class="fw-bold mb-4">Aksi Cepat Fitur</h6>
            <div class="row g-3">
                <div class="col-sm-6">
                    <a href="{{ route('dashboard.artikel.create') }}" class="quick-link">
                        <div class="ql-icon bg-primary text-white"><i class="bi bi-plus-lg"></i></div>
                        <div>
                            <div class="fw-bold small">Tulis Artikel</div>
                            <div class="smaller text-muted">Update berita terbaru</div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('dashboard.kegiatan.create') }}" class="quick-link">
                        <div class="ql-icon bg-secondary text-white"><i class="bi bi-calendar-plus"></i></div>
                        <div>
                            <div class="fw-bold small">Tambah Agenda</div>
                            <div class="smaller text-muted">Jadwal kegiatan baru</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 p-4 rounded-4" style="background: var(--surface-panel); border: 1px solid var(--border-soft) !important;">
            <h6 class="fw-bold mb-4">Akses Sistem</h6>
            <div class="d-grid gap-2">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill fw-bold">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Live Website
                </a>
                <a href="{{ route('dashboard.pendaftar.export') }}" class="btn btn-outline-success btn-sm rounded-pill fw-bold">
                    <i class="bi bi-file-earmark-excel me-1"></i> Backup Data (XLS)
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .card-summary {
        background: var(--surface-panel);
        border: 1px solid var(--border-soft);
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: 0.3s;
    }

    .card-summary:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
        box-shadow: 0 15px 35px rgba(7, 17, 12, 0.08);
    }

    .icon-box {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: var(--surface-soft);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }

    .card-summary .label { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: var(--muted); letter-spacing: 0.5px; }
    .card-summary .value { font-size: 1.6rem; font-weight: 800; color: var(--dark); line-height: 1.2; }
    .card-summary .trend { font-size: 0.75rem; font-weight: 600; }

    /* Horizontal Scroll */
    .scroll-wrapper { margin: 0 -2.5rem; padding: 0 2.5rem; }
    .horizontal-scroll { display: flex; gap: 20px; overflow-x: auto; padding: 10px 0 20px; scrollbar-width: none; }
    .horizontal-scroll::-webkit-scrollbar { display: none; }

    .scroll-card {
        min-width: 200px;
        background: var(--surface-panel);
        border: 1px solid var(--border-soft);
        padding: 1rem;
        border-radius: 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: inherit;
        transition: 0.3s;
    }

    .scroll-card:hover { transform: translateY(-3px); border-color: var(--primary); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }

    .sc-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--surface-soft);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        overflow: hidden;
    }
    .sc-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .sc-name { font-weight: 700; font-size: 0.88rem; color: var(--dark); }
    .sc-sub { font-size: 0.7rem; color: var(--muted); font-weight: 600; text-transform: uppercase; }

    .quick-link {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 1rem;
        background: var(--surface-soft);
        border-radius: 16px;
        text-decoration: none;
        color: inherit;
        transition: 0.3s;
    }
    .quick-link:hover { background: white; transform: scale(1.02); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .ql-icon { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; }

    .smaller { font-size: 0.72rem; }
</style>
@endsection
