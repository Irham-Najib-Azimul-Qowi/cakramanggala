{{-- File: resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda - UKM Cakra Manggala')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="hero-content text-center">
                        <h1 class="hero-title" data-aos="fade-up">
                            UKM Pecinta Alam<br>
                            <span style="color: #ff6b35;">CAKRA MANGGALA</span>
                        </h1>
                        <div class="hero-buttons" data-aos="fade-up" data-aos-delay="400">
                            <a href="{{ route('join') }}" class="btn btn-oprec btn-lg me-3">
                                <i class="bi bi-person-plus"></i> 
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <i class="bi bi-chevron-down text-white fs-3"></i>
        </div>
    </section>

        <!-- News Section -->
    <section class="news-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">
                <i class="bi bi-newspaper me-2"></i>
                Berita, Artikel & Catatan Perjalanan 
            </h2>
            
            @if($artikels->count() > 0)
                <div class="row g-3 g-md-4">
                    @foreach($artikels as $artikel)
                    <!-- News Card -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card news-card h-100" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @if($artikel->gambar_utama)
                            <img src="{{ asset($artikel->gambar_utama) }}"
                                class="card-img-top"
                                alt="{{ $artikel->judul }}"
                                loading="lazy"
                                style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                            <div class="card-body d-flex flex-column">
                                <div class="news-meta">
                                    <i class="bi bi-calendar"></i> 
                                    <span class="d-none d-sm-inline">{{ $artikel->created_at->format('d F Y') }}</span>
                                    <span class="d-sm-none">{{ $artikel->created_at->format('d/m/y') }}</span> | 
                                    <i class="bi bi-person"></i> {{ $artikel->user->name }}
                                    @if($artikel->views > 0)
                                        | <i class="bi bi-eye"></i> {{ number_format($artikel->views) }}
                                    @endif
                                </div>
                                
                                <h5 class="card-title">{{ $artikel->judul }}</h5>
                                
                                <p class="card-text flex-grow-1">
                                    {{ $artikel->excerpt ?: Str::limit(strip_tags($artikel->konten), 120) }}
                                </p>
                                
                                <a href="{{ route('artikel.show', $artikel->slug) }}" 
                                class="btn btn-outline-primary btn-sm mt-auto">
                                    <span class="d-none d-sm-inline">Baca Selengkapnya</span>
                                    <span class="d-sm-none">Baca</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Link ke halaman artikel lengkap -->
                @if($artikels->count() >= 6)
                    <div class="text-center mt-4" data-aos="fade-up">
                        <a href="{{ route('artikel.index') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Lihat Semua Artikel
                        </a>
                    </div>
                @endif
            @else
                <!-- Jika belum ada artikel -->
                <div class="text-center py-5" data-aos="fade-up">
                    <i class="bi bi-newspaper display-1 text-muted"></i>
                    <h5 class="mt-3 text-muted">Belum Ada Artikel</h5>
                    <p class="text-muted">Artikel dan berita terbaru akan segera hadir.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container text-center text-white">
            <div data-aos="fade-up">
                <h2 class="cta-title">Hello Gengs! Siap Memulai Petualangan?</h2>
                <p class="cta-subtitle">Bergabunglah dengan keluarga besar Cakra Manggala dan temukan pengalaman tak terlupakan di alam bebas</p>
                <a href="{{ route('join') }}" class="btn btn-oprec btn-lg cta-button">
                    <i class="bi bi-arrow-right-circle"></i> 
                    <span class="d-none d-sm-inline">Mulai Perjalananmu</span>
                    <span class="d-sm-none">Mulai Sekarang</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Additional Responsive Styles -->
    <style>
        /* Hero Section */
        .hero-section {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
            z-index: 1;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            animation: bgSlider 18s infinite;
            z-index: -2;
            opacity: 0.5;
        }
        .hero-section::after {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* lapisan hitam transparan */
            z-index: -1;
        }

        @keyframes bgSlider {
            0%   { background-image: url('/image/fotobersejarah1.jpg'); }
            33%  { background-image: url('/image/fotobersejarah2.jpg'); }
            66%  { background-image: url('/image/fotobersejarah3.jpg'); }
            100% { background-image: url('/image/fotobersejarah1.jpg'); }
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 2rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .btn-oprec {
            background: var(--accent-color);
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
        }
        
        .btn-oprec:hover {
            background: #e55722;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
            color: white;
        }

        .btn-outline-light {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-outline-light:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.3);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }
        
        /* News Cards */
        .news-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .news-card .card-img-top {
            height: 180px;
            object-fit: cover;
        }
        
        .news-meta {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 0.75rem;
        }
        
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--primary-color);
        }
        
        .card-text {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.5;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 3rem 0;
            background: var(--primary-color);
        }
        
        .cta-title {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .cta-subtitle {
            font-size: 0.9rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .cta-button {
            font-size: 1rem;
            padding: 1rem 2rem;
        }
        
        /* Mobile Responsive Breakpoints */
        @media (max-width: 991px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .hero-buttons .btn {
                width: 100%;
                max-width: 300px;
            }
        }
        
        @media (max-width: 768px) {
            .hero-section {
                height: 80vh;
                padding: 2rem 1rem;
            }

            .hero-title {
                font-size: 2.5rem;
                margin-bottom: 1.5rem;
            }

            .hero-buttons .btn {
                padding: 0.8rem 1.8rem;
                font-size: 1rem;
            }
            
            .news-section, .quick-links {
                padding: 3rem 0;
            }
            
            .section-title {
                font-size: 1.5rem;
                margin-bottom: 2rem;
            }
            
            .cta-section {
                padding: 2rem 0;
            }
            
            .cta-title {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-section {
                height: 70vh;
            }

            .hero-title {
                font-size: 2rem;
                margin-bottom: 1.25rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }

            .hero-buttons .btn {
                font-size: 0.9rem;
                padding: 0.75rem 1.5rem;
                width: 100%;
                max-width: 280px;
            }
           
            .news-card .card-img-top {
                height: 160px;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .cta-title {
                font-size: 1.5rem;
            }
            
            .cta-subtitle {
                font-size: 1rem;
            }
            
            .scroll-indicator {
                bottom: 0.5rem;
            }
        }
        
        /* Extra small devices */
        @media (max-width: 350px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .hero-title {
                font-size: 1.8rem;
            }
            
            .hero-buttons .btn {
                font-size: 0.85rem;
                padding: 0.7rem 1.25rem;
            }
            
            .news-card .card-img-top {
                height: 140px;
            }
        }
        
        /* Ensure equal height for cards */
        .news-card,
        .quick-link-item {
            height: 100%;
        }
    </style>
@endsection