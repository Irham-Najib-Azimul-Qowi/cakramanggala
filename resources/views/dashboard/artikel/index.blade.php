@extends('layouts.dashboard')

@section('title', 'Manajemen Artikel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.02em;">KONTEN & ARTIKEL</h1>
            <p class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Pusat Publikasi Cakra
                Manggala</p>
        </div>
        <a href="{{ route('dashboard.artikel.create') }}" class="btn btn-accent d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> TULIS ARTIKEL
        </a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Informasi Artikel</th>
                    <th class="d-none d-md-table-cell">Penulis</th>
                    <th class="d-none d-md-table-cell text-center">Interaksi</th>
                    <th class="d-none d-md-table-cell text-center">Status</th>
                    <th class="text-end">Opsi Manajemen</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artikels as $artikel)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-4">
                                <div
                                    style="width: 80px; height: 54px; background: rgba(0,0,0,0.5); flex-shrink: 0; border: 1px solid rgba(255,255,255,0.05);">
                                    @if($artikel->gambar_utama)
                                        <img src="{{ asset($artikel->gambar_utama) }}"
                                            style="width:100%;height:100%;object-fit:cover; opacity: 0.8;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100"><i
                                                class="bi bi-image text-white-50"></i></div>
                                    @endif
                                </div>
                                <div class="overflow-hidden">
                                    <div class="fw-bold mb-1" style="font-size: 1rem;">
                                        {{ $artikel->judul }}
                                    </div>
                                    <div class="text-white-50 x-small fw-bold text-uppercase"
                                        style="font-size: 0.65rem; letter-spacing: 0.05em;">
                                        {{ $artikel->created_at->translatedFormat('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="small text-white-50 d-none d-md-table-cell">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-person-circle"></i>
                                {{ optional($artikel->user)->name ?? 'Administrator' }}
                            </div>
                        </td>
                        <td class="text-center d-none d-md-table-cell">
                            <div class="small fw-bold"><i class="bi bi-eye-fill text-accent me-1"></i>
                                {{ number_format($artikel->views) }}</div>
                        </td>
                        <td class="text-center d-none d-md-table-cell">
                            @if($artikel->status == 'published')
                                <span class="admin-badge admin-badge--success">PUBLISHED</span>
                            @else
                                <span class="admin-badge">DRAFT</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard.artikel.edit', $artikel) }}"
                                    class="btn btn-sm btn-outline-light border-0 rounded-0 fw-bold px-3"
                                    style="font-size: 0.7rem; background: rgba(255,255,255,0.05); letter-spacing: 0.1em;">EDIT</a>
                                <form action="{{ route('dashboard.artikel.toggle-status', $artikel) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm border-0 rounded-0 fw-bold px-3"
                                        style="font-size: 0.7rem; background: {{ $artikel->status == 'published' ? 'rgba(255,99,102,0.1)' : 'var(--primary)' }}; color: {{ $artikel->status == 'published' ? '#ff6366' : 'var(--accent)' }}; letter-spacing: 0.1em;">
                                        {{ $artikel->status == 'published' ? 'DRAFT' : 'PUBLISH' }}
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.artikel.destroy', $artikel) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm border-0 rounded-0 fw-bold px-3"
                                        style="font-size: 0.7rem; background: rgba(255, 255, 255, 0.05); color: #ff6366; letter-spacing: 0.1em;">HAPUS</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-white-50 italic">Belum ada artikel yang dipublikasikan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $artikels->links() }}
    </div>
@endsection