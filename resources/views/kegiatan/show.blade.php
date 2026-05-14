@extends('layouts.app')

@section('title', $kegiatan->judul_kegiatan . ' - UKM Cakra Manggala')

@section('content')
    <div class="activity-detail" style="background-color: var(--dark-color); color: #fff; min-height: 100vh; padding-top: 100px;">
        <div class="container py-5">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up">
                <ol class="breadcrumb" style="background: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('activities') }}" class="text-white-50">Kegiatan</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($kegiatan->judul_kegiatan, 30) }}</li>
                </ol>
            </nav>

            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="detail-header mb-5" data-aos="fade-up">
                        <span class="badge mb-3 text-uppercase" style="background: var(--accent-color); color: var(--primary-color); font-weight: 800; letter-spacing: 0.1em; padding: 0.5rem 1rem; border-radius: 0;">
                            {{ $kegiatan->sifat }}
                        </span>
                        <h1 class="display-5 fw-black mb-4" style="letter-spacing: -0.02em;">{{ strtoupper($kegiatan->judul_kegiatan) }}</h1>
                        
                        <div class="d-flex flex-wrap gap-4 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">
                            <span><i class="bi bi-calendar3 me-2" style="color: var(--accent-color);"></i> {{ $kegiatan->tanggal_pelaksanaan->format('d F Y') }}</span>
                            <span><i class="bi bi-geo-alt-fill me-2" style="color: var(--accent-color);"></i> {{ $kegiatan->tempat }}</span>
                            <span><i class="bi bi-person-fill me-2" style="color: var(--accent-color);"></i> {{ $kegiatan->kapel_pj }}</span>
                        </div>
                    </div>

                    <!-- Main Image -->
                    <div class="main-image-wrapper mb-5" data-aos="zoom-in">
                        <div class="position-relative overflow-hidden" style="aspect-ratio: 16/9; border: 1px solid rgba(255,255,255,0.1);">
                            <img src="{{ $kegiatan->gambar_utama ? asset($kegiatan->gambar_utama) : asset('image/logo.png') }}" 
                                 class="w-100 h-100 object-fit-cover" 
                                 alt="{{ $kegiatan->judul_kegiatan }}">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="detail-body mb-5" data-aos="fade-up">
                        <h3 class="h4 fw-bold mb-4 text-uppercase" style="letter-spacing: 0.1em; color: var(--accent-color);">Deskripsi Kegiatan</h3>
                        <div class="description-text lh-lg" style="color: rgba(255,255,255,0.85); font-size: 1.1rem;">
                            @if($kegiatan->deskripsi)
                                {!! nl2br(e($kegiatan->deskripsi)) !!}
                            @else
                                <p class="fst-italic opacity-50">Belum ada deskripsi untuk kegiatan ini.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Documentation Gallery -->
                    <div class="detail-gallery mb-5" data-aos="fade-up">
                        <h3 class="h4 fw-bold mb-4 text-uppercase" style="letter-spacing: 0.1em; color: var(--accent-color);">Dokumentasi</h3>
                        <div class="row g-3">
                            @php
                                $docs = is_array($kegiatan->dokumentasi) ? $kegiatan->dokumentasi : [];
                                // Ambil maksimal 6 gambar
                                $docs = array_slice($docs, 0, 6);
                            @endphp

                            @forelse($docs as $img)
                                <div class="col-md-4 col-6">
                                    <div class="gallery-item overflow-hidden" style="aspect-ratio: 1/1; border: 1px solid rgba(255,255,255,0.05);">
                                        <img src="{{ asset($img) }}" class="w-100 h-100 object-fit-cover gallery-img" 
                                             style="cursor: pointer; transition: transform 0.5s;" 
                                             alt="Dokumentasi {{ $kegiatan->judul_kegiatan }}">
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="small text-white-50 italic">Tidak ada foto dokumentasi tambahan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar-content sticky-top" style="top: 120px;">
                        <!-- Materi Box -->
                        <div class="info-card p-4 mb-4" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
                            <h5 class="fw-bold mb-3 text-uppercase small" style="letter-spacing: 0.15em; color: var(--accent-color);">Materi Utama</h5>
                            <p class="mb-0" style="color: rgba(255,255,255,0.7);">{{ $kegiatan->materi ?: '-' }}</p>
                        </div>

                        <!-- Related Activities -->
                        <div class="related-box">
                            <h5 class="fw-bold mb-4 text-uppercase small" style="letter-spacing: 0.15em;">Kegiatan Lainnya</h5>
                            @foreach($related as $rel)
                                <a href="{{ route('activities.show', $rel->id) }}" class="text-decoration-none d-block mb-4 group">
                                    <div class="d-flex gap-3">
                                        <div class="flex-shrink-0" style="width: 80px; height: 80px; border: 1px solid rgba(255,255,255,0.1);">
                                            <img src="{{ $rel->gambar_utama ? asset($rel->gambar_utama) : asset('image/logo.png') }}" 
                                                 class="w-100 h-100 object-fit-cover grayscale group-hover:grayscale-0 transition-all">
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-1 fw-bold group-hover:text-accent transition-colors" style="font-size: 0.9rem;">{{ Str::limit($rel->judul_kegiatan, 40) }}</h6>
                                            <span class="x-small text-white-50">{{ $rel->tanggal_pelaksanaan->format('M Y') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .gallery-img:hover {
            transform: scale(1.1);
        }
        .group:hover .group-hover\:text-accent {
            color: var(--accent-color) !important;
        }
        .group:hover .group-hover\:grayscale-0 {
            filter: grayscale(0);
        }
        .grayscale {
            filter: grayscale(1);
        }
        .x-small {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>
@endsection
