@extends('layouts.app')

@section('content')

@php
    $bgImage = asset('image/fotobersejarah2.jpg');
@endphp

<!-- Hero Section -->
<section class="hero-section" style="height: 50vh; background: linear-gradient(rgba(46, 125, 50, 0.8), rgba(27, 94, 32, 0.9)), url('{{ $bgImage }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row align-items-center h-100">
            <div class="col-12 text-center text-white">
                <h1 class="display-5 fw-bold mb-3" data-aos="fade-up">Tentang Kami</h1>
                <p class="lead px-3" data-aos="fade-up" data-aos-delay="200">
                    Mengenal lebih dalam Unit Kegiatan Mahasiswa Pecinta Alam Cakra Manggala
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Profil Organisasi Section -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="row align-items-center mb-4 mb-md-5">
            <div class="col-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="text-center">
                    <img src="{{ asset('image/fotobersejarah1.jpg') }}" 
                         class="img-fluid rounded shadow w-100" 
                         style="max-height: 350px; object-fit: cover;" 
                         alt="Tim CM">
                </div>
            </div>
            <div class="col-12 col-lg-6" data-aos="fade-left">
                <div class="px-3 px-md-0">
                    <h2 class="mb-3 mb-md-4 text-center text-lg-start" style="color: var(--primary-color);">
                        <i class="bi bi-tree me-2"></i>Sejarah Singkat
                    </h2>
                    <div class="text-justify">
                        <p class="lead mb-3 mb-md-4" style="font-size: 1rem; line-height: 1.6;">
                            Kegiatan kepencintaalaman di Politeknik Negeri Madiun tumbuh dari semangat mahasiswa yang mencintai alam dan ingin menyalurkan kegemarannya melalui aktivitas positif. Melihat belum adanya wadah resmi, sekelompok mahasiswa berinisiatif mendirikan sebuah organisasi pada <strong>26 Juli 2013</strong> dengan nama <strong>GEMAPALA</strong> (Generasi Mahasiswa Pecinta Alam).
                        </p>
                        <p class="mb-3 mb-md-4" style="font-size: 0.95rem; line-height: 1.6;">
                            Organisasi ini menjadi tempat berkumpul, belajar, dan bergerak bersama dalam melestarikan alam, membentuk karakter, serta mempererat solidaritas antaranggota melalui kegiatan di alam bebas. Pada <strong>19 Oktober 2014</strong>, GEMAPALA resmi berganti nama menjadi <strong>CAKRA MANGGALA</strong>, yang membawa semangat baru dalam menjalankan misi kepencintaalaman.
                        </p>
                        <p class="mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                            CAKRA MANGGALA hadir bukan hanya sebagai komunitas pecinta alam, tetapi juga sebagai wadah pembentukan pribadi tangguh, berjiwa sosial, dan peduli lingkungan. Berasaskan Pancasila dan UUD 1945, organisasi ini tetap netral dari politik dan konsisten menjalankan perannya sebagai pelopor kegiatan alam bebas yang edukatif, ilmiah, dan humanis di lingkungan Politeknik Negeri Madiun.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi Section -->
