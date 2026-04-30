@extends('layouts.app')

@section('title', 'Struktur Kepengurusan - UKM Cakra Manggala')

@section('content')

@php
    $bgImage = asset('image/fotobersejarah2.jpg');
@endphp

<!-- Hero Section -->
<section class="hero-section" style="height: 50vh; background: linear-gradient(rgba(46, 125, 50, 0.8), rgba(27, 94, 32, 0.9)), url('{{ $bgImage }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row align-items-center h-100">
            <div class="col-12 text-center text-white">
                <h1 class="display-5 fw-bold mb-3" data-aos="fade-up">Struktur Kepengurusan</h1>
                <div class="mt-3" data-aos="fade-up" data-aos-delay="300">
                    <span class="badge bg-light text-success px-3 py-2" style="font-size: 0.9rem;">
                        Tabah • Tangguh • Terampil
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Period Info -->
<section class="py-3 py-md-4 bg-light">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h3 class="mb-2" style="color: var(--primary-color); font-size: 1.3rem;">
                <i class="bi bi-calendar-check me-2"></i>Periode 2024-2025
            </h3>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                Pengurus aktif unit kegiatan mahasiswa pecinta alam Cakra Manggala
        </div>
    </div>
</section>

<!-- Ketua Umum -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="text-center mb-4 mb-md-5" data-aos="fade-up">
            <h2 style="color: var(--primary-color);">
                <i class="bi bi-award me-2"></i>Ketua Umum
            </h2>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm text-center h-100">
                    <div class="card-body p-3 p-md-4">
                        <div class="position-relative d-inline-block mb-3">
                            <img src={{ asset('image/profilkosong.png') }}
                                 class="rounded-circle shadow" width="120" height="120" style="object-fit: cover;" alt="Ketua">
                            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 35px; height: 35px;">
                                <i class="bi bi-star-fill text-white" style="font-size: 1rem;"></i>
                            </div>
                        </div>
                        <h5 class="mb-2" style="color: var(--primary-color);">Satria Dwi Saputra</h5>
                        <div class="badge bg-success text-white mb-2 px-3 py-2">Ketua Umum</div>
                        <p class="text-muted small mb-3">Teknik Listrik '23</p>
                        <div class="border-top pt-3">
                            <p class="small fst-italic text-muted mb-0" style="font-size: 0.85rem; line-height: 1.4;">
                                "Tidak perlu kata-kata yang penting bukti nyata"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pengurus Inti -->
<section class="py-4 py-md-5 bg-light">
    <div class="container">
        <div class="text-center mb-4 mb-md-5" data-aos="fade-up">
            <h2 style="color: var(--primary-color);">
                <i class="bi bi-people me-2"></i>Pengurus Inti
            </h2>
        </div>
        
        <div class="row g-3 g-md-4">
            <!-- Sekretaris -->
            <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm text-center h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src={{ asset('image/profilkosong.png') }} 
                             class="rounded-circle shadow-sm mb-3" width="100" height="100" style="object-fit: cover;" alt="Sekretaris">
                        <h6 class="mb-2" style="color: var(--primary-color); font-size: 1rem;">Naufal Rohmanul Muhaimin</h6>
                        <div class="badge bg-light text-success mb-2 px-2 py-1" style="font-size: 0.8rem;">Sekretaris</div>
                        <p class="text-muted small mb-0" style="font-size: 0.85rem;">Teknik Komputer Kontrol '23</p>
                    </div>
                </div>
            </div>

            <!-- Bendahara -->
            <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm text-center h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src={{ asset('image/profilkosong.png') }}
                             class="rounded-circle shadow-sm mb-3" width="100" height="100" style="object-fit: cover;" alt="Bendahara">
                        <h6 class="mb-2" style="color: var(--primary-color); font-size: 1rem;">Alvina Qorik Cahyani</h6>
                        <div class="badge bg-light text-success mb-2 px-2 py-1" style="font-size: 0.8rem;">Bendahara</div>
                        <p class="text-muted small mb-0" style="font-size: 0.85rem;">Akuntansi '23</p>
                    </div>
                </div>
            </div>

            <!-- Kepala Bidang Logistik -->
            <div class="col-12 col-md-12 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm text-center h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src={{ asset('image/profilkosong.png') }}
                             class="rounded-circle shadow-sm mb-3" width="100" height="100" style="object-fit: cover;" alt="Logistik">
                        <h6 class="mb-2" style="color: var(--primary-color); font-size: 1rem;">Albert Setya Candra Wijaya</h6>
                        <div class="badge bg-light text-success mb-2 px-2 py-1" style="font-size: 0.8rem;">Kepala Bidang Logistik</div>
                        <p class="text-muted small mb-0" style="font-size: 0.85rem;">Teknik Rekayasa Otomotif '22</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kepala Bidang -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="text-center mb-4 mb-md-5" data-aos="fade-up">
            <h2 style="color: var(--primary-color);">
                <i class="bi bi-diagram-3 me-2"></i>Kepala Bidang
            </h2>
        </div>

        <div class="row g-3 g-md-4">
            <!-- Kepala Bidang Publikasi dan Dokumentasi -->
            <div class="col-12 col-lg-6" data-aos="fade-up">
                <div class="card border-0 shadow-sm text-center h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src={{ asset('image/profilkosong.png') }}
                             class="rounded-circle shadow-sm mb-3" width="100" height="100" style="object-fit: cover;" alt="Publikasi">
                        <h6 class="mb-2" style="color: var(--primary-color); font-size: 1rem;">Muhammad Dzakwan Alfaris</h6>
                        <div class="badge bg-light text-success mb-2 px-2 py-1" style="font-size: 0.8rem;">Kepala Bidang Publikasi dan Dokumentasi</div>
                        <p class="text-muted small mb-0" style="font-size: 0.85rem;">Teknologi Rekayasa Perangkat Lunak '23</p>
                    </div>
                </div>
            </div>

            <!-- Kepala Bidang Kaderisasi, Penelitian dan PSDM -->
            <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm text-center h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src={{ asset('image/profilkosong.png') }}
                             class="rounded-circle shadow-sm mb-3" width="100" height="100" style="object-fit: cover;" alt="Kaderisasi">
                        <h6 class="mb-2" style="color: var(--primary-color); font-size: 1rem;">Maulaya Ilyasa Jayamagusta</h6>
                        <div class="badge bg-light text-success mb-2 px-2 py-1" style="font-size: 0.8rem;">Kepala Bidang Kaderisasi, Penelitian dan PSDM</div>
                        <p class="text-muted small mb-0" style="font-size: 0.85rem;">Perkeretaapian '23</p>
                    </div>
                </div>
            </div>

            <!-- Kepala Bidang Lingkungan dan Pengabdian Masyarakat -->
            <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body p-3 p-md-4">
                        <img src={{ asset('image/profilkosong.png') }} 
                             class="rounded-circle shadow-sm mb-3" width="100" height="100" style="object-fit: cover;" alt="Lingkungan">
                        <h6 class="mb-2" style="color: var(--primary-color); font-size: 1rem;">Erzal Abilla Saputra</h6>
                        <div class="badge bg-light text-success mb-2 px-2 py-1" style="font-size: 0.8rem;">Kepala Bidang Lingkungan dan Pengabdian Masyarakat</div>
                        <p class="text-muted small mb-0" style="font-size: 0.85rem;">Teknologi Informasi '23</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Anggota Bidang -->
