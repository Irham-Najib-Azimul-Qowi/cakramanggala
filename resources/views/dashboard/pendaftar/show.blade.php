@extends('layouts.dashboard')

@section('title', 'Detail Pendaftar')

@section('content')
    <div class="mb-5 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <a href="{{ route('dashboard.pendaftar') }}"
            class="btn btn-sm d-inline-flex align-items-center gap-2 border-0 rounded-0"
            style="background: rgba(255,255,255,0.05); color: #fff; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.8rem 1.5rem;">
            <i class="bi bi-arrow-left"></i> KEMBALI
        </a>
        <div class="d-flex gap-2">
            @if($pendaftar->status != 'Diterima')
                <form action="{{ route('dashboard.pendaftar.approve', $pendaftar->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-accent px-4 fw-black d-inline-flex align-items-center" style="height: 45px; font-size: 0.75rem;">
                        <i class="bi bi-shield-check me-2"></i> APPROVE
                    </button>
                </form>
            @endif

            @if($pendaftar->status != 'Tidak diterima')
                <form action="{{ route('dashboard.pendaftar.reject', $pendaftar->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn px-4 fw-black border-0 rounded-0 d-inline-flex align-items-center"
                        style="background: rgba(255,99,102,0.1); color: #ff6366; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; height: 45px;">
                        <i class="bi bi-shield-x me-2"></i> REJECT
                    </button>
                </form>
            @endif

            <button type="button" class="btn px-3 border-0 rounded-0 d-inline-flex align-items-center justify-content-center"
                style="background: rgba(255,255,255,0.05); color: #fff; height: 45px;" data-bs-toggle="modal"
                data-bs-target="#deleteModal">
                <i class="bi bi-trash3-fill text-danger"></i>
            </button>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="admin-card text-center sticky-top"
                style="top: 120px; background: var(--primary) !important; border: none;">
                <div class="detail-avatar mb-4 mx-auto overflow-hidden">
                    @if($pendaftar->foto_diri && file_exists(public_path($pendaftar->foto_diri)))
                        <img src="{{ asset($pendaftar->foto_diri) }}" alt="{{ $pendaftar->nama_lengkap }}" class="w-100 h-100 object-fit-cover">
                    @else
                        <div class="h-100 w-100 d-flex align-items-center justify-content-center bg-dark text-accent fw-black">
                            {{ strtoupper(substr($pendaftar->nama_lengkap, 0, 1)) }}</div>
                    @endif
                </div>
                <h2 class="h4 fw-black text-white mb-1" style="letter-spacing: -0.02em;">
                    {{ strtoupper($pendaftar->nama_lengkap) }}</h2>
                <p class="text-accent x-small fw-bold mb-4" style="letter-spacing: 0.15em;">{{ $pendaftar->nim }}</p>

                <div class="mb-4">
                    @if($pendaftar->status == 'Diterima')
                        <span class="admin-badge admin-badge--success py-2 px-4 w-100 justify-content-center">DITERIMA / APPROVED</span>
                    @elseif($pendaftar->status == 'Tidak diterima')
                        <span class="admin-badge admin-badge--danger py-2 px-4 w-100 justify-content-center">DITOLAK / REJECTED</span>
                    @else
                        <span class="admin-badge admin-badge--warning py-2 px-4 w-100 justify-content-center">BELUM DIPROSES</span>
                    @endif
                </div>

                <div class="text-start pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <div class="mb-4">
                        <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-1"
                            style="letter-spacing: 0.1em; font-size: 0.65rem;">Program Studi</label>
                        <div class="fw-bold small">{{ $pendaftar->program_studi }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-1"
                            style="letter-spacing: 0.1em; font-size: 0.65rem;">WhatsApp</label>
                        <a href="https://wa.me/{{ $pendaftar->no_hp }}" target="_blank"
                            class="text-accent text-decoration-none fw-black small">
                            <i class="bi bi-whatsapp me-2"></i> {{ $pendaftar->no_hp }}
                        </a>
                    </div>
                    <div>
                        <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-1"
                            style="letter-spacing: 0.1em; font-size: 0.65rem;">Terdaftar Pada</label>
                        <div class="fw-bold small text-white">{{ $pendaftar->created_at->translatedFormat('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <h2 class="h6 fw-black text-accent text-uppercase mb-4"
                    style="letter-spacing: 0.15em; border-bottom: 1px solid rgba(242,182,97,0.1); padding-bottom: 1rem;">
                    IDENTITAS MAHASISWA</h2>
                <div class="row g-4">
                    <div class="col-sm-6">
                        <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-2"
                            style="letter-spacing: 0.1em; font-size: 0.65rem;">Tempat, Tanggal Lahir</label>
                        <div class="fw-bold text-white">{{ $pendaftar->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div class="col-sm-6">
                        <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-2"
                            style="letter-spacing: 0.1em; font-size: 0.65rem;">Jenis Kelamin</label>
                        <div class="fw-bold text-white">{{ strtoupper($pendaftar->jenis_kelamin) }}</div>
                    </div>
                    <div class="col-12">
                        <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-2"
                            style="letter-spacing: 0.1em; font-size: 0.65rem;">Alamat Domisili</label>
                        <div class="fw-bold text-white lh-base">{{ strtoupper($pendaftar->alamat) }}</div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <h2 class="h6 fw-black text-accent text-uppercase mb-4"
                    style="letter-spacing: 0.15em; border-bottom: 1px solid rgba(242,182,97,0.1); padding-bottom: 1rem;">
                    LATAR BELAKANG & MOTIVASI</h2>
                <div class="mb-5">
                    <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-3"
                        style="letter-spacing: 0.1em; font-size: 0.65rem;">Pengalaman Organisasi</label>
                    <div class="p-4 bg-dark border border-white-5 small lh-lg italic text-white-50">
                        {{ $pendaftar->organisasi_yang_pernah_diikuti ?: 'TIDAK ADA PENGALAMAN ORGANISASI SEBELUMNYA.' }}
                    </div>
                </div>
                <div>
                    <label class="x-small fw-bold text-white-50 text-uppercase d-block mb-3"
                        style="letter-spacing: 0.1em; font-size: 0.65rem;">Alasan Bergabung</label>
                    <div class="p-4 bg-dark border border-white-5 small lh-lg text-white">
                        "{{ $pendaftar->alasan_bergabung }}"
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg bg-dark-card rounded-0">
                <div class="modal-body p-5 text-center">
                    <div class="mb-4 text-danger"><i class="bi bi-exclamation-square-fill display-3"></i></div>
                    <h3 class="fw-black text-white px-2">HAPUS DATA PENDAFTAR?</h3>
                    <p class="text-white-50 small mb-5">Tindakan ini tidak dapat dibatalkan. Data
                        <strong>{{ $pendaftar->nama_lengkap }}</strong> akan dihapus secara permanen dari basis data.</p>
                    <div class="d-flex gap-3">
                        <button type="button" class="btn flex-grow-1 py-3 fw-black border-0 rounded-0"
                            style="background: rgba(255,255,255,0.05); color: #fff;" data-bs-dismiss="modal">BATAL</button>
                        <form action="{{ route('dashboard.pendaftar.destroy', $pendaftar->id) }}" method="POST"
                            class="flex-grow-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger w-100 py-3 fw-black rounded-0 shadow-none">KONFIRMASI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .detail-avatar {
            width: 160px;
            height: 160px;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            font-weight: 900;
            color: var(--accent);
            overflow: hidden;
            border: 5px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        }

        .detail-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .bg-dark-card {
            background: var(--dark-card);
        }

        .border-white-5 {
            border-color: rgba(255, 255, 255, 0.05) !important;
        }
    </style>
@endsection