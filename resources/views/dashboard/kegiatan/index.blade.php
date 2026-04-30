{{-- File: resources/views/dashboard/kegiatan/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Jadwal Kegiatan')
@section('page-title', 'Jadwal Kegiatan')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Jadwal Kegiatan</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Jadwal Kegiatan</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('dashboard.kegiatan.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Kegiatan
            </a>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="bi bi-calendar-event"></i>
            </div>
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Kegiatan</div>
        </div>
    </div>
   <!-- <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <i class="bi bi-building"></i>
            </div>
            <div class="stat-number">{{ $stats['internal'] }}</div>
            <div class="stat-label">Kegiatan Internal</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <i class="bi bi-globe"></i>
            </div>
            <div class="stat-number">{{ $stats['eksternal'] }}</div>
            <div class="stat-label">Kegiatan Eksternal</div>
        </div>
    </div>-->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <i class="bi bi-calendar-month"></i>
            </div>
            <div class="stat-number">{{ $stats['bulan_ini'] }}</div>
            <div class="stat-label">Kegiatan Bulan Ini</div>
        </div>
    </div>
</div>

<!-- Filter & Search -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('dashboard.kegiatan.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="search" class="form-label">Cari Kegiatan</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ $search }}" placeholder="Judul atau tempat">
            </div>
            <!--<div class="col-md-2">
                <label for="tahun" class="form-label">Filter Tahun</label>
                <select class="form-select" id="tahun" name="tahun">
                    <option value="">Semua Tahun</option>
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>-->
            <div class="col-md-2">
                <label for="sifat" class="form-label">Filter Sifat</label>
                <select class="form-select" id="sifat" name="sifat">
                    <option value="">Semua Sifat</option>
                    <option value="internal" {{ $sifat == 'internal' ? 'selected' : '' }}>Internal</option>
                    <option value="eksternal" {{ $sifat == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
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
                <a href="{{ route('dashboard.kegiatan.index') }}" class="btn btn-outline-secondary">
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
            <i class="bi bi-table me-2"></i>Daftar Jadwal Kegiatan
            @if($search || $tahun || $sifat)
                <span class="badge bg-info ms-2">
                    {{ $kegiatans->total() }} hasil ditemukan
                </span>
            @endif
        </h5>
    </div>
    <div class="card-body p-0">
        @if($kegiatans->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Judul Kegiatan</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Tempat</th>
                            <th>Kapel/PJ</th>
                            <th>Sifat</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatans as $index => $kegiatan)
                        <tr>
                            <td>{{ ($kegiatans->currentPage() - 1) * $kegiatans->perPage() + $index + 1 }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $kegiatan->tahun }}</span>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ Str::limit($kegiatan->judul_kegiatan, 40) }}</div>
                                @if($kegiatan->materi)
                                    <small class="text-muted">{{ Str::limit($kegiatan->materi, 60) }}</small>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $kegiatan->formatted_date }}</div>
                                <small class="text-muted">{{ $kegiatan->tanggal_pelaksanaan->format('l') }}</small>
                            </td>
                            <td>
                                <i class="bi bi-geo-alt-fill text-muted me-1"></i>
                                {{ Str::limit($kegiatan->tempat, 30) }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-2" 
                                         style="width: 30px; height: 30px; font-size: 12px;">
                                        {{ strtoupper(substr($kegiatan->kapel_pj, 0, 1)) }}
                                    </div>
                                    <span class="small">{{ Str::limit($kegiatan->kapel_pj, 20) }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-{{ $kegiatan->sifat == 'internal' ? 'info' : 'success' }}">
                                    {{ ucfirst($kegiatan->sifat) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $kegiatan->status == 'selesai' ? 'secondary' : 'warning' }}">
                                    {{ $kegiatan->status == 'selesai' ? 'Selesai' : 'Akan Datang' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('dashboard.kegiatan.show', $kegiatan) }}" 
                                       class="btn btn-outline-info btn-sm" 
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('dashboard.kegiatan.edit', $kegiatan) }}" 
                                       class="btn btn-outline-warning btn-sm" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger btn-sm delete-btn" 
                                            title="Hapus"
                                            data-id="{{ $kegiatan->id }}"
                                            data-title="{{ $kegiatan->judul_kegiatan }}">
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
                    Menampilkan {{ $kegiatans->firstItem() }} - {{ $kegiatans->lastItem() }} 
                    dari {{ $kegiatans->total() }} data
                </div>
                {{ $kegiatans->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-event display-1 text-muted"></i>
                <h5 class="mt-3 text-muted">Belum ada kegiatan</h5>
                <p class="text-muted">
                    @if($search || $tahun || $sifat)
                        Tidak ada kegiatan yang sesuai dengan kriteria pencarian.
                    @else
                        Mulai buat jadwal kegiatan pertama Anda!
                    @endif
                </p>
                @if(!$search && !$tahun && !$sifat)
                    <a href="{{ route('dashboard.kegiatan.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Kegiatan
                    </a>
                @endif
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

@push('scripts')
<script>
// Event listener untuk tombol delete
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            confirmDelete(id, title);
        });
    });
});

function confirmDelete(id, title) {
    document.getElementById('deleteTitle').textContent = title;
    document.getElementById('deleteForm').action = `/dashboard/kegiatan/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush