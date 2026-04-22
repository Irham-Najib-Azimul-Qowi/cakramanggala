@extends('layouts.dashboard')

@section('title', 'Daftar Artikel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Daftar Artikel</h3>
        <p class="text-muted small">Kelola konten berita dan edukasi di website.</p>
    </div>
    <a href="{{ route('dashboard.artikel.create') }}" class="btn btn-premium-admin btn-sm px-3 rounded-pill">
        <i class="bi bi-plus-lg me-1"></i> Tulis Artikel
    </a>
</div>

{{-- Wide Artikel Cards --}}
<div class="vstack gap-3">
    @forelse($artikels as $artikel)
        <div class="wide-card p-3">
            <div class="row align-items-center g-3">
                <div class="col-auto">
                    <div class="artikel-thumb">
                        @if($artikel->gambar_utama)
                            <img src="{{ asset($artikel->gambar_utama) }}" alt="{{ $artikel->judul }}">
                        @else
                            <i class="bi bi-image text-muted opacity-25"></i>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <h6 class="fw-bold mb-0 text-truncate" style="max-width: 400px;">{{ $artikel->judul }}</h6>
                        <span class="badge-status {{ $artikel->status == 'published' ? 'published' : 'draft' }}">
                            {{ strtoupper($artikel->status) }}
                        </span>
                    </div>
                    <div class="text-muted smaller">
                        <i class="bi bi-person me-1"></i> {{ optional($artikel->user)->name ?? 'Admin' }} • 
                        <i class="bi bi-calendar me-1"></i> {{ $artikel->created_at->format('d M Y') }} • 
                        <i class="bi bi-eye me-1"></i> {{ number_format($artikel->views) }} Views
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.artikel.edit', $artikel) }}" class="btn btn-light btn-sm rounded-pill px-3 fw-bold btn-action">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.artikel.toggle-status', $artikel) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-{{ $artikel->status == 'published' ? 'outline-secondary' : 'outline-success' }} btn-sm rounded-pill px-3 fw-bold btn-action">
                                <i class="bi bi-{{ $artikel->status == 'published' ? 'eye-slash' : 'eye' }} me-1"></i>
                                {{ $artikel->status == 'published' ? 'Draft' : 'Publish' }}
                            </button>
                        </form>
                        <a href="{{ route('dashboard.artikel.show', $artikel) }}" class="btn btn-outline-primary btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card border-0 p-5 text-center rounded-4" style="background: var(--surface-panel);">
            <i class="bi bi-journal-x display-1 text-muted opacity-25"></i>
            <p class="text-muted mt-3">Belum ada artikel.</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $artikels->links() }}
</div>

<style>
    .wide-card {
        background: var(--surface-panel);
        border: 1px solid var(--border-soft);
        border-radius: 16px;
        transition: all 0.25s ease;
    }

    .wide-card:hover {
        transform: scale(1.005);
        border-color: var(--accent);
        box-shadow: 0 10px 30px rgba(7, 17, 12, 0.05);
    }

    .artikel-thumb {
        width: 80px;
        height: 60px;
        border-radius: 10px;
        background: var(--surface-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .artikel-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .badge-status {
        font-size: 0.6rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        padding: 2px 8px;
        border-radius: 4px;
    }

    .badge-status.published { background: #e6f7ef; color: #1a4331; }
    .badge-status.draft { background: #f3f4f6; color: #6b7280; }

    .btn-action { font-size: 0.75rem; }
    .smaller { font-size: 0.75rem; }
</style>
@endsection
