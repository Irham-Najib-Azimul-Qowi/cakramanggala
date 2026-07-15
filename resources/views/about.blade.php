@extends('layouts.app')

@section('title', 'Tentang Kami - UKM Cakra Manggala')

@section('content')
    @php
        $heroImage = asset('image/fotobersejarah2.jpg');
    @endphp

    <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
        <div class="container">
            <div class="page-hero__inner">
                <span class="page-hero__eyebrow" data-aos="fade-up">
                    <i class="bi bi-info-circle"></i>
                    Jati Diri
                </span>
                <h1 class="page-hero__title" data-aos="fade-up" data-aos-delay="100">Mengenal<br><span>Cakra Manggala</span>
                </h1>
                <p class="page-hero__lead" data-aos="fade-up" data-aos-delay="200">
                    Wadah pembentukan karakter mahasiswa melalui petualangan dan kepedulian lingkungan yang telah berdiri
                    sejak 2013.
                </p>
            </div>
        </div>
    </section>

    <!-- Identity Section -->
    <section class="section-shell" style="background-color: var(--dark-color); color: #fff; padding-bottom: 2rem;">
        <div class="container text-center">
            <div class="mb-4" data-aos="fade-up">
                <img src="{{ asset('image/logo.png') }}" alt="Logo UKM Cakra Manggala" style="width: 150px; height: auto; filter: drop-shadow(0 0 20px rgba(242,182,97,0.2));">
            </div>
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-8">
                    <span class="section-label" style="color: var(--accent-color); font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em;">Profil Singkat</span>
                    <h2 class="section-heading mt-2" style="color: #fff; font-size: clamp(1.8rem, 4vw, 2.5rem); font-weight: 900; letter-spacing: -0.01em;">UKM Pecinta Alam Politeknik Negeri Madiun</h2>
                    <div style="width: 60px; height: 4px; background: var(--accent-color); margin: 1.5rem auto;"></div>
                    <p class="section-lead" style="color: rgba(255,255,255,0.75); line-height: 1.8; font-size: 1.1rem;">
                        UKM Cakra Manggala merupakan satu-satunya organisasi mahasiswa pecinta alam resmi di Politeknik Negeri Madiun. Organisasi ini didirikan sebagai wadah bagi mahasiswa untuk menyalurkan minat, bakat, serta kepedulian terhadap kelestarian alam bebas, konservasi lingkungan hidup, serta kemanusiaan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Dosen Pembina Section -->
    <section class="section-shell" style="background-color: var(--primary-color); color: #fff; padding-top: 4rem; padding-bottom: 4rem;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label" style="color: var(--accent-color); font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em;">Pilar Pembimbing</span>
                <h2 class="section-heading" style="color: #fff; font-size: 2.25rem; font-weight: 900;">Dosen Pembina</h2>
                <div style="width: 60px; height: 4px; background: var(--accent-color); margin: 1rem auto 0;"></div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="pembina-card">
                        <div class="pembina-card__photo">
                            @if($pembina && $pembina->foto)
                                <img src="{{ asset($pembina->foto) }}" alt="Dosen Pembina Cakra Manggala: {{ $pembina->nama }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('image/profile_kosong.jpg') }}" alt="Dosen Pembina Cakra Manggala" class="img-fluid">
                            @endif
                        </div>
                        <div class="pembina-card__info text-center">
                            <h3 class="pembina-card__name">{{ $pembina ? $pembina->nama : 'M. Syahru Mubarok, S.T., M.T.' }}</h3>
                            <div class="pembina-card__title">{{ $pembina ? $pembina->jabatan : 'Dosen Pembina Utama' }}</div>
                            <div class="pembina-card__prodi">{{ $pembina ? $pembina->prodi_semester : 'Dosen Pengajar Prodi Teknik Elektro' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .pembina-card {
            background: var(--dark-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2.5rem 1.5rem;
            transition: all 0.4s;
        }
        .pembina-card:hover {
            border-color: var(--accent-color);
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.4);
        }
        .pembina-card__photo {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid rgba(255, 255, 255, 0.05);
        }
        .pembina-card:hover .pembina-card__photo {
            border-color: var(--accent-color);
        }
        .pembina-card__photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .pembina-card__name {
            font-size: 1.25rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.25rem;
        }
        .pembina-card__title {
            font-size: 0.75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }
        .pembina-card__prodi {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.4;
        }
    </style>

    <!-- History Section -->
    <section class="section-shell" style="background-color: var(--dark-color); color: #fff;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="position-relative" style="border: 1px solid var(--accent-color); padding: 1rem;">
                        <img src="{{ asset('image/fotobersejarah1.jpg') }}" alt="Foto Bersejarah Pendirian UKM Cakra Manggala Tahun 2013" class="img-fluid"
                            style="filter: grayscale(0.2) contrast(1.1);" loading="lazy">
                        <div class="position-absolute bottom-0 end-0 p-4 bg-accent text-primary fw-800"
                            style="background-color: var(--accent-color); color: var(--primary-color);">
                            EST. 2013
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <span class="section-label" style="color: var(--accent-color);">Latar Belakang</span>
                    <h2 class="section-heading" style="color: #fff; font-size: clamp(2rem, 4vw, 3rem);">Tumbuh dari Semangat
                        Kebersamaan</h2>
                    <div style="width: 60px; height: 4px; background: var(--accent-color); margin-bottom: 2rem;"></div>
                    <p class="section-lead" style="color: rgba(255,255,255,0.7);">
                        Cakra Manggala lahir di Politeknik Negeri Madiun dari sekelompok mahasiswa yang memiliki mimpi
                        besar: menyatukan petualangan dengan tanggung jawab sosial dan lingkungan.
                    </p>
                    <div class="mt-5">
                        <div class="d-flex gap-4 mb-4"
                            style="border-left: 3px solid var(--accent-color); padding-left: 1.5rem;">
                            <div>
                                <h4 class="h5 fw-bold" style="color: var(--accent-color); letter-spacing: 0.05em;">Inisiasi
                                    Awal</h4>
                                <p style="color: rgba(255,255,255,0.6); margin-bottom: 0;">Dimulai dengan nama Gemapala
                                    sebagai awal gerakan di lingkungan kampus.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-4" style="border-left: 3px solid var(--accent-color); padding-left: 1.5rem;">
                            <div>
                                <h4 class="h5 fw-bold" style="color: var(--accent-color); letter-spacing: 0.05em;">
                                    Transformasi 2014</h4>
                                <p style="color: rgba(255,255,255,0.6); margin-bottom: 0;">Resmi menggunakan nama Cakra
                                    Manggala untuk memperkuat identitas organisasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="section-shell" style="background-color: var(--primary-color); color: #fff;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label" style="color: var(--accent-color);">Arah Gerak</span>
                <h2 class="section-heading" style="color: #fff;">Visi & Misi Kami</h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="premium-card p-5"
                        style="background: var(--dark-color); border: 1px solid rgba(255,255,255,0.05); height: 100%;">
                        <div
                            style="width: 50px; height: 50px; background: var(--accent-color); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 2rem;">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                        <h3 class="h2 fw-bold text-white mb-4" style="letter-spacing: -0.02em;">Visi</h3>
                        <p class="mb-0" style="color: rgba(255,255,255,0.7); line-height: 1.8; font-size: 1.1rem;">
                            Menjadi organisasi yang mengembangkan intelektualitas, jasmani, dan rohani serta menumbuhkan
                            kesadaran terhadap alam, sehingga menjadi panutan bagi mahasiswa dan masyarakat.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="premium-card p-5"
                        style="background: var(--dark-color); border: 1px solid rgba(255,255,255,0.05); height: 100%;">
                        <div
                            style="width: 50px; height: 50px; background: var(--accent-color); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 2rem;">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <h3 class="h2 fw-bold text-white mb-4" style="letter-spacing: -0.02em;">Misi</h3>
                        <ul class="list-unstyled d-grid gap-4">
                            <li class="d-flex gap-3">
                                <i class="bi bi-shield-fill-check" style="color: var(--accent-color);"></i>
                                <span style="color: rgba(255,255,255,0.7);">Menyelenggarakan pembinaan karakter yang
                                    disiplin dan bertanggung jawab.</span>
                            </li>
                            <li class="d-flex gap-3">
                                <i class="bi bi-shield-fill-check" style="color: var(--accent-color);"></i>
                                <span style="color: rgba(255,255,255,0.7);">Meningkatkan keterampilan teknis dalam aktivitas
                                    alam bebas.</span>
                            </li>
                            <li class="d-flex gap-3">
                                <i class="bi bi-shield-fill-check" style="color: var(--accent-color);"></i>
                                <span style="color: rgba(255,255,255,0.7);">Melaksanakan aksi nyata dalam pelestarian
                                    lingkungan hidup.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="section-shell" style="background-color: var(--dark-color); color: #fff;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label" style="color: var(--accent-color);">Nilai Luhur</span>
                <h2 class="section-heading" style="color: #fff;">Pilar Karakter</h2>
            </div>
            <div class="row g-4">
                @php
                    $values = [
                        ['icon' => 'bi-shield-shaded', 'title' => 'Integritas', 'desc' => 'Menjunjung tinggi kejujuran dalam setiap tindakan.'],
                        ['icon' => 'bi-lightning-charge-fill', 'title' => 'Ketangguhan', 'desc' => 'Kuat menghadapi tantangan di setiap medan.'],
                        ['icon' => 'bi-people-fill', 'title' => 'Solidaritas', 'desc' => 'Satu rasa, satu jiwa, dalam satu keluarga.'],
                        ['icon' => 'bi-flower1', 'title' => 'Lestari', 'desc' => 'Bertanggung jawab penuh atas kelestarian bumi.'],
                    ];
                @endphp

                @foreach($values as $value)
                    <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="premium-card text-center p-5" style="border: 1px solid rgba(255,255,255,0.05);">
                            <i class="{{ $value['icon'] }} display-5 mb-4" style="color: var(--accent-color);"></i>
                            <h4 class="h5 fw-bold text-white mb-3" style="letter-spacing: 0.1em; text-transform: uppercase;">
                                {{ $value['title'] }}
                            </h4>
                            <p class="mb-0" style="color: rgba(255,255,255,0.5); font-size: 0.9rem;">{{ $value['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection