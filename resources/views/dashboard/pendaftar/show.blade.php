@extends('layouts.dashboard')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <a href="{{ route('dashboard.pendaftar') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
    <div class="d-flex gap-2">
        @if(!$pendaftar->is_approved)
        <form action="{{ route('dashboard.pendaftar.approve', $pendaftar->id) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit" class="btn btn-success btn-sm px-4 rounded-pill fw-bold">
                <i class="bi bi-check-lg me-1"></i> Approve
            </button>
        </form>
        @endif
        
        @if($pendaftar->status != 'rejected')
        <form action="{{ route('dashboard.pendaftar.reject', $pendaftar->id) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit" class="btn btn-outline-danger btn-sm px-4 rounded-pill fw-bold">
                <i class="bi bi-x-lg me-1"></i> Reject
            </button>
        </form>
        @endif

        <button type="button" class="btn btn-light btn-sm px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>

<div class="row g-4">
    {{-- Profil Utama --}}
    <div class="col-lg-4">
        <div class="card card-premium border-0 p-4 sticky-top" style="top: 100px;">
            <div class="text-center mb-4">
                <div class="detail-avatar mb-3">
                    @if($pendaftar->foto_diri)
                        <img src="{{ asset($pendaftar->foto_diri) }}" alt="{{ $pendaftar->nama_lengkap }}">
                    @else
                        {{ strtoupper(substr($pendaftar->nama_lengkap, 0, 1)) }}
                    @endif
                </div>
                <h4 class="fw-bold mb-1">{{ $pendaftar->nama_lengkap }}</h4>
                <div class="text-muted small mb-3">{{ $pendaftar->nim }}</div>
                
                <div class="badge {{ $pendaftar->is_approved ? 'bg-success' : ($pendaftar->status == 'rejected' ? 'bg-danger' : 'bg-warning') }} py-2 px-3 rounded-pill">
                    {{ strtoupper($pendaftar->status) }}
                </div>
            </div>

            <hr class="opacity-10">

            <div class="info-list">
                <div class="info-item mb-3">
                    <label class="text-muted smaller fw-bold text-uppercase">Program Studi</label>
                    <div class="fw-bold" style="color: var(--primary)">{{ $pendaftar->program_studi }}</div>
                </div>
                <div class="info-item mb-3">
                    <label class="text-muted smaller fw-bold text-uppercase">Jurusan</label>
                    <div class="fw-bold">{{ $pendaftar->jurusan }}</div>
                </div>
                <div class="info-item">
                    <label class="text-muted smaller fw-bold text-uppercase">No. HP / WhatsApp</label>
                    <div class="fw-bold">
                        <a href="https://wa.me/{{ $pendaftar->no_hp }}" target="_blank" class="text-decoration-none text-dark">
                            <i class="bi bi-whatsapp text-success me-1"></i> {{ $pendaftar->no_hp }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Informasi --}}
    <div class="col-lg-8">
        <div class="card card-premium border-0 p-4 mb-4">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Informasi Pribadi</h5>
            <div class="row g-4">
                <div class="col-sm-6">
                    <label class="text-muted smaller fw-bold text-uppercase d-block mb-1">Tempat, Tanggal Lahir</label>
                    <div class="fw-medium">{{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d F Y') }}</div>
                </div>
                <div class="col-sm-6">
                    <label class="text-muted smaller fw-bold text-uppercase d-block mb-1">Jenis Kelamin</label>
                    <div class="fw-medium">{{ $pendaftar->jenis_kelamin }}</div>
                </div>
                <div class="col-12">
                    <label class="text-muted smaller fw-bold text-uppercase d-block mb-1">Alamat Domisili</label>
                    <div class="fw-medium">{{ $pendaftar->alamat }}</div>
                </div>
            </div>
        </div>

        <div class="card card-premium border-0 p-4 mb-4">
            <h5 class="fw-bold mb-4 border-bottom pb-2">Latar Belakang & Motivasi</h5>
            <div class="mb-4">
                <label class="text-muted smaller fw-bold text-uppercase d-block mb-2">Pengalaman Organisasi</label>
                <div class="p-3 bg-light rounded-4 fw-medium text-secondary">
                    {{ $pendaftar->organisasi_yang_pernah_diikuti ?: 'Tidak ada pengalaman organisasi sebelumnya.' }}
                </div>
            </div>
            <div>
                <label class="text-muted smaller fw-bold text-uppercase d-block mb-2">Alasan Bergabung</label>
                <div class="p-3 bg-light rounded-4 fw-medium text-secondary" style="line-height: 1.6;">
                    {{ $pendaftar->alasan_bergabung }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-5 text-center">
                <i class="bi bi-exclamation-octagon text-danger display-1 mb-4"></i>
                <h3 class="fw-bold">Hapus Data?</h3>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan. Seluruh data <strong>{{ $pendaftar->nama_lengkap }}</strong> akan dihapus permanen.</p>
                <div class="d-flex gap-2 mt-5">
                    <button type="button" class="btn btn-light flex-grow-1 py-3 rounded-pill fw-bold" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('dashboard.pendaftar.destroy', $pendaftar->id) }}" method="POST" class="flex-grow-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 py-3 rounded-pill fw-bold">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .detail-avatar {
        width: 140px;
        height: 140px;
        border-radius: 30px;
        background: #f0f4f2;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--primary);
        overflow: hidden;
        border: 5px solid white;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .detail-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .smaller { font-size: 0.7rem; }
</style>
@endsection