{{-- File: resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Kontak dan Sosial Media - UKM Cakra Manggala')

@section('content')

@php
    $bgImage = asset('image/fotobersejarah2.jpg');
@endphp

<!-- Hero Section -->
<section class="hero-section" style="height: 50vh; background: linear-gradient(rgba(46, 125, 50, 0.8), rgba(27, 94, 32, 0.9)), url('{{ $bgImage }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row align-items-center h-100">
            <div class="col-12 text-center text-white">
                <h1 class="display-5 fw-bold mb-3" data-aos="fade-up">Kontak dan Sosial Media</h1>
                <p class="lead px-3" data-aos="fade-up" data-aos-delay="200">
                    Hubungi kami untuk informasi lebih lanjut tentang UKM Pecinta Alam Cakra Manggala
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Logos Section -->
<section class="py-4 py-md-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-4 mb-md-5">
            <div class="col-12 col-md-8 col-lg-6" data-aos="fade-up">
                <div class="d-flex justify-content-center align-items-center gap-3 gap-md-4 flex-wrap">
                    <div class="logo-item text-center">
                        <img src="{{ asset('image/logo-pnm.png') }}" alt="Logo Politeknik Negeri Madiun" class="img-fluid mb-2" style="max-width: 80px; max-height: 80px;">
                        <h6 class="text-success fw-bold mb-0" style="font-size: 0.8rem; line-height: 1.2;">Politeknik Negeri<br>Madiun</h6>
                    </div>
                    <div class="logo-divider d-none d-md-block" style="width: 2px; height: 60px; background: #2e7d32;"></div>
                    <div class="logo-item text-center">
                        <img src="{{ asset('image/logo.png') }}" alt="Logo Cakra Manggala" class="img-fluid mb-2" style="max-width: 80px; max-height: 80px;">
                        <h6 class="text-success fw-bold mb-0" style="font-size: 0.8rem; line-height: 1.2;">UKM Pecinta Alam<br>Cakra Manggala</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information Section -->
<section class="py-4 py-md-5">
    <div class="container">
        <h2 class="text-center mb-4 mb-md-5 px-3" style="color: var(--primary-color);" data-aos="fade-up">
            <i class="bi bi-telephone me-2"></i>Informasi Kontak
        </h2>
        <div class="row g-3 g-md-4">
            <!-- Alamat Sekretariat -->
            <div class="col-12 col-lg-6 mb-3 mb-lg-0" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="text-center mb-3 mb-md-4">
                            <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="bi bi-geo-alt-fill text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h4 style="color: var(--primary-color); font-size: 1.3rem;">Alamat Sekretariat</h4>
                        </div>
                        <div class="contact-info text-center">
                            <p class="mb-2 fw-bold" style="font-size: 0.9rem;">Sekretariat UKM Pecinta Alam Cakra Manggala</p>
                            <p class="mb-2" style="font-size: 0.85rem; line-height: 1.6;">Lantai 1 Gedung Perkuliahan Kampus 1</p>
                            <p class="mb-2" style="font-size: 0.85rem; line-height: 1.6;">Politeknik Negeri Madiun</p>
                            <p class="mb-0" style="font-size: 0.85rem; line-height: 1.6;">Jl. Serayu No.84, Pandean, Taman, Kec. Taman, Kota Madiun, Jawa Timur (63133)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email & Website -->
            <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="text-center mb-3 mb-md-4">
                            <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="bi bi-envelope-fill text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h4 style="color: var(--primary-color); font-size: 1.3rem;">Email & Website</h4>
                        </div>
                        <div class="contact-info">
                            <div class="mb-3 text-center">
                                <p class="mb-2 fw-bold" style="font-size: 0.9rem;">Email Resmi</p>
                                <a href="mailto:sekretariat.cakramanggala@pnm.ac.id" class="text-decoration-none d-block" style="color: var(--primary-color); font-size: 0.85rem; word-break: break-all;">
                                    <i class="bi bi-envelope me-2"></i>sekretariat.cakramanggala@pnm.ac.id
                                </a>
                            </div>
                            <div class="text-center">
                                <p class="mb-2 fw-bold" style="font-size: 0.9rem;">Website</p>
                                <a href="https://cakramanggala.pnm.ac.id" class="text-decoration-none d-block" target="_blank" style="color: var(--primary-color); font-size: 0.85rem;">
                                    <i class="bi bi-globe me-2"></i>cakramanggala.pnm.ac.id
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Section -->
<section class="py-4 py-md-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 mb-md-5 px-3" style="color: var(--primary-color);" data-aos="fade-up">
            <i class="bi bi-share me-2"></i>Sosial Media Kami
        </h2>
        <div class="text-center mb-4 mb-md-5" data-aos="fade-up" data-aos-delay="100">
            <p class="lead px-3" style="font-size: 1rem; line-height: 1.6;">
                Dapatkan update terbaru tentang kegiatan, event, dan informasi penting lainnya dari UKM Cakra Manggala
            </p>
        </div>

        <div class="row g-3 g-md-4">
            <!-- Instagram -->
            <div class="col-12 col-md-4 mb-3 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm social-card">
                    <div class="card-body p-3 p-md-4 text-center">
                        <div class="social-icon instagram rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-instagram text-white" style="font-size: 1.8rem;"></i>
                        </div>
                        <h5 class="mb-2" style="color: var(--primary-color); font-size: 1.2rem;">Instagram</h5>
                        <p class="mb-3" style="font-size: 0.9rem; color: #6c757d;">@cakramanggala.pnm</p>
                        <a href="https://instagram.com/cakramanggala.pnm" target="_blank" class="btn btn-sm" style="background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 25px;">
                            <i class="bi bi-instagram me-2"></i>Follow
                        </a>
                    </div>
                </div>
            </div>

            <!-- YouTube -->
            <div class="col-12 col-md-4 mb-3 mb-md-0" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm social-card">
                    <div class="card-body p-3 p-md-4 text-center">
                        <div class="social-icon youtube bg-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-youtube text-white" style="font-size: 1.8rem;"></i>
                        </div>
                        <h5 class="mb-2" style="color: var(--primary-color); font-size: 1.2rem;">YouTube</h5>
                        <p class="mb-3" style="font-size: 0.9rem; color: #6c757d;">Cakra Manggala Official</p>
                        <a href="https://youtube.com/" target="_blank" class="btn btn-danger btn-sm" style="padding: 0.5rem 1.5rem; border-radius: 25px;">
                            <i class="bi bi-youtube me-2"></i>Subscribe
                        </a>
                    </div>
                </div>
            </div>

            <!-- TikTok -->
            <div class="col-12 col-md-4 mb-3 mb-md-0" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm social-card">
                    <div class="card-body p-3 p-md-4 text-center">
                        <div class="social-icon tiktok rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background: linear-gradient(45deg, #ff0050, #00f2ea);">
                            <i class="bi bi-music-note text-white" style="font-size: 1.8rem;"></i>
                        </div>
                        <h5 class="mb-2" style="color: var(--primary-color); font-size: 1.2rem;">TikTok</h5>
                        <p class="mb-3" style="font-size: 0.9rem; color: #6c757d;">@cakramanggala.pnm</p>
                        <a href="https://tiktok.com/" target="_blank" class="btn btn-sm" style="background: linear-gradient(45deg, #ff0050, #00f2ea); color: white; border: none; padding: 0.5rem 1.5rem; border-radius: 25px;">
                            <i class="bi bi-music-note me-2"></i>Follow
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-4 py-md-5">
    <div class="container">
        <h2 class="text-center mb-4 mb-md-5 px-3" style="color: var(--primary-color);" data-aos="fade-up">
            <i class="bi bi-geo-alt me-2"></i>Lokasi Kami
        </h2>
        <div class="text-center mb-4 mb-md-5" data-aos="fade-up" data-aos-delay="100">
            <p class="lead px-3" style="font-size: 1rem; line-height: 1.6;">
                Temukan lokasi sekretariat UKM Cakra Manggala di Politeknik Negeri Madiun
            </p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10" data-aos="fade-up" data-aos-delay="200">
                <div class="map-container shadow-sm" style="border-radius: 15px; overflow: hidden;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.7234567890123!2d111.52123456789012!3d-7.612345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79be35b3456789%3A0x1234567890abcdef!2sPoliteknik%20Negeri%20Madiun!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid" 
                        width="100%" 
                        height="350" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Consistent card styling like about.blade.php */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
}

.social-card:hover {
    transform: translateY(-5px);
}

.contact-info a {
    transition: all 0.3s ease;
}

.contact-info a:hover {
    color: var(--secondary-color) !important;
    text-decoration: underline !important;
}

.social-icon.instagram {
    background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
}

.map-container {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Mobile responsive adjustments matching about.blade.php */
@media (max-width: 768px) {
    .hero-section {
        height: 40vh !important;
    }
    
    .hero-section h1 {
        font-size: 2.2rem !important;
    }
    
    .hero-section .lead {
        font-size: 1rem !important;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .py-4 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
    
    .logo-divider {
        display: none !important;
    }
    
    .logo-item {
        margin-bottom: 1rem;
    }
    
    .logo-item:last-child {
        margin-bottom: 0;
    }
    
    .logo-item img {
        max-width: 60px !important;
        max-height: 60px !important;
    }
    
    .logo-item h6 {
        font-size: 0.7rem !important;
    }
}

@media (max-width: 576px) {
    .hero-section {
        height: 35vh !important;
    }
    
    .hero-section h1 {
        font-size: 1.8rem !important;
    }
    
    .hero-section .lead {
        font-size: 0.9rem !important;
    }
    
    .g-3 > * {
        padding-right: 0.5rem !important;
        padding-left: 0.5rem !important;
        margin-bottom: 1rem !important;
    }
    
    .card-body p,
    .card-body a {
        font-size: 0.8rem !important;
    }
    
    .card-body h4 {
        font-size: 1.1rem !important;
    }
    
    .card-body h5 {
        font-size: 1rem !important;
    }
    
    .lead {
        font-size: 0.9rem !important;
    }
    
    .map-container iframe {
        height: 250px !important;
    }
    
    .logo-item img {
        max-width: 50px !important;
        max-height: 50px !important;
    }
    
    .social-icon {
        width: 60px !important;
        height: 60px !important;
    }
    
    .social-icon i {
        font-size: 1.5rem !important;
    }
}

@media (max-width: 400px) {
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .hero-section .lead {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    
    .card-body {
        padding: 0.75rem !important;
    }
    
    .contact-info a {
        word-break: break-all;
        font-size: 0.75rem !important;
    }
}
</style>

@endsection