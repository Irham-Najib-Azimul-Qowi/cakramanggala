{{-- File: resources/views/dashboard/pendaftar/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Data Pendaftar')
@section('page-title', 'Data Pendaftar')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Data Pendaftar</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Pendaftar</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('dashboard.pendaftar.export', request()->query()) }}" 
               class="btn btn-success">
                <i class="bi bi-download"></i> Export Excel
            </a>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Pendaftar</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <i class="bi bi-gear"></i>
            </div>
            <div class="stat-number">{{ $stats['teknik'] }}</div>
            <div class="stat-label">Fakultas Teknik</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <i class="bi bi-calculator"></i>
            </div>
            <div class="stat-number">{{ $stats['akuntansi'] + $stats['administrasi'] }}</div>
            <div class="stat-label">Fakultas Lainnya</div>
        </div>
    </div>
</div>

<!-- Filter & Search -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('dashboard.pendaftar') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Cari Pendaftar</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ $search }}" placeholder="Nama, NIM, atau Program Studi">
            </div>
            <div class="col-md-3">
                <label for="jurusan" class="form-label">Filter Jurusan</label>
                <select class="form-select" id="jurusan" name="jurusan">
                    <option value="">Semua Jurusan</option>
                    <option value="Teknik" {{ $jurusan == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                    <option value="Akuntansi" {{ $jurusan == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                    <option value="Administrasi Bisnis" {{ $jurusan == 'Administrasi Bisnis' ? 'selected' : '' }}>Administrasi Bisnis</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="per_page" class="form-label">Per Halaman</label>
                <select class="form-select" id="per_page" name="per_page">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search"></i> Cari
                </button>
                <a href="{{ route('dashboard.pendaftar') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="bi bi-table me-2"></i>Daftar Pendaftar
            @if($search || $jurusan)
                <span class="badge bg-info ms-2">
                    {{ $pendaftar->total() }} hasil ditemukan
                </span>
            @endif
        </h5>
    </div>
    <div class="card-body p-0">
        @if($pendaftar->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Lengkap</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Program Studi</th>
                            <th>JK</th>
                            <th>No HP</th>
                            <th>Tanggal Daftar</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftar as $index => $item)
                        <tr>
                            <td>{{ ($pendaftar->currentPage() - 1) * $pendaftar->perPage() + $index + 1 }}</td>
                            <td>
                                @if($item->foto_diri)
                                    <img src="{{ asset($item->foto_diri) }}"
                                        alt="Foto {{ $item->nama_lengkap }}"
                                        class="rounded-circle"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white"
                                        style="width: 40px; height: 40px; font-weight: 600;">
                                        {{ strtoupper(substr($item->nama_lengkap, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item->nama_lengkap }}</div>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $item->nim }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->jurusan == 'Teknik' ? 'info' : ($item->jurusan == 'Akuntansi' ? 'success' : 'warning') }}">
                                    {{ $item->jurusan }}
                                </span>
                            </td>
                            <td>{{ $item->program_studi }}</td>
                            <td>
                                <i class="bi bi-{{ $item->jenis_kelamin == 'Laki-laki' ? 'person' : 'person-dress' }} text-{{ $item->jenis_kelamin == 'Laki-laki' ? 'primary' : 'danger' }}"></i>
                            </td>
                            <td>
                                <a href="tel:{{ $item->no_hp }}" class="text-decoration-none">
                                    {{ $item->no_hp }}
                                </a>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('dashboard.pendaftar.show', $item->id) }}" 
                                       class="btn btn-outline-info btn-sm" 
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger btn-sm delete-btn" 
                                            title="Hapus"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->nama_lengkap }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted">
                    Menampilkan {{ $pendaftar->firstItem() }} - {{ $pendaftar->lastItem() }} 
                    dari {{ $pendaftar->total() }} data
                </div>
                {{ $pendaftar->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <h5 class="mt-3 text-muted">Tidak ada data pendaftar</h5>
                <p class="text-muted">
                    @if($search || $jurusan)
                        Tidak ada data yang sesuai dengan kriteria pencarian.
                    @else
                        Belum ada pendaftar yang terdaftar.
                    @endif
                </p>
            </div>
        @endif
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
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            confirmDelete(id, name);
        });
    });
});

function confirmDelete(id, name) {
    document.getElementById('deleteName').textContent = name;
    document.getElementById('deleteForm').action = `/dashboard/pendaftar/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush