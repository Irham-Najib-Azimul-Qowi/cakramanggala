@extends('layouts.dashboard')

@section('title', 'Jadwal Kegiatan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Jadwal Kegiatan</h3>
        <p class="text-muted small">Kelola agenda kegiatan internal dan eksternal UKM.</p>
    </div>
    <a href="{{ route('dashboard.kegiatan.create') }}" class="btn btn-premium-admin btn-sm px-3 rounded-pill">
        <i class="bi bi-calendar-plus me-1"></i> Tambah Kegiatan
    </a>
</div>

{{-- Wide Kegiatan Cards --}}
<div class="vstack gap-3">
    @forelse($kegiatans as $kegiatan)
        <div class="wide-card p-3">
            <div class="row align-items-center g-3">
                <div class="col-auto">
                    <div class="kegiatan-date-box">
                        <div class="day">{{ $kegiatan->tanggal_pelaksanaan->format('d') }}</div>
                        <div class="month">{{ strtoupper($kegiatan->tanggal_pelaksanaan->format('M')) }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <h6 class="fw-bold mb-0 text-primary">{{ $kegiatan->judul_kegiatan }}</h6>
                        <span class="badge-type {{ $kegiatan->sifat == 'internal' ? 'internal' : 'eksternal' }}">
                            {{ strtoupper($kegiatan->sifat) }}
                        </span>
                    </div>
                    <div class="text-muted smaller">
                        <i class="bi bi-geo-alt me-1"></i> {{ $kegiatan->tempat }} • 
                        <i class="bi bi-person-badge me-1"></i> PJ: {{ $kegiatan->kapel_pj }} • 
                        <i class="bi bi-calendar-check me-1"></i> Tahun {{ $kegiatan->tahun }}
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.kegiatan.edit', $kegiatan) }}" class="btn btn-light btn-sm rounded-pill px-3 fw-bold btn-action">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.kegiatan.destroy', $kegiatan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kegiatan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold btn-action">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card border-0 p-5 text-center rounded-4" style="background: var(--surface-panel);">
            <i class="bi bi-calendar-x display-1 text-muted opacity-25"></i>
            <p class="text-muted mt-3">Belum ada jadwal kegiatan.</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $kegiatans->links() }}
</div>

<style>
    .wide-card {
        background: var(--surface-panel);
        border: 1px solid var(--border-soft);
        border-radius: 16px;
        transition: all 0.25s ease;
    }

    .wide-card:hover {
        transform: translateY(-3px);
        border-color: var(--accent);
        box-shadow: 0 10px 30px rgba(7, 17, 12, 0.05);
    }

    .kegiatan-date-box {
        width: 60px;
        height: 60px;
        background: var(--primary);
        color: white;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 15px rgba(26, 67, 49, 0.2);
    }

    .kegiatan-date-box .day { font-size: 1.4rem; font-weight: 800; line-height: 1; }
    .kegiatan-date-box .month { font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; }

    .badge-type {
        font-size: 0.6rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        padding: 2px 8px;
        border-radius: 4px;
    }

    .badge-type.internal { background: rgba(26, 67, 49, 0.05); color: var(--primary); }
    .badge-type.eksternal { background: #fff7ed; color: #c2410c; }

    .btn-action { font-size: 0.75rem; }
    .smaller { font-size: 0.75rem; }
</style>
@endsection
