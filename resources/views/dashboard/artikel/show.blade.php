@extends('layouts.dashboard')

@section('title', 'Detail Artikel')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-2"
            style="background: rgba(0,0,0,0.04); border-radius: 0; color: var(--text); font-weight: 700; font-size: 0.8rem; letter-spacing: 0.05em;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard.artikel.edit', $artikel) }}"
                class="btn-accent text-decoration-none d-inline-flex align-items-center gap-2">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form action="{{ route('dashboard.artikel.destroy', $artikel) }}" method="POST"
                onsubmit="return confirm('Hapus artikel ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm px-3 py-2"
                    style="background: rgba(220,53,69,0.06); color: #dc3545; border-radius: 0; font-weight: 700; font-size: 0.8rem;">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div style="border: 1px solid var(--border-soft); overflow: hidden; background: #fff;">
                @if($artikel->gambar_utama)
                    <img src="{{ asset($artikel->gambar_utama) }}" class="w-100" style="max-height: 400px; object-fit: cover;">
                @endif
                <div class="p-4 p-lg-5">
                    <div class="mb-3">
                        <span
                            style="font-size: 0.62rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 10px; {{ $artikel->status == 'published' ? 'background: rgba(26,67,49,0.08); color: #1a4331;' : 'background: rgba(0,0,0,0.04); color: #888;' }}">{{ $artikel->status }}</span>
                        <small class="text-muted ms-2">{{ $artikel->created_at->format('d M Y') }}</small>
                    </div>
                    <h1 class="fw-bold mb-4" style="letter-spacing: -0.03em;">{{ $artikel->judul }}</h1>
                    <div style="white-space: pre-wrap; line-height: 1.9; color: #334139;">{!! nl2br(e($artikel->konten)) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="p-4" style="background: var(--primary); color: #fff;">
                <h6 class="fw-bold mb-4"
                    style="letter-spacing: 0.1em; text-transform: uppercase; font-size: 0.75rem; color: rgba(255,255,255,0.5);">
                    Statistik</h6>
                <div class="small">
                    <div class="d-flex justify-content-between mb-3 pb-3"
                        style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <span style="color: rgba(255,255,255,0.5);">Views</span>
                        <span class="fw-bold" style="color: var(--accent);">{{ number_format($artikel->views) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 pb-3"
                        style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <span style="color: rgba(255,255,255,0.5);">Penulis</span>
                        <span class="fw-bold">{{ $artikel->user->name }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span style="color: rgba(255,255,255,0.5);">Slug</span>
                        <span class="fw-bold"
                            style="font-family: monospace; font-size: 0.75rem;">{{ Str::limit($artikel->slug, 20) }}</span>
                    </div>
                </div>
                @if($artikel->status == 'published')
                    <a href="{{ route('artikel.show', $artikel->slug) }}" target="_blank" class="btn w-100 mt-4 py-2"
                        style="background: var(--accent); color: var(--primary); border-radius: 0; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase;">
                        <i class="bi bi-eye me-1"></i> Lihat di Website
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection