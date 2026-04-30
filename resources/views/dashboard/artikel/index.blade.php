{{-- File: resources/views/dashboard/artikel/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Artikel & Berita')
@section('page-title', 'Artikel & Berita')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Artikel & Berita</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Artikel & Berita</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('dashboard.artikel.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Buat Artikel
            </a>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="bi bi-newspaper"></i>
            </div>
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Artikel</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-number">{{ $stats['published'] }}</div>
            <div class="stat-label">Dipublikasikan</div>
        </div>
    </div>
    <!--<div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="stat-number">{{ $stats['draft'] }}</div>
            <div class="stat-label">Draft</div>
        </div>
    </div>-->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-number">{{ number_format($stats['total_views']) }}</div>
            <div class="stat-label">Total Views</div>
        </div>
    </div>
</div>

<!-- Filter & Search -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('dashboard.artikel.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Cari Artikel</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ $search }}" placeholder="Judul atau konten artikel">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Filter Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">Semua Status</option>
                    <option value="published" {{ $status == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                    <option value="draft" {{ $status == 'draft' ? 'selected' : '' }}>Draft</option>
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
                <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-outline-secondary">
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
            <i class="bi bi-table me-2"></i>Daftar Artikel
            @if($search || $status)
                <span class="badge bg-info ms-2">
                    {{ $artikels->total() }} hasil ditemukan
                </span>
            @endif
        </h5>
    </div>
    <div class="card-body p-0">
        @if($artikels->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Tanggal</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($artikels as $index => $artikel)
                        <tr>
                            <td>{{ ($artikels->currentPage() - 1) * $artikels->perPage() + $index + 1 }}</td>
                            <td>
                                {{-- UPDATED: Menggunakan asset() untuk path yang benar --}}
                                @if($artikel->gambar_utama)
                                    <img src="{{ asset($artikel->gambar_utama) }}" 
                                         alt="{{ $artikel->judul }}" 
                                         class="rounded" 
                                         style="width: 60px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 40px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ Str::limit($artikel->judul, 50) }}</div>
                                <small class="text-muted">{{ Str::limit($artikel->excerpt, 80) }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white me-2" 
                                         style="width: 30px; height: 30px; font-size: 12px;">
                                        {{ strtoupper(substr($artikel->user->name, 0, 1)) }}
                                    </div>
                                    <span class="small">{{ $artikel->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-{{ $artikel->status == 'published' ? 'success' : 'warning' }}">
                                    {{ ucfirst($artikel->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ number_format($artikel->views) }}</span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $artikel->created_at->format('d/m/Y H:i') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('dashboard.artikel.show', $artikel) }}" 
                                       class="btn btn-outline-info btn-sm" 
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('dashboard.artikel.edit', $artikel) }}" 
                                       class="btn btn-outline-warning btn-sm" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('dashboard.artikel.toggle-status', $artikel) }}" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-outline-{{ $artikel->status == 'published' ? 'secondary' : 'success' }} btn-sm" 
                                                title="{{ $artikel->status == 'published' ? 'Unpublish' : 'Publish' }}">
                                            <i class="bi bi-{{ $artikel->status == 'published' ? 'eye-slash' : 'check-circle' }}"></i>
                                        </button>
                                    </form>
                                    <button type="button" 
                                            class="btn btn-outline-danger btn-sm delete-btn" 
                                            title="Hapus"
                                            data-id="{{ $artikel->id }}"
                                            data-title="{{ $artikel->judul }}">
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
                    Menampilkan {{ $artikels->firstItem() }} - {{ $artikels->lastItem() }} 
                    dari {{ $artikels->total() }} data
                </div>
                {{ $artikels->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-newspaper display-1 text-muted"></i>
                <h5 class="mt-3 text-muted">Belum ada artikel</h5>
                <p class="text-muted">
                    @if($search || $status)
                        Tidak ada artikel yang sesuai dengan kriteria pencarian.
                    @else
                        Mulai buat artikel pertama Anda!
                    @endif
                </p>
                @if(!$search && !$status)
                    <a href="{{ route('dashboard.artikel.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Buat Artikel
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
                <p>Apakah Anda yakin ingin menghapus artikel <strong id="deleteTitle"></strong>?</p>
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
    document.getElementById('deleteForm').action = `/dashboard/artikel/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush