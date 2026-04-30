{{-- File: resources/views/dashboard/artikel/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Detail Artikel')
@section('page-title', 'Detail Artikel')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Detail Artikel</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.artikel.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('dashboard.artikel.edit', $artikel) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Konten Utama -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <!-- Header Artikel -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-{{ $artikel->status == 'published' ? 'success' : 'warning' }} fs-6">
                            {{ ucfirst($artikel->status) }}
                        </span>
                        @if($artikel->status == 'published')
                        <a href="{{ route('artikel.show', $artikel->slug) }}" 
                           target="_blank" 
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Lihat di Website
                        </a>
                        @endif
                    </div>
                    
                    <h1 class="display-6 fw-bold mb-3">{{ $artikel->judul }}</h1>
                    
                    <div class="d-flex align-items-center text-muted mb-3">
                        <div class="d-flex align-items-center me-4">
                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white me-2" 
                                 style="width: 32px; height: 32px; font-size: 14px;">
                                {{ strtoupper(substr($artikel->user->name, 0, 1)) }}
                            </div>
                            <span>{{ $artikel->user->name }}</span>
                        </div>
                        <div class="me-4">
                            <i class="bi bi-calendar"></i>
                            {{ $artikel->created_at->format('d F Y') }}
                        </div>
                        <div class="me-4">
                            <i class="bi bi-eye"></i>
                            {{ number_format($artikel->views) }} views
                        </div>
                        <div>
                            <i class="bi bi-clock"></i>
                            {{ $artikel->updated_at->diffForHumans() }}
                        </div>
                    </div>
                    
                    @if($artikel->excerpt)
                    <div class="alert alert-light border-start border-primary border-4">
                        <strong>Ringkasan:</strong> {{ $artikel->excerpt }}
                    </div>
                    @endif
                </div>

                <!-- Gambar Utama -->
                @if($artikel->gambar_utama)
                <div class="mb-4 text-center">
                    <img src="{{ asset($artikel->gambar_utama) }}"
                        alt="{{ $artikel->judul }}"
                        class="img-fluid rounded shadow-sm"
                        style="max-height: 400px; object-fit: cover;">
                </div>
                @endif

                <!-- Konten Artikel -->
                <div class="article-content">
                    {!! nl2br(e($artikel->konten)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
        <!-- Statistik -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-bar-chart"></i> Statistik Artikel
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 border-end">
                        <div class="h4 mb-0 text-primary">{{ number_format($artikel->views) }}</div>
                        <small class="text-muted">Views</small>
                    </div>
                    <div class="col-6">
                        <div class="h4 mb-0 text-success">{{ str_word_count(strip_tags($artikel->konten)) }}</div>
                        <small class="text-muted">Kata</small>
                    </div>
                </div>
                <hr>
                <div class="small">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Slug:</span>
                        <code>{{ $artikel->slug }}</code>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Dibuat:</span>
                        <span>{{ $artikel->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Diupdate:</span>
                        <span>{{ $artikel->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Karakter:</span>
                        <span>{{ number_format(strlen($artikel->konten)) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-lightning"></i> Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('dashboard.artikel.edit', $artikel) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Edit Artikel
                    </a>
                    
                    <form method="POST" action="{{ route('dashboard.artikel.toggle-status', $artikel) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-{{ $artikel->status == 'published' ? 'secondary' : 'success' }} btn-sm w-100">
                            <i class="bi bi-{{ $artikel->status == 'published' ? 'eye-slash' : 'check-circle' }}"></i>
                            {{ $artikel->status == 'published' ? 'Unpublish' : 'Publish' }}
                        </button>
                    </form>
                    
                    @if($artikel->status == 'published')
                    <a href="{{ route('artikel.show', $artikel->slug) }}" 
                       target="_blank" 
                       class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye"></i> Lihat di Website
                    </a>
                    @endif
                    
                    <button type="button" 
                            class="btn btn-outline-danger btn-sm delete-btn" 
                            data-id="{{ $artikel->id }}"
                            data-title="{{ $artikel->judul }}">
                        <i class="bi bi-trash"></i> Hapus Artikel
                    </button>
                </div>
            </div>
        </div>

        <!-- SEO Info -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-search"></i> Info SEO
                </h6>
            </div>
            <div class="card-body">
                <div class="small">
                    <div class="mb-3">
                        <strong>URL:</strong>
                        <div class="text-break">
                            <a href="{{ route('artikel.show', $artikel->slug) }}" target="_blank" class="text-decoration-none">
                                {{ url('artikel/' . $artikel->slug) }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Meta Description:</strong>
                        <div class="text-muted">
                            {{ $artikel->excerpt ?: Str::limit(strip_tags($artikel->konten), 150) }}
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <strong>Panjang Judul:</strong>
                        <span class="badge bg-{{ strlen($artikel->judul) > 60 ? 'danger' : 'success' }}">
                            {{ strlen($artikel->judul) }} karakter
                        </span>
                    </div>
                    
                    <div>
                        <strong>Reading Time:</strong>
                        <span class="badge bg-info">
                            {{ ceil(str_word_count(strip_tags($artikel->konten)) / 200) }} menit
                        </span>
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

<style>
.article-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.article-content p {
    margin-bottom: 1.5rem;
}
</style>
@endpush