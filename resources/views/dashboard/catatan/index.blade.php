@extends('layouts.dashboard')

@section('title', 'Manajemen Catatan Perjalanan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.02em;">CATATAN PERJALANAN</h1>
            <p class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Pusat Dokumentasi Perjalanan & Diklat</p>
        </div>
        <a href="{{ route('dashboard.catatan-perjalanan.create') }}" class="btn btn-accent d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> BUAT CATATAN BARU
        </a>
    </div>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('dashboard.catatan-perjalanan.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="admin-input form-control" value="{{ $search }}" placeholder="Cari judul, penulis, lokasi...">
                    <button class="btn btn-accent px-4" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Informasi Jurnal</th>
                    <th class="d-none d-md-table-cell">Penulis & Angkatan</th>
                    <th class="d-none d-md-table-cell">Lokasi</th>
                    <th class="d-none d-md-table-cell text-center">Views</th>
                    <th class="d-none d-md-table-cell text-center">Status</th>
                    <th class="text-end">Opsi Manajemen</th>
                </tr>
            </thead>
            <tbody>
                @forelse($catatans as $catatan)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-4">
                                <div style="width: 50px; height: 50px; background: rgba(0,0,0,0.5); flex-shrink: 0; border: 1px solid rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-journal-text text-accent fs-4"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <div class="fw-bold mb-1 text-truncate" style="font-size: 1rem; max-width: 350px;">
                                        {{ $catatan->judul }}
                                    </div>
                                    <div class="text-white-50 x-small fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.05em;">
                                        {{ $catatan->formatted_date }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="small text-white-50 d-none d-md-table-cell">
                            <div class="fw-bold text-white">{{ $catatan->penulis }}</div>
                            <div class="x-small">{{ $catatan->angkatan ?? 'Tidak ada angkatan' }}</div>
                        </td>
                        <td class="small text-white-50 d-none d-md-table-cell">
                            <span class="badge bg-secondary rounded-0 py-2 px-3 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.65rem;">
                                <i class="bi bi-geo-alt-fill me-1 text-accent"></i> {{ $catatan->lokasi ?? '-' }}
                            </span>
                        </td>
                        <td class="text-center d-none d-md-table-cell">
                            <div class="small fw-bold"><i class="bi bi-eye-fill text-accent me-1"></i> {{ number_format($catatan->views) }}</div>
                        </td>
                        <td class="text-center d-none d-md-table-cell">
                            @if($catatan->status == 'published')
                                <span class="admin-badge admin-badge--success">PUBLISHED</span>
                            @else
                                <span class="admin-badge">DRAFT</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard.catatan-perjalanan.edit', $catatan) }}"
                                    class="btn btn-sm btn-outline-light border-0 rounded-0 fw-bold px-3"
                                    style="font-size: 0.7rem; background: rgba(255,255,255,0.05); letter-spacing: 0.1em;">EDIT</a>
                                <form action="{{ route('dashboard.catatan-perjalanan.toggle-status', $catatan) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm border-0 rounded-0 fw-bold px-3"
                                        style="font-size: 0.7rem; background: {{ $catatan->status == 'published' ? 'rgba(255,99,102,0.1)' : 'var(--primary)' }}; color: {{ $catatan->status == 'published' ? '#ff6366' : 'var(--accent)' }}; letter-spacing: 0.1em;">
                                        {{ $catatan->status == 'published' ? 'DRAFT' : 'PUBLISH' }}
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.catatan-perjalanan.destroy', $catatan) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus catatan perjalanan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm border-0 rounded-0 fw-bold px-3"
                                        style="font-size: 0.7rem; background: rgba(255, 255, 255, 0.05); color: #ff6366; letter-spacing: 0.1em;">HAPUS</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-white-50 italic">Belum ada catatan perjalanan yang didokumentasikan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $catatans->links() }}
    </div>
@endsection