<section class="py-4 py-md-5 bg-light">
    <div class="container">
        <div class="row g-3 g-md-4">
            <div class="col-12 col-lg-6 mb-3 mb-lg-4" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="text-center mb-3 mb-md-4">
                            <i class="bi bi-eye" style="color: var(--primary-color); font-size: 2.5rem;"></i>
                            <h3 class="mt-2 mt-md-3 mb-0" style="color: var(--primary-color); font-size: 1.5rem;">Visi</h3>
                        </div>
                        <p class="text-center mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                            "Mahasiswa Pecinta Alam Cakra Manggala Politeknik Negeri Madiun sebagai organisasi yang mengembangkan intelektualitas, jasmani, dan rohani serta menumbuhkan kesadaran terhadap alam, sehingga menjadi panutan bagi Pemuda Indonesia pada umumnya dan Politeknik Negeri Madiun Khususnya."
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="text-center mb-3 mb-md-4">
                            <i class="bi bi-bullseye" style="color: var(--primary-color); font-size: 2.5rem;"></i>
                            <h3 class="mt-2 mt-md-3 mb-0" style="color: var(--primary-color); font-size: 1.5rem;">Misi</h3>
                        </div>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 mb-md-3 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                                <span style="font-size: 0.9rem; line-height: 1.5;">Menjalankan organisasi dengan prinsip tata kelola yang baik dan mengikat</span>
                            </li>
                            <li class="mb-2 mb-md-3 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                                <span style="font-size: 0.9rem; line-height: 1.5;">Meningkatkan kemampuan teknis, fisik, dan kesadaran terhadap lingkungan hidup</span>
                            </li>
                            <li class="mb-2 mb-md-3 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                                <span style="font-size: 0.9rem; line-height: 1.5;">Membangun hubungan yang baik dan saling menguntungkan dengan pihak internal maupun eksternal</span>
                            </li>
                            <li class="mb-0 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1 flex-shrink-0"></i>
                                <span style="font-size: 0.9rem; line-height: 1.5;">Mengembangkan kegiatan yang mendukung kemajuan ilmu pengetahuan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Divisi Section -->
