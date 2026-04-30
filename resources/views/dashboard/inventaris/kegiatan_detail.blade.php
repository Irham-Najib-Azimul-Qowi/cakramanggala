@extends('layouts.dashboard')

@section('title', 'Detail Kegiatan - ' . $kegiatan->name)

@section('content')
    <div class="mb-4">
        <a href="{{ route('dashboard.inventaris.index') }}" class="btn-accent text-decoration-none py-2 px-3">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="admin-card">
                <h3 class="h6 fw-bold text-accent text-uppercase mb-4" style="letter-spacing: 0.1em;">
                    Informasi Kegiatan
                </h3>
                <div class="mb-3">
                    <label class="stat-label">Nama Kegiatan</label>
                    <div class="fw-bold fs-5 text-white">{{ $kegiatan->name }}</div>
                </div>
                <div class="mb-3">
                    <label class="stat-label">Tanggal</label>
                    <div class="text-white">{{ \Carbon\Carbon::parse($kegiatan->date)->format('d F Y') }}</div>
                </div>
                <div class="mb-3">
                    <label class="stat-label">Status</label>
                    <div>
                        <span class="admin-badge 
                            {{ $kegiatan->status == 'completed' ? 'admin-badge--success' : ($kegiatan->status == 'ongoing' ? 'admin-badge--warning' : '') }}">
                            {{ strtoupper($kegiatan->status) }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="stat-label">Dibuat Oleh</label>
                    <div class="text-white">{{ $kegiatan->creator->name ?? 'Unknown' }}</div>
                </div>
                <div class="mb-0">
                    <label class="stat-label">Deskripsi</label>
                    <div class="text-white small">{{ $kegiatan->description ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="admin-card">
                <h3 class="h6 fw-bold text-accent text-uppercase mb-4" style="letter-spacing: 0.1em;">
                    <i class="bi bi-tools me-2"></i> Daftar Alat yang Digunakan
                </h3>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th class="text-center">Jumlah Dipakai</th>
                                <th>Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kegiatan->alats as $alat)
                                <tr>
                                    <td class="fw-bold">{{ $alat->name }}</td>
                                    <td>{{ $alat->category ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-accent text-dark fw-bold px-3 py-2">
                                            {{ $alat->pivot->qty }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="admin-badge {{ $alat->condition == 'good' ? 'admin-badge--success' : 'admin-badge--danger' }}">
                                            {{ $alat->condition == 'good' ? 'Bagus' : 'Rusak' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">Kegiatan ini belum menggunakan alat apapun.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
