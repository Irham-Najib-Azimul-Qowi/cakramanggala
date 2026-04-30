{{-- File: resources/views/artikel/index.blade.php --}}
@extends('layouts.app') {{-- Sesuaikan dengan layout utama website Anda --}}

@section('title', 'Artikel & Berita')

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">Artikel & Berita</h1>
                <p class="lead mb-4">Kumpulan artikel, berita, dan informasi terbaru dari UKM Pecinta Alam Cakra Manggala</p>
            </div>
            <div class="col-lg-4">
                <!-- Search Form -->
                <form method="GET" action="{{ route('artikel.index') }}" class="d-flex">
                    <input type="text" 
                           class="form-control me-2" 
                           name="search" 
                           value="{{ $search }}" 
                           placeholder="Cari artikel...">
                    <button type="submit" class="btn btn-light">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Articles Section -->
<section class="py-5">
    <div class="container">
        @if($search)
            <div class="alert alert-info">
                <i class="bi bi-search"></i> 
                Hasil pencarian untuk: <strong>"{{ $search }}"</strong> 
                ({{ $artikels->total() }} artikel ditemukan)
                <a href="{{ route('artikel.index') }}" class="btn btn-sm btn-outline-info ms-2">
                    <i class="bi bi-x"></i> Hapus Filter
                </a>
            </div>
        @endif

        @if($artikels->count() > 0)
            <div class="row g-4">
                @foreach($artikels as $artikel)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card">
                        @if($artikel->gambar_utama)
                            <img src="{{ asset($artikel->gambar_utama) }}"                                 class="card-img-top" 
                                 alt="{{ $artikel->judul }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        
                        <div class="card-body d-flex flex-column">
                            <div class="article-meta mb-2">
                                <small class="text-muted">
                                    <i class="bi bi-calendar"></i> {{ $artikel->created_at->format('d F Y') }} | 
                                    <i class="bi bi-person"></i> {{ $artikel->user->name }}
                                    @if($artikel->views > 0)
                                        | <i class="bi bi-eye"></i> {{ number_format($artikel->views) }}
                                    @endif
                                </small>
                            </div>
                            
                            <h5 class="card-title">
                                <a href="{{ route('artikel.show', $artikel->slug) }}" 
                                   class="text-decoration-none text-dark">
                                    {{ $artikel->judul }}
                                </a>
                            </h5>
                            
                            <p class="card-text flex-grow-1">
                                {{ $artikel->excerpt ?: Str::limit(strip_tags($artikel->konten), 120) }}
                            </p>
                            
                            <div class="mt-auto">
                                <a href="{{ route('artikel.show', $artikel->slug) }}" 
                                   class="btn btn-outline-primary btn-sm">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $artikels->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-newspaper display-1 text-muted"></i>
                <h3 class="mt-3 text-muted">
                    @if($search)
                        Tidak Ada Hasil
                    @else
                        Belum Ada Artikel
                    @endif
                </h3>
                @if($search)
                    <a href="{{ route('artikel.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Semua Artikel
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.article-meta {
    font-size: 0.875rem;
}

.hero-section {
    background: linear-gradient(135deg, var(--primary-color, #2e7d32) 0%, var(--dark-color, #1b5e20) 100%);
}
</style>
@endpush