{{-- File: resources/views/artikel/show.blade.php --}}
@extends('layouts.app')

@section('title', $artikel->judul)
@section('meta_description', $artikel->excerpt ?: Str::limit(strip_tags($artikel->konten), 160))

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Konten Utama -->
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($artikel->judul, 50) }}</li>
                </ol>
            </nav>

            <!-- Artikel -->
            <article class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <!-- Header Artikel -->
                    <header class="mb-4">
                        <h1 class="display-5 fw-bold mb-3">{{ $artikel->judul }}</h1>
                        
                        <div class="d-flex flex-wrap align-items-center text-muted mb-4">
                            <div class="d-flex align-items-center me-4 mb-2">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-2" 
                                     style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ strtoupper(substr($artikel->user->name, 0, 1)) }}
                                </div>
                                <span>{{ $artikel->user->name }}</span>
                            </div>
                            <div class="me-4 mb-2">
                                <i class="bi bi-calendar"></i>
                                {{ $artikel->created_at->format('d F Y') }}
                            </div>
                            <div class="me-4 mb-2">
                                <i class="bi bi-eye"></i>
                                {{ number_format($artikel->views) }} views
                            </div>
                            <div class="mb-2">
                                <i class="bi bi-clock"></i>
                                {{ ceil(str_word_count(strip_tags($artikel->konten)) / 200) }} menit baca
                            </div>
                        </div>

                        @if($artikel->excerpt)
                        <div class="alert alert-primary border-0 bg-primary bg-opacity-10">
                            <strong>Ringkasan:</strong> {{ $artikel->excerpt }}
                        </div>
                        @endif
                    </header>

                    <!-- Gambar Utama -->
                    @if($artikel->gambar_utama)
                    <figure class="mb-4 text-center">
                        <img src="{{ asset($artikel->gambar_utama) }}" 
                             alt="{{ $artikel->judul }}" 
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 500px; object-fit: cover; width: 100%;">
                        <figcaption class="mt-2 text-muted small">{{ $artikel->judul }}</figcaption>
                    </figure>
                    @endif

                    <!-- Konten Artikel -->
                    <div class="article-content">
                        {!! nl2br(e($artikel->konten)) !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="mb-3">Bagikan Artikel:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                               target="_blank" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($artikel->judul) }}" 
                               target="_blank" 
                               class="btn btn-outline-info btn-sm">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' - ' . request()->fullUrl()) }}" 
                               target="_blank" 
                               class="btn btn-outline-success btn-sm">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                            <button type="button" 
                                    class="btn btn-outline-secondary btn-sm" 
                                    onclick="copyToClipboard('{{ request()->fullUrl() }}')">
                                <i class="bi bi-link-45deg"></i> Salin Link
                            </button>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Artikel Terkait -->
            @if($relatedArtikels->count() > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">
                        <i class="bi bi-newspaper"></i> Artikel Terkait
                    </h6>
                </div>
                <div class="card-body p-0">
                    @foreach($relatedArtikels as $related)
                    <div class="p-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="row g-3">
                            <div class="col-4">
                                @if($related->gambar_utama)
                                    <img src="{{ asset('storage/' . $related->gambar_utama) }}" 
                                         alt="{{ $related->judul }}" 
                                         class="img-fluid rounded"
                                         style="height: 60px; object-fit: cover; width: 100%;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="height: 60px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-8">
                                <h6 class="mb-1">
                                    <a href="{{ route('artikel.show', $related->slug) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ Str::limit($related->judul, 60) }}
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    <i class="bi bi-calendar"></i> {{ $related->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('artikel.index') }}" class="btn btn-outline-primary btn-sm">
                        Lihat Semua Artikel <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endif

            <!-- Kembali ke Daftar -->
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title">Jelajahi Artikel Lainnya</h6>
                    <p class="card-text small text-muted">
                        Temukan artikel dan berita menarik lainnya dari UKM Pecinta Alam Cakra Manggala
                    </p>
                    <a href="{{ route('artikel.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Semua Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed';
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i>Link berhasil disalin!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        
        // Remove after animation
        toast.addEventListener('hidden.bs.toast', () => {
            document.body.removeChild(toast);
        });
    });
}
</script>
@endpush

@push('styles')
<style>
.article-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.article-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
}

.article-content h1,
.article-content h2,
.article-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}

.article-content blockquote {
    border-left: 4px solid var(--bs-primary);
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    background: rgba(var(--bs-primary-rgb), 0.1);
    padding: 1rem;
    border-radius: 0 8px 8px 0;
}
</style>
@endpush