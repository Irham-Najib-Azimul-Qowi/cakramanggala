@extends('layouts.dashboard')

@section('title', 'Manajemen Anggota')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.02em;">DATA ANGGOTA</h1>
            <p class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Manajemen Seluruh Anggota UKM Cakra Manggala</p>
        </div>
        <a href="{{ route('dashboard.anggota.create') }}" class="btn btn-accent d-inline-flex align-items-center gap-2">
            <i class="bi bi-person-plus-fill"></i> TAMBAH ANGGOTA
        </a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama & NIA</th>
                    <th>Angkatan</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggotas as $a)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-sm">
                                    @if($a->foto)
                                        <img src="{{ asset($a->foto) }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        {{ strtoupper(substr($a->nama, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold text-white">{{ $a->nama }}</div>
                                    <div class="x-small text-white-50 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.65rem;">
                                        NIA: {{ $a->nia ?? '-' }} | NIM: {{ $a->nim ?? '-' }} | Email: {{ $a->email ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-accent">{{ $a->angkatan }}</span>
                        </td>
                        <td class="text-center">
                            @if($a->status == 'anggota baru')
                                <span class="admin-badge admin-badge--info">ANGGOTA BARU</span>
                            @elseif($a->status == 'anggota')
                                <span class="admin-badge admin-badge--success">ANGGOTA AKTIF</span>
                            @elseif($a->status == 'demisioner')
                                <span class="admin-badge admin-badge--warning">DEMISIONER</span>
                            @else
                                <span class="admin-badge">ALUMNI</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard.anggota.edit', $a->id) }}"
                                    class="btn btn-sm btn-outline-light border-0 rounded-0 fw-bold px-3"
                                    style="font-size: 0.7rem; background: rgba(255,255,255,0.05); letter-spacing: 0.1em;">EDIT</a>
                                <form action="{{ route('dashboard.anggota.destroy', $a->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus data anggota ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm border-0 rounded-0 fw-bold px-3"
                                        style="font-size: 0.7rem; background: rgba(255,99,102,0.1); color: #ff6366; letter-spacing: 0.1em;">HAPUS</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-white-50 italic">Data anggota belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
