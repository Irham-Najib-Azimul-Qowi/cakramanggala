@extends('layouts.dashboard')

@section('title', 'Detail Pesan')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('dashboard.pesan') }}" class="btn btn-sm d-inline-flex align-items-center gap-2"
            style="background: rgba(0,0,0,0.04); border-radius: 0; color: var(--text); font-weight: 700; font-size: 0.8rem; letter-spacing: 0.05em;">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <form action="{{ route('dashboard.pesan.destroy', $pesan->id) }}" method="POST"
            onsubmit="return confirm('Hapus pesan ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm px-3 py-2"
                style="background: rgba(220,53,69,0.06); color: #dc3545; border-radius: 0; font-weight: 700; font-size: 0.75rem;">
                <i class="bi bi-trash me-1"></i> Hapus
            </button>
        </form>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div style="background: #fff; border: 1px solid var(--border-soft);">
                <div class="p-4 p-lg-5">
                    <h4 class="fw-bold mb-4" style="letter-spacing: -0.02em;">{{ $pesan->subjek }}</h4>
                    <div class="p-4" style="background: var(--surface-soft); white-space: pre-wrap; line-height: 1.8;">
                        {{ $pesan->pesan }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="p-4" style="background: var(--primary); color: #fff;">
                <h6 class="fw-bold mb-4"
                    style="font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: rgba(255,255,255,0.5);">
                    Pengirim</h6>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div
                        style="width: 44px; height: 44px; background: var(--accent); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800; flex-shrink: 0;">
                        {{ strtoupper(substr($pesan->nama, 0, 1)) }}
                    </div>
                    <div>
                        <div class="fw-bold">{{ $pesan->nama }}</div>
                        <div class="small" style="color: rgba(255,255,255,0.5);">{{ $pesan->email }}</div>
                    </div>
                </div>
                <div class="small mb-4" style="color: rgba(255,255,255,0.5);">
                    <i class="bi bi-calendar3 me-1"></i> {{ $pesan->created_at->format('d M Y, H:i') }}
                </div>
                <a href="mailto:{{ $pesan->email }}?subject=Re: {{ $pesan->subjek }}" class="btn w-100 py-2"
                    style="background: var(--accent); color: var(--primary); border-radius: 0; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase;">
                    <i class="bi bi-reply me-1"></i> Balas Email
                </a>
            </div>
        </div>
    </div>
@endsection