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

    <!-- History Section -->
    <section class="section-shell" style="background-color: var(--dark-color); color: #fff;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="position-relative" style="border: 1px solid var(--accent-color); padding: 1rem;">
                        <img src="{{ asset('image/fotobersejarah1.jpg') }}" alt="Sejarah" class="img-fluid"
                            style="filter: grayscale(0.2) contrast(1.1);">
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

    <!-- Team Section - Reshuffled to Vertical with Gaps -->
    <section class="section-shell" style="background-color: var(--primary-color); color: #fff; padding-bottom: 15rem;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label" style="color: var(--accent-color);">Organisasi</span>
                <h2 class="section-heading" style="color: #fff;">Pengurus Inti</h2>
                <p class="section-lead mx-auto" style="color: rgba(255,255,255,0.6);">
                    Dedikasi pengurus Cakra Manggala periode aktif.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="officer-stack">
                        @foreach($penguruses as $pengurus)
                            <div class="officer-horizontal-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                <div class="oh-card__inner">
                                    <div class="oh-card__photo">
                                        @if($pengurus->foto)
                                            <img src="{{ asset($pengurus->foto) }}" alt="{{ $pengurus->nama }}">
                                        @else
                                            <div class="oh-card__placeholder">
                                                {{ strtoupper(substr($pengurus->nama, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="oh-card__content">
                                        <div class="oh-card__header">
                                            <span class="oh-card__position">{{ strtoupper($pengurus->jabatan) }}</span>
                                            <h3 class="oh-card__name">{{ $pengurus->nama }}</h3>
                                            @if($pengurus->prodi_semester)
                                                <p class="x-small text-accent mt-1 mb-0 fw-bold">
                                                    {{ strtoupper($pengurus->prodi_semester) }}</p>
                                            @endif
                                        </div>
                                        <div class="oh-card__footer">
                                            <div class="d-flex align-items-center gap-3">
                                                <div style="width: 30px; height: 1px; background: rgba(255,255,255,0.2);"></div>
                                                <span class="x-small text-white-50 fw-bold">PENGURUS AKTIF</span>
                                            </div>
                                            @if($pengurus->instagram_url)
                                                <a href="{{ $pengurus->instagram_url }}" target="_blank" class="oh-card__social"><i
                                                        class="bi bi-instagram"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .officer-stack {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            /* Memberikan gap antar card sesuai permintaan */
        }

        .officer-horizontal-card {
            background: var(--dark-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .officer-horizontal-card:hover {
            border-color: var(--accent-color);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .oh-card__inner {
            display: flex;
            align-items: stretch;
            min-height: 140px;
        }

        .oh-card__photo {
            width: 140px;
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.03);
            overflow: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .oh-card__photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }

        .officer-horizontal-card:hover .oh-card__photo img {
            transform: scale(1.1);
        }

        .oh-card__placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 900;
            color: var(--accent-color);
            background: var(--primary-color);
        }

        .oh-card__content {
            flex-grow: 1;
            padding: 2rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .oh-card__position {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.2em;
            color: var(--accent-color);
            display: block;
            margin-bottom: 0.5rem;
        }

        .oh-card__name {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            margin: 0;
            letter-spacing: -0.01em;
        }

        .oh-card__footer {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .oh-card__social {
            color: rgba(255, 255, 255, 0.3);
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        .oh-card__social:hover {
            color: var(--accent-color);
        }

        @media (max-width: 768px) {
            .oh-card__inner {
                flex-direction: column;
            }

            .oh-card__photo {
                width: 100%;
                height: 200px;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .oh-card__content {
                padding: 1.5rem;
            }
        }
    </style>
@endsection