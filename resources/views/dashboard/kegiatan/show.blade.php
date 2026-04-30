{{-- File: resources/views/dashboard/kegiatan/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Detail Kegiatan')
@section('page-title', 'Detail Kegiatan')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Detail Kegiatan</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.kegiatan.index') }}">Jadwal Kegiatan</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('dashboard.kegiatan.edit', $kegiatan) }}" class="btn btn-warning me-2">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('dashboard.kegiatan.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Main Info Card -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar-event me-2"></i>{{ $kegiatan->judul_kegiatan }}
                    </h5>
                    <span class="badge bg-{{ $kegiatan->sifat == 'internal' ? 'info' : 'success' }} fs-6">
                        {{ ucfirst($kegiatan->sifat) }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="bi bi-calendar-date text-primary"></i>
                            </div>
                            <div class="detail-content">
                                <label class="detail-label">Tanggal Pelaksanaan</label>
                                <div class="detail-value">
                                    {{ $kegiatan->tanggal_pelaksanaan->format('l, d F Y') }}
                                    <small class="text-muted d-block">{{ $kegiatan->formatted_date }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="bi bi-calendar3 text-secondary"></i>
                            </div>
                            <div class="detail-content">
                                <label class="detail-label">Tahun</label>
                                <div class="detail-value">{{ $kegiatan->tahun }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                            </div>
                            <div class="detail-content">
                                <label class="detail-label">Tempat</label>
                                <div class="detail-value">{{ $kegiatan->tempat }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="bi bi-person-badge text-success"></i>
                            </div>
                            <div class="detail-content">
                                <label class="detail-label">Ketua Pelaksana / PJ</label>
                                <div class="detail-value">{{ $kegiatan->kapel_pj }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="bi bi-flag text-warning"></i>
                            </div>
                            <div class="detail-content">
                                <label class="detail-label">Status</label>
                                <div class="detail-value">
                                    <span class="badge bg-{{ $kegiatan->status == 'selesai' ? 'secondary' : 'warning' }} fs-6">
                                        {{ $kegiatan->status == 'selesai' ? 'Selesai' : 'Akan Datang' }}
                                    </span>
                                    @if($kegiatan->status == 'akan_datang')
                                        <small class="text-muted d-block mt-1">
                                            {{ $kegiatan->tanggal_pelaksanaan->diffForHumans() }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($kegiatan->materi)
                <div class="border-top pt-4">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="bi bi-journal-text text-info"></i>
                        </div>
                        <div class="detail-content">
                            <label class="detail-label">Materi</label>
                            <div class="detail-value">
                                <div class="bg-light rounded p-3">
                                    {{ $kegiatan->materi }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Aksi Kegiatan</h6>
                        <small class="text-muted">Kelola kegiatan ini</small>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('dashboard.kegiatan.edit', $kegiatan) }}" class="btn btn-outline-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button type="button" class="btn btn-outline-danger delete-btn" 
                                data-id="{{ $kegiatan->id }}"
                                data-title="{{ $kegiatan->judul_kegiatan }}">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>Informasi Sistem
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Dibuat oleh:</small>
                    <div class="d-flex align-items-center mt-1">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-2" 
                             style="width: 35px; height: 35px; font-size: 14px;">
                            {{ strtoupper(substr($kegiatan->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-semibold">{{ $kegiatan->user->name }}</div>
                            <small class="text-muted">{{ ucfirst($kegiatan->user->role) }}</small>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="mb-3">
                    <small class="text-muted">Dibuat pada:</small>
                    <div class="fw-semibold">{{ $kegiatan->created_at->format('d/m/Y H:i') }}</div>
                    <small class="text-muted">{{ $kegiatan->created_at->diffForHumans() }}</small>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Terakhir diperbarui:</small>
                    <div class="fw-semibold">{{ $kegiatan->updated_at->format('d/m/Y H:i') }}</div>
                    <small class="text-muted">{{ $kegiatan->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-graph-up me-2"></i>Statistik Cepat
                </h6>
            </div>
            <div class="card-body">
                @php
                    $totalKegiatanTahun = \App\Models\Kegiatan::where('tahun', $kegiatan->tahun)->count();
                    $kegiatanSamaSifat = \App\Models\Kegiatan::where('sifat', $kegiatan->sifat)->count();
                @endphp
                
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border-end pe-3">
                            <div class="h4 mb-0 text-primary">{{ $totalKegiatanTahun }}</div>
                            <small class="text-muted">Kegiatan {{ $kegiatan->tahun }}</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="ps-3">
                            <div class="h4 mb-0 text-success">{{ $kegiatanSamaSifat }}</div>
                            <small class="text-muted">Kegiatan {{ ucfirst($kegiatan->sifat) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Activities -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-calendar2-event me-2"></i>Kegiatan Terkait
                </h6>
            </div>
            <div class="card-body">
                @php
                    $relatedKegiatans = \App\Models\Kegiatan::where('id', '!=', $kegiatan->id)
                        ->where(function($query) use ($kegiatan) {
                            $query->where('sifat', $kegiatan->sifat)
                                  ->orWhere('tahun', $kegiatan->tahun);
                        })
                        ->latest()
                        ->take(3)
                        ->get();
                @endphp
                
                @forelse($relatedKegiatans as $related)
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-{{ $related->sifat == 'internal' ? 'info' : 'success' }} rounded-circle d-flex align-items-center justify-content-center text-white me-3" 
                         style="width: 35px; height: 35px; font-size: 12px;">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold small">
                            <a href="{{ route('dashboard.kegiatan.show', $related) }}" class="text-decoration-none">
                                {{ Str::limit($related->judul_kegiatan, 30) }}
                            </a>
                        </div>
                        <div class="text-muted" style="font-size: 0.75rem;">
                            {{ $related->formatted_date }} • {{ ucfirst($related->sifat) }}
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted small mb-0">Tidak ada kegiatan terkait.</p>
                @endforelse
                
                @if($relatedKegiatans->count() > 0)
                <div class="text-center mt-3">
                    <a href="{{ route('dashboard.kegiatan.index') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua Kegiatan
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kegiatan <strong id="deleteTitle"></strong>?</p>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.detail-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.detail-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.2rem;
}

.detail-content {
    flex: 1;
}

.detail-label {
    font-size: 0.875rem;
    color: #6c757d;
    margin-bottom: 0.25rem;
    display: block;
    font-weight: 500;
}

.detail-value {
    font-size: 1rem;
    font-weight: 600;
    color: #495057;
}

@media (max-width: 768px) {
    .detail-item {
        flex-direction: column;
        text-align: center;
    }
    
    .detail-icon {
        margin: 0 auto 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Event listener untuk tombol delete
document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.querySelector('.delete-btn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            confirmDelete(id, title);
        });
    }
});

function confirmDelete(id, title) {
    document.getElementById('deleteTitle').textContent = title;
    document.getElementById('deleteForm').action = `/dashboard/kegiatan/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush