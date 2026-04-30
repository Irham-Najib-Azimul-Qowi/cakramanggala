{{-- File: resources/views/dashboard/pendaftar/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Detail Pendaftar')
@section('page-title', 'Detail Pendaftar')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Detail Pendaftar</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.pendaftar') }}">Data Pendaftar</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('dashboard.pendaftar') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Profile Card -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                @if($pendaftar->foto_diri)
                    <img src="{{ asset($pendaftar->foto_diri) }}"
                        alt="Foto {{ $pendaftar->nama_lengkap }}"
                        class="rounded-circle mb-3 shadow-sm"
                        style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #e9ecef;">
                @else
                    <div class="bg-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white shadow-sm"
                        style="width: 150px; height: 150px; font-size: 3rem; font-weight: 600; border: 3px solid #e9ecef;">
                        {{ strtoupper(substr($pendaftar->nama_lengkap, 0, 1)) }}
                    </div>
                @endif
                
                <h4 class="card-title">{{ $pendaftar->nama_lengkap }}</h4>
                <p class="text-muted">{{ $pendaftar->nim }}</p>
                
                <div class="row text-center mt-4">
                    <div class="col">
                        <div class="border-end">
                            <h6 class="fw-bold text-primary">{{ $pendaftar->jurusan }}</h6>
                            <small class="text-muted">Jurusan</small>
                        </div>
                    </div>
                    <div class="col">
                        <h6 class="fw-bold text-success">{{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->age }} Tahun</h6>
                        <small class="text-muted">Usia</small>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="tel:{{ $pendaftar->no_hp }}" class="btn btn-primary btn-sm me-2">
                        <i class="bi bi-telephone"></i> Hubungi
                    </a>
                    <button type="button" 
                            class="btn btn-outline-danger btn-sm delete-btn" 
                            data-id="{{ $pendaftar->id }}"
                            data-name="{{ $pendaftar->nama_lengkap }}">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Detail Information -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-lines-fill me-2"></i>Informasi Lengkap
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Personal Information -->
                    <div class="col-md-6 mb-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="bi bi-person me-2"></i>Data Pribadi
                        </h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Nama Lengkap</label>
                            <div class="border-bottom pb-1">{{ $pendaftar->nama_lengkap }}</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Jenis Kelamin</label>
                            <div class="border-bottom pb-1">
                                <i class="bi bi-{{ $pendaftar->jenis_kelamin == 'Laki-laki' ? 'person' : 'person-dress' }} me-2"></i>
                                {{ $pendaftar->jenis_kelamin }}
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Tempat, Tanggal Lahir</label>
                            <div class="border-bottom pb-1">
                                {{ $pendaftar->tempat_lahir }}, 
                                {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d F Y') }}
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">No. HP</label>
                            <div class="border-bottom pb-1">
                                <a href="tel:{{ $pendaftar->no_hp }}" class="text-decoration-none">
                                    {{ $pendaftar->no_hp }}
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Academic Information -->
                    <div class="col-md-6 mb-4">
                        <h6 class="text-success fw-bold mb-3">
                            <i class="bi bi-mortarboard me-2"></i>Data Akademik
                        </h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">NIM</label>
                            <div class="border-bottom pb-1">
                                <span class="badge bg-primary">{{ $pendaftar->nim }}</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Jurusan</label>
                            <div class="border-bottom pb-1">
                                <span class="badge bg-{{ $pendaftar->jurusan == 'Teknik' ? 'info' : ($pendaftar->jurusan == 'Akuntansi' ? 'success' : 'warning') }}">
                                    {{ $pendaftar->jurusan }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Program Studi</label>
                            <div class="border-bottom pb-1">{{ $pendaftar->program_studi }}</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Tanggal Pendaftaran</label>
                            <div class="border-bottom pb-1">
                                <i class="bi bi-calendar me-2"></i>
                                {{ \Carbon\Carbon::parse($pendaftar->created_at)->format('d F Y, H:i') }} WIB
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Address -->
                <div class="mb-4">
                    <h6 class="text-warning fw-bold mb-3">
                        <i class="bi bi-geo-alt me-2"></i>Alamat
                    </h6>
                    <div class="bg-light p-3 rounded">
                        {{ $pendaftar->alamat }}
                    </div>
                </div>
                
                <!-- Previous Organizations -->
                @if($pendaftar->organisasi_yang_pernah_diikuti)
                <div class="mb-4">
                    <h6 class="text-info fw-bold mb-3">
                        <i class="bi bi-people me-2"></i>Organisasi yang Pernah Diikuti
                    </h6>
                    <div class="bg-light p-3 rounded">
                        {{ $pendaftar->organisasi_yang_pernah_diikuti }}
                    </div>
                </div>
                @endif
                
                <!-- Reason to Join -->
                <div class="mb-4">
                    <h6 class="text-danger fw-bold mb-3">
                        <i class="bi bi-heart me-2"></i>Alasan Bergabung
                    </h6>
                    <div class="bg-light p-3 rounded">
                        {{ $pendaftar->alasan_bergabung }}
                    </div>
                </div>
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
                <p>Apakah Anda yakin ingin menghapus data pendaftar <strong id="deleteName"></strong>?</p>
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

@push('scripts')
<script>
// Event listener untuk tombol delete
document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.querySelector('.delete-btn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            confirmDelete(id, name);
        });
    }
});

function confirmDelete(id, name) {
    document.getElementById('deleteName').textContent = name;
    document.getElementById('deleteForm').action = `/dashboard/pendaftar/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush