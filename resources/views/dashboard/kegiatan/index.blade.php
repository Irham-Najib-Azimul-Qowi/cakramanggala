@extends('layouts.dashboard')

@section('title', 'Agenda Kegiatan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.02em;">AGENDA & KEGIATAN</h1>
            <p class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Manajemen Aktivitas Cakra
                Manggala</p>
        </div>
        <a href="{{ route('dashboard.kegiatan.create') }}" class="btn btn-accent d-inline-flex align-items-center gap-2">
            <i class="bi bi-calendar-plus-fill"></i> TAMBAH AGENDA
        </a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 100px;">Jadwal</th>
                    <th style="width: 80px;">Foto</th>
                    <th>Detail Kegiatan</th>
                    <th class="d-none d-md-table-cell">Lokasi</th>
                    <th class="d-none d-md-table-cell text-center">Sifat</th>
                    <th class="text-end">Opsi Manajemen</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatans as $kegiatan)
                    <tr>
                        <td class="text-center">
                            <div class="d-inline-flex flex-column align-items-center justify-content-center"
                                style="width: 54px; height: 54px; background: var(--primary); border: 1px solid rgba(255,255,255,0.05);">
                                <span class="fw-black text-white"
                                    style="font-size: 1.25rem; line-height: 1;">{{ $kegiatan->tanggal_pelaksanaan->format('d') }}</span>
                                <span class="x-small fw-bold text-accent"
                                    style="font-size: 0.6rem; letter-spacing: 0.1em;">{{ strtoupper($kegiatan->tanggal_pelaksanaan->translatedFormat('M')) }}</span>
                            </div>
                        </td>
                        <td>
                            @if($kegiatan->gambar_utama)
                                <img src="{{ asset($kegiatan->gambar_utama) }}" style="width: 54px; height: 54px; object-fit: cover; border: 1px solid rgba(255,255,255,0.1);">
                            @else
                                <div style="width: 54px; height: 54px; background: rgba(255,255,255,0.02); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.05);">
                                    <i class="bi bi-image text-white-50"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-white mb-1" style="font-size: 1rem;">{{ $kegiatan->judul_kegiatan }}</div>
                            <div class="x-small text-white-50 fw-bold text-uppercase"
                                style="font-size: 0.65rem; letter-spacing: 0.05em;">PJ: {{ $kegiatan->kapel_pj }}</div>
                        </td>
                        <td class="small text-white-50 d-none d-md-table-cell">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-geo-alt-fill text-accent"></i>
                                {{ $kegiatan->tempat }}
                            </div>
                        </td>
                        <td class="text-center d-none d-md-table-cell">
                            @if($kegiatan->sifat == 'internal')
                                <span class="admin-badge admin-badge--success">INTERNAL</span>
                            @else
                                <span class="admin-badge admin-badge--warning">EKSTERNAL</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard.kegiatan.edit', $kegiatan) }}"
                                    class="btn btn-sm btn-outline-light border-0 rounded-0 fw-bold px-3"
                                    style="font-size: 0.7rem; background: rgba(255,255,255,0.05); letter-spacing: 0.1em;">EDIT</a>
                                <form action="{{ route('dashboard.kegiatan.destroy', $kegiatan) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus agenda ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm border-0 rounded-0 fw-bold px-3"
                                        style="font-size: 0.7rem; background: rgba(255,99,102,0.1); color: #ff6366; letter-spacing: 0.1em;">HAPUS</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-white-50 italic">Belum ada agenda kegiatan yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $kegiatans->links() }}
    </div>
@endsection