<section class="py-4 py-md-5 bg-light">
    <div class="container">
        <div class="text-center mb-4 mb-md-5" data-aos="fade-up">
            <h2 style="color: var(--primary-color);">
                <i class="bi bi-person-check me-2"></i>Anggota Bidang
            </h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm text-center h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src={{ asset('image/profilkosong.png') }}
                             class="rounded-circle shadow-sm mb-3" width="100" height="100" style="object-fit: cover;" alt="Anggota">
                        <h6 class="mb-2" style="color: var(--primary-color); font-size: 1rem;">Rindu Resty Ananda Faradilla</h6>
                        <div class="badge bg-light text-success mb-2 px-2 py-1" style="font-size: 0.8rem;">Anggota Bidang Lingkungan dan Pengabdian Masyarakat</div>
                        <p class="text-muted small mb-0" style="font-size: 0.85rem;">Akuntansi Sektor Publik '22</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Spirit Section -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="text-center px-3" data-aos="fade-up">
                    <div class="mb-3 mb-md-4">
                        <i class="bi bi-people-fill" style="color: var(--primary-color); font-size: 2.5rem;"></i>
                    </div>
                    <blockquote class="blockquote">
                        <p class="fs-5 fs-md-4 fw-light lh-lg mb-3 mb-md-4" style="color: #2c3e50; font-style: italic; font-size: 1.1rem !important; line-height: 1.6;">
                            "Bersama-sama kita membangun organisasi yang kuat, berkarakter, dan bermanfaat bagi semua. Setiap pengurus adalah <strong>PEMIMPIN</strong> yang bertanggung jawab atas kemajuan UKM Pecinta Alam Cakra Manggala."
                        </p>
                    </blockquote>
                    <div class="mt-3 mt-md-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="bg-success" style="width: 30px; height: 2px;"></div>
                            <i class="bi bi-award mx-3" style="color: var(--primary-color); font-size: 1.5rem;"></i>
                            <div class="bg-success" style="width: 30px; height: 2px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Mobile First Approach - Consistent with about.blade.php */
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
    
    /* Better spacing for mobile */
    .py-4 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
    
    .py-3 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
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
    
    /* Adjust card spacing */
    .g-3 > * {
        padding-right: 0.5rem !important;
        padding-left: 0.5rem !important;
        margin-bottom: 1rem !important;
    }
    
    /* Better text sizing for very small screens */
    .card-body h6 {
        font-size: 0.95rem !important;
    }
    
    .card-body p,
    .card-body .badge {
        font-size: 0.8rem !important;
    }
    
    /* Smaller profile images on mobile */
    .card img {
        width: 80px !important;
        height: 80px !important;
    }
    
    /* Ketua Umum special styling for mobile */
    .card img[width="120"] {
        width: 100px !important;
        height: 100px !important;
    }
    
    /* Quote section adjustments */
    blockquote p {
        font-size: 0.95rem !important;
    }
    
    /* Section titles for mobile */
    section h2 {
        font-size: 1.4rem !important;
    }
    
    section h3 {
        font-size: 1.2rem !important;
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
    
    /* Smaller images for very small screens */
    .card img {
        width: 70px !important;
        height: 70px !important;
    }
    
    .card img[width="120"] {
        width: 90px !important;
        height: 90px !important;
    }
    
    /* Stack cards better on tiny screens */
    .col-md-6 {
        margin-bottom: 1rem !important;
    }
}

/* Card hover effects */
.card {
    transition: all 0.3s ease;
    border-radius: 15px;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
}

.card img {
    transition: all 0.3s ease;
}

.card:hover img {
    transform: scale(1.05);
}

/* Badge styling consistency */
.badge {
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.8rem;
}

/* Period info section styling */
.bg-light {
    background-color: #f8f9fa !important;
}

/* Consistent color variables */
:root {
    --primary-color: #28a745;
    --secondary-color: #6c757d;
}
</style>

@endsection