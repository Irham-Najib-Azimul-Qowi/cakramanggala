@extends('layouts.dashboard')

@section('title', 'Detail Kegiatan')

@section('content')
    <div class="mb-5 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <a href="{{ route('dashboard.kegiatan.index') }}"
            class="btn btn-sm d-inline-flex align-items-center gap-2 border-0 rounded-0"
            style="background: rgba(255,255,255,0.05); color: #fff; font-weight: 800; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.8rem 1.5rem;">
            <i class="bi bi-arrow-left"></i> KEMBALI
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard.kegiatan.edit', $kegiatan) }}"
                class="btn btn-accent d-inline-flex align-items-center gap-2">
                <i class="bi bi-pencil-square"></i> EDIT
            </a>
            <button type="button" class="btn btn-sm px-4 fw-black border-0 rounded-0 delete-btn"
                style="background: rgba(255,99,102,0.1); color: #ff6366; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase;"
                data-id="{{ $kegiatan->id }}" data-title="{{ $kegiatan->judul_kegiatan }}">
                <i class="bi bi-trash3-fill"></i> HAPUS
            </button>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card p-0 overflow-hidden border-0 shadow-lg">
                <div class="p-4 p-lg-5"
                    style="background: var(--primary); color: #fff; position: relative; overflow: hidden;">
                    <div class="d-flex justify-content-between align-items-start position-relative" style="z-index: 2;">
                        <div>
                            <p class="mb-2 text-accent x-small fw-black text-uppercase"
                                style="letter-spacing: 0.2em; font-size: 0.65rem;">IKHTISAR KEGIATAN</p>
                            <h1 class="h3 fw-black mb-0" style="letter-spacing: -0.01em;">
                                {{ strtoupper($kegiatan->judul_kegiatan) }}</h1>
                        </div>
                        <span
                            class="admin-badge admin-badge--success py-2 px-4 shadow-sm border-0">{{ strtoupper($kegiatan->sifat) }}</span>
                    </div>
                    <i class="bi bi-calendar3"
                        style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); z-index: 1;"></i>
                </div>

                <div class="p-4 p-lg-5">
                    <div class="row g-5">
                        <div class="col-sm-6">
                            <label class="x-small fw-black text-accent text-uppercase mb-2 d-inline-block"
                                style="letter-spacing: 0.15em; font-size: 0.65rem; border-bottom: 1px solid rgba(242,182,97,0.2);">WAKTU
                                PELAKSANAAN</label>
                            <div class="h5 fw-black text-white mb-1">
                                {{ $kegiatan->tanggal_pelaksanaan->translatedFormat('l, d F Y') }}</div>
                            <small class="text-white-50 fw-bold">TAHUN ANGGARAN {{ $kegiatan->tahun }}</small>
                        </div>
                        <div class="col-sm-6">
                            <label class="x-small fw-black text-accent text-uppercase mb-2 d-inline-block"
                                style="letter-spacing: 0.15em; font-size: 0.65rem; border-bottom: 1px solid rgba(242,182,97,0.2);">LOKASI
                                / TEMPAT</label>
                            <div class="h5 fw-black text-white mb-1">{{ strtoupper($kegiatan->tempat) }}</div>
                            <small class="text-white-50 fw-bold">PENANGGUNG JAWAB:
                                {{ strtoupper($kegiatan->kapel_pj) }}</small>
                        </div>
                    </div>

                    @if($kegiatan->deskripsi)
                        <div class="mt-5 pt-5" style="border-top: 1px solid rgba(255,255,255,0.05);">
                            <label class="x-small fw-black text-accent text-uppercase mb-3 d-block"
                                style="letter-spacing: 0.15em; font-size: 0.65rem;">DESKRIPSI LENGKAP KEGIATAN</label>
                            <div class="p-4 bg-dark border border-white-5 text-white-50 lh-lg" style="white-space: pre-line;">
                                {!! nl2br(e($kegiatan->deskripsi)) !!}</div>
                        </div>
                    @endif

                    @if($kegiatan->materi)
                        <div class="mt-5 pt-5" style="border-top: 1px solid rgba(255,255,255,0.05);">
                            <label class="x-small fw-black text-accent text-uppercase mb-3 d-block"
                                style="letter-spacing: 0.15em; font-size: 0.65rem;">CATATAN MATERI / AGENDA</label>
                            <div class="p-4 bg-dark border border-white-5 text-white-50 lh-lg" style="white-space: pre-line;">
                                {{ $kegiatan->materi }}</div>
                        </div>
                    @endif

                    @if(is_array($kegiatan->dokumentasi) && count($kegiatan->dokumentasi) > 0)
                        <div class="mt-5 pt-5" style="border-top: 1px solid rgba(255,255,255,0.05);">
                            <label class="x-small fw-black text-accent text-uppercase mb-3 d-block"
                                style="letter-spacing: 0.15em; font-size: 0.65rem;">GALERI DOKUMENTASI</label>
                            <div class="row g-3">
                                @foreach($kegiatan->dokumentasi as $img)
                                    <div class="col-md-4 col-6">
                                        <div class="position-relative overflow-hidden" style="aspect-ratio: 1/1; border: 1px solid rgba(255,255,255,0.05);">
                                            <img src="{{ asset($img) }}" class="w-100 h-100 object-fit-cover">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-4" style="background: var(--primary) !important; border: none; padding: 2.5rem;">
                <h6 class="fw-black text-accent text-uppercase mb-4"
                    style="font-size: 0.75rem; letter-spacing: 0.15em; border-bottom: 1px solid rgba(242,182,97,0.1); padding-bottom: 1rem;">
                    LOG SISTEM</h6>
                <div class="small">
                    <div class="d-flex align-items-center gap-3 mb-4 pb-4"
                        style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <div class="avatar-sm" style="width: 44px; height: 44px; font-size: 1rem;">
                            {{ strtoupper(substr($kegiatan->user->name, 0, 1)) }}</div>
                        <div>
                            <div class="fw-black text-white" style="font-size: 0.85rem;">
                                {{ strtoupper($kegiatan->user->name) }}</div>
                            <div class="x-small fw-bold text-accent" style="font-size: 0.6rem; letter-spacing: 0.05em;">
                                ADMINISTRATOR</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="x-small fw-bold text-white-50">DIBUAT PADA</span>
                        <span
                            class="small fw-black text-white">{{ $kegiatan->created_at->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="x-small fw-bold text-white-50">PERUBAHAN TERAKHIR</span>
                        <span class="small fw-black text-white">{{ $kegiatan->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            @php
                $totalKegiatanTahun = \App\Models\Kegiatan::where('tahun', $kegiatan->tahun)->count();
                $kegiatanSamaSifat = \App\Models\Kegiatan::where('sifat', $kegiatan->sifat)->count();
            @endphp
            <div class="admin-card" style="background: rgba(255,255,255,0.02); border-color: rgba(255,255,255,0.05);">
                <h6 class="fw-black text-white text-uppercase mb-4 text-center"
                    style="font-size: 0.75rem; letter-spacing: 0.15em;">STATISTIK TERKAIT</h6>
                <div class="row text-center g-4">
                    <div class="col-6">
                        <div class="fw-black text-accent mb-1" style="font-size: 2rem;">{{ $totalKegiatanTahun }}</div>
                        <div class="x-small fw-bold text-white-50 text-uppercase"
                            style="letter-spacing: 0.1em; font-size: 0.6rem;">TAHUN {{ $kegiatan->tahun }}</div>
                    </div>
                    <div class="col-6">
                        <div class="fw-black text-white mb-1" style="font-size: 2rem;">{{ $kegiatanSamaSifat }}</div>
                        <div class="x-small fw-bold text-white-50 text-uppercase"
                            style="letter-spacing: 0.1em; font-size: 0.6rem;">{{ strtoupper($kegiatan->sifat) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg bg-dark-card rounded-0">
                <div class="modal-body text-center p-5">
                    <div class="mb-4 text-danger"><i class="bi bi-trash3-fill display-3"></i></div>
                    <h3 class="fw-black text-white">HAPUS AGENDA?</h3>
                    <p class="text-white-50 small mb-4 px-2" id="deleteTitle"></p>
                    <div class="d-flex gap-3 mt-5">
                        <button type="button" class="btn flex-grow-1 py-3 fw-bold border-0 rounded-0"
                            style="background: rgba(255,255,255,0.05); color: #fff;" data-bs-dismiss="modal">BATAL</button>
                        <form id="deleteForm" method="POST" class="flex-grow-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 py-3 fw-black rounded-0">KONFIRMASI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteBtn = document.querySelector('.delete-btn');
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title');
                    document.getElementById('deleteTitle').textContent = `Agenda: "${title}"`;
                    document.getElementById('deleteForm').action = `/dashboard/kegiatan/${id}`;
                    new bootstrap.Modal(document.getElementById('deleteModal')).show();
                });
            }
        });
    </script>
@endpush

<style>
    .bg-dark-card {
        background: var(--dark-card) !important;
    }

    .border-white-5 {
        border-color: rgba(255, 255, 255, 0.05) !important;
    }
</style>