<section class="py-4 py-md-5">
    <div class="container">
        <h2 class="text-center mb-4 mb-md-5 px-3" style="color: var(--primary-color);" data-aos="fade-up">
            <i class="bi bi-diagram-3 me-2"></i>Divisi Kami
        </h2>
        <div class="row g-3 g-md-4">
            <div class="col-12 col-lg-6 mb-3 mb-lg-0" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="text-center mb-3 mb-md-4">
                            <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="bi bi-tree-fill text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h4 style="color: var(--primary-color); font-size: 1.3rem;">Gunung Hutan (GH)</h4>
                        </div>
                        <p class="text-center mb-3 mb-md-4" style="font-size: 0.9rem; line-height: 1.6;">
                            Divisi yang mengkhususkan diri dalam kegiatan pendakian gunung, penjelajahan hutan, dan aktivitas alam bebas. Anggota divisi ini dilatih untuk memiliki kemampuan navigasi, survival, dan pemahaman mendalam tentang ekosistem pegunungan dan hutan.
                        </p>
                        <div class="text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <small class="badge bg-light text-dark px-2 py-1">
                                    <i class="bi bi-mountain me-1"></i> Pendakian
                                </small>
                                <small class="badge bg-light text-dark px-2 py-1">
                                    <i class="bi bi-compass me-1"></i> Navigasi
                                </small>
                                <small class="badge bg-light text-dark px-2 py-1">
                                    <i class="bi bi-flower1 me-1"></i> Konservasi
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3 p-md-4">
                        <div class="text-center mb-3 mb-md-4">
                            <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="bi bi-activity text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h4 style="color: var(--primary-color); font-size: 1.3rem;">Rock Climbing (RC)</h4>
                        </div>
                        <p class="text-center mb-3 mb-md-4" style="font-size: 0.9rem; line-height: 1.6;">
                            Divisi yang fokus pada kegiatan panjat tebing dan olahraga vertikal. Anggota divisi ini dilatih dalam teknik memanjat, penggunaan peralatan keselamatan, dan pemahaman tentang geologi batuan serta manajemen risiko dalam aktivitas vertikal.
                        </p>
                        <div class="text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <small class="badge bg-light text-dark px-2 py-1">
                                    <i class="bi bi-shield-check me-1"></i> Keselamatan
                                </small>
                                <small class="badge bg-light text-dark px-2 py-1">
                                    <i class="bi bi-gear me-1"></i> Peralatan
                                </small>
                                <small class="badge bg-light text-dark px-2 py-1">
                                    <i class="bi bi-trophy me-1"></i> Kompetisi
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nilai-nilai Organisasi -->
<section class="py-4 py-md-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 mb-md-5 px-3" style="color: var(--primary-color);" data-aos="fade-up">
            <i class="bi bi-heart me-2"></i>Nilai-nilai Organisasi
        </h2>
        <div class="row g-3 g-md-4">
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up">
                <div class="text-center p-3 p-md-4 h-100 d-flex flex-column">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 60px; height: 60px;">
                        <i class="bi bi-shield-check text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <h6 class="mb-2" style="font-size: 1rem;">Integritas</h6>
                    <p class="text-muted mb-0 flex-grow-1" style="font-size: 0.85rem; line-height: 1.4;">
                        Berpegang teguh pada kejujuran, transparansi, dan konsistensi dalam setiap tindakan dan keputusan.
                    </p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center p-3 p-md-4 h-100 d-flex flex-column">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 60px; height: 60px;">
                        <i class="bi bi-trophy text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <h6 class="mb-2" style="font-size: 1rem;">Prestasi</h6>
                    <p class="text-muted mb-0 flex-grow-1" style="font-size: 0.85rem; line-height: 1.4;">
                        Berusaha memberikan yang terbaik dan mencapai keunggulan dalam setiap kegiatan yang dilakukan.
                    </p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center p-3 p-md-4 h-100 d-flex flex-column">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 60px; height: 60px;">
                        <i class="bi bi-book text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <h6 class="mb-2" style="font-size: 1rem;">Pembelajaran</h6>
                    <p class="text-muted mb-0 flex-grow-1" style="font-size: 0.85rem; line-height: 1.4;">
                        Senantiasa belajar, mengembangkan diri, dan berbagi pengetahuan dengan sesama anggota.
                    </p>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center p-3 p-md-4 h-100 d-flex flex-column">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 60px; height: 60px;">
                        <i class="bi bi-lightning text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <h6 class="mb-2" style="font-size: 1rem;">Petualang</h6>
                    <p class="text-muted mb-0 flex-grow-1" style="font-size: 0.85rem; line-height: 1.4;">
                        Memiliki jiwa penjelajah yang berani menghadapi tantangan dan selalu siap untuk petualangan baru.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quote Section -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="text-center px-3" data-aos="fade-up">
                    <div class="mb-3 mb-md-4">
                        <i class="bi bi-quote" style="color: var(--primary-color); font-size: 2.5rem;"></i>
                    </div>
                    <blockquote class="blockquote">
                        <p class="fs-5 fs-md-4 fw-light lh-lg mb-3 mb-md-4" style="color: #2c3e50; font-style: italic; font-size: 1.1rem !important; line-height: 1.6;">
                            "Mahasiswa Pecinta Alam tidak akan memelonco Anda, melainkan akan membimbing Anda. Alam lah yang akan mendidik Anda setiap saat, dalam setiap kondisi, setiap medan, dan setiap situasi. Bila semua itu mampu Anda hadapi, menjelmalah anda menjadi seorang putra putri alam yang <strong>TABAH, TANGGUH, TERAMPIL</strong>."
                        </p>
                    </blockquote>
                    <div class="mt-3 mt-md-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="bg-success" style="width: 30px; height: 2px;"></div>
                            <i class="bi bi-tree mx-3" style="color: var(--primary-color); font-size: 1.5rem;"></i>
                            <div class="bg-success" style="width: 30px; height: 2px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
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
    
    .text-justify {
        text-align: justify;
    }
    
    /* Better spacing for mobile */
    .py-4 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
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
    .card-body p,
    .card-body li span {
        font-size: 0.85rem !important;
    }
    
    .card-body h4 {
        font-size: 1.1rem !important;
    }
    
    .card-body h6 {
        font-size: 0.9rem !important;
    }
    
    /* Quote section adjustments */
    blockquote p {
        font-size: 0.95rem !important;
    }
    
    /* Nilai-nilai cards for mobile */
    .col-6:nth-child(odd) {
        padding-right: 0.25rem !important;
    }
    
    .col-6:nth-child(even) {
        padding-left: 0.25rem !important;
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
    
    /* Stack nilai-nilai cards vertically on very small screens */
    .col-6 {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }
}
</style>

@endsection