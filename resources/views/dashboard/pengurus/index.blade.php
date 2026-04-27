@extends('layouts.dashboard')

@section('title', 'Manajemen Pengurus')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.02em;">DATA PENGURUS</h1>
            <p class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Manajemen Staf UKM Cakra
                Manggala</p>
        </div>
        <a href="{{ route('dashboard.pengurus.create') }}" class="btn btn-accent d-inline-flex align-items-center gap-2">
            <i class="bi bi-person-plus-fill"></i> TAMBAH PENGURUS
        </a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 80px;">Urutan</th>
                    <th>Nama & Jabatan</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penguruses as $p)
                    <tr>
                        <td class="text-center">
                            <span class="fw-black text-accent">{{ $p->urutan }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-sm">
                                    @if($p->foto)
                                        <img src="{{ asset($p->foto) }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        {{ strtoupper(substr($p->nama, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold text-white">{{ $p->nama }}</div>
                                    <div class="x-small text-white-50 fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                                        {{ $p->jabatan }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($p->status == 'active')
                                <span class="admin-badge admin-badge--success">AKTIF</span>
                            @else
                                <span class="admin-badge">NON-AKTIF</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard.pengurus.edit', $p->id) }}"
                                    class="btn btn-sm btn-outline-light border-0 rounded-0 fw-bold px-3"
                                    style="font-size: 0.7rem; background: rgba(255,255,255,0.05); letter-spacing: 0.1em;">EDIT</a>
                                <form action="{{ route('dashboard.pengurus.destroy', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus data pengurus ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm border-0 rounded-0 fw-bold px-3"
                                        style="font-size: 0.7rem; background: rgba(255,99,102,0.1); color: #ff6366; letter-spacing: 0.1em;">HAPUS</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-white-50 italic">Data pengurus belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection