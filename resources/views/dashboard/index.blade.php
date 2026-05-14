@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="row g-4 mb-5">
        @php
            $summaryItems = [
                ['icon' => 'bi-people-fill', 'label' => 'Total Pendaftar', 'value' => $stats['total_pendaftar'] ?? 0, 'color' => 'var(--accent)'],
                ['icon' => 'bi-journal-text', 'label' => 'Artikel Baru', 'value' => $stats['artikel_bulan_ini'] ?? 0, 'color' => '#fff'],
                ['icon' => 'bi-calendar-event', 'label' => 'Kegiatan Aktif', 'value' => $stats['kegiatan_aktif'] ?? 0, 'color' => 'var(--accent)'],
                ['icon' => 'bi-chat-dots-fill', 'label' => 'Pesan Masuk', 'value' => $stats['pesan_baru'] ?? 0, 'color' => '#ff6366'],
            ];
        @endphp
        @foreach($summaryItems as $item)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon" style="color: {{ $item['color'] }};">
                        <i class="bi {{ $item['icon'] }}"></i>
                    </div>
                    <div>
                        <div class="stat-label">{{ $item['label'] }}</div>
                        <div class="stat-value">{{ number_format($item['value']) }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4 mb-5">
        <div class="col-xl-8">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h6 fw-bold mb-0 text-uppercase text-accent" style="letter-spacing: 0.15em;">Pendaftar Terbaru</h2>
                    <a href="{{ route('dashboard.pendaftar') }}" class="text-decoration-none small fw-bold text-white-50 shadow-none">
                        KELOLA SEMUA <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Jurusan</th>
                                <th>NIM</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_pendaftar as $pendaftar)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-sm">{{ strtoupper(substr($pendaftar->nama_lengkap, 0, 1)) }}</div>
                                            <span class="fw-bold">{{ $pendaftar->nama_lengkap }}</span>
                                        </div>
                                    </td>
                                    <td class="text-white-50">{{ $pendaftar->jurusan }}</td>
                                    <td class="text-white-50 font-monospace small">{{ $pendaftar->nim }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('dashboard.pendaftar.show', $pendaftar->id) }}" class="btn btn-sm btn-outline-light border-0 rounded-0 fw-bold" style="font-size: 0.7rem; letter-spacing: 0.1em; background: rgba(255,255,255,0.05);">DETAIL</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-white-50 italic">Data pendaftar belum tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="admin-card mb-4">
                <h2 class="h6 fw-bold mb-4 text-uppercase text-accent" style="letter-spacing: 0.15em;">Aksi Cepat</h2>
                <div class="d-grid gap-3">
                    <a href="{{ route('dashboard.artikel.create') }}" class="quick-link">
                        <div class="quick-link__icon"><i class="bi bi-plus-lg"></i></div>
                        <div class="quick-link__body">
                            <span class="d-block fw-bold mb-1">Tulis Artikel</span>
                            <small class="text-white-50">Publikasi berita terbaru</small>
                        </div>
                    </a>
                    <a href="{{ route('dashboard.kegiatan.create') }}" class="quick-link">
                        <div class="quick-link__icon" style="background: rgba(255,255,255,0.05); color: var(--accent);"><i class="bi bi-calendar-plus"></i></div>
                        <div class="quick-link__body">
                            <span class="d-block fw-bold mb-1">Tambah Agenda</span>
                            <small class="text-white-50">Jadwalkan kegiatan baru</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="admin-card text-center" style="background: var(--primary) !important; border: none;">
                <h2 class="h6 fw-bold mb-4 text-uppercase text-white" style="letter-spacing: 0.15em;">Sistem Log</h2>
                <div class="icon-badge mb-4 mx-auto" style="width: 60px; height: 60px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;"><i class="bi bi-shield-check"></i></div>
                <p class="small text-white-50 mb-4 px-3">Pastikan data pendaftar selalu dicadangkan secara berkala untuk keperluan arsip organisasi.</p>
                <a href="{{ route('dashboard.pendaftar.export') }}" class="btn btn-accent w-100">
                    <i class="bi bi-cloud-arrow-down me-2"></i> BACKUP SEKARANG
                </a>
            </div>
        </div>
    </div>
@endsection