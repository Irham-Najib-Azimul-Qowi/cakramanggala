@extends('layouts.app')

@section('title', 'Sejarah - UKM Cakra Manggala')

@section('content')
    @php
        $heroImage = asset('image/fotobersejarah3.jpg');
    @endphp

    <div class="page-wrapper" style="background-color: var(--dark-color); color: #fff;">
        <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
            <div class="container">
                <div class="page-hero__inner">
                    <span class="page-hero__eyebrow" data-aos="fade-up">
                        <i class="bi bi-clock-history"></i>
                        Lintas Waktu
                    </span>
                    <h1 class="page-hero__title" data-aos="fade-up" data-aos-delay="100">Sejarah<br><span>Cakra Manggala</span></h1>
                    <p class="page-hero__lead" data-aos="fade-up" data-aos-delay="200">
                        Menapaki rekam jejak, perjuangan, dan komitmen pelestarian lingkungan sejak awal berdirinya organisasi.
                    </p>
                </div>
            </div>
        </section>

        <!-- Awal Mula Section -->
        <section class="section-shell" style="background-color: var(--dark-color); padding-bottom: 4rem;">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="position-relative" style="border: 1px solid var(--accent-color); padding: 1rem;">
                            <img src="{{ asset('image/fotobersejarah1.jpg') }}" alt="Awal Pendirian UKM Cakra Manggala" class="img-fluid"
                                style="filter: grayscale(0.2) contrast(1.1); width: 100%; object-fit: cover; height: 350px;" loading="lazy">
                            <div class="position-absolute bottom-0 end-0 p-4 bg-accent text-primary fw-800"
                                style="background-color: var(--accent-color); color: var(--primary-color);">
                                SEJAK 2013
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <span class="section-label" style="color: var(--accent-color); font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">Titik Awal</span>
                        <h2 class="section-heading mb-4" style="color: #fff; font-size: clamp(2rem, 4vw, 3rem); font-weight: 900;">Bagaimana Semua Dimulai</h2>
                        <div style="width: 60px; height: 4px; background: var(--accent-color); margin-bottom: 2rem;"></div>
                        <p class="section-lead" style="color: rgba(255,255,255,0.7); line-height: 1.8;">
                            Lahir dari kesamaan visi dan kecintaan yang mendalam terhadap alam bebas, UKM Cakra Manggala diinisiasi oleh sekelompok mahasiswa Politeknik Negeri Madiun pada tahun 2013. Awalnya, gerakan ini beroperasi dalam skala komunitas kecil yang fokus pada petualangan dan kepedulian lingkungan internal kampus.
                        </p>
                        <p style="color: rgba(255,255,255,0.5); line-height: 1.8;">
                            Melalui dedikasi tanpa batas, komitmen yang kuat, serta dukungan dari civitas akademika, komunitas ini bertransformasi menjadi Unit Kegiatan Mahasiswa resmi guna mencetak generasi mahasiswa yang berkarakter, mandiri, tangguh, dan peduli terhadap kelestarian alam nusantara.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Timeline Section -->
        <section class="section-shell" style="background-color: var(--primary-color); padding-top: 6rem; padding-bottom: 8rem;">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <span class="section-label" style="color: var(--accent-color); font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em;">Kronologi</span>
                    <h2 class="section-heading" style="color: #fff; font-size: 2.5rem; font-weight: 900;">Milestones Perjalanan</h2>
                    <p class="section-lead mx-auto text-white-50" style="max-width: 600px;">
                        Garis waktu perkembangan UKM Cakra Manggala dari masa ke masa.
                    </p>
                </div>

                <div class="timeline-container">
                    @php
                        $milestones = [
                            [
                                'year' => '2013',
                                'title' => 'Inisiasi Awal (Gemapala)',
                                'desc' => 'Deklarasi pembentukan komunitas pecinta alam pertama di lingkungan Politeknik Negeri Madiun oleh para pendahulu, sebagai embrio lahirnya gerakan konservasi mahasiswa.',
                                'image' => asset('image/fotobersejarah1.jpg')
                            ],
                            [
                                'year' => '2014',
                                'title' => 'Transformasi Nama & Identitas',
                                'desc' => 'Pengesahan dan perubahan nama resmi menjadi Cakra Manggala. Nama ini dipilih untuk mencerminkan ketangguhan, persaudaraan, dan komitmen menjaga keharmonisan alam.',
                                'image' => asset('image/fotobersejarah2.jpg')
                            ],
                            [
                                'year' => '2015 - 2020',
                                'title' => 'Peresmian UKM & Ekspansi Kegiatan',
                                'desc' => 'Diterima secara resmi sebagai Unit Kegiatan Mahasiswa (UKM) di bawah naungan kampus. Cakra Manggala mulai aktif menyelenggarakan Pendidikan Dasar (Diksar) dan ekspedisi gunung hutan skala nasional.',
                                'image' => asset('image/fotobersejarah3.jpg')
                            ],
                            [
                                'year' => '2021 - Sekarang',
                                'title' => 'Konservasi Modern & Digitalisasi',
                                'desc' => 'Penerapan teknologi dalam kegiatan pelestarian, pemetaan jalur pendakian digital, tanggap bencana sosial, serta kolaborasi konservasi alam berkelanjutan di berbagai daerah Jawa Timur.',
                                'image' => asset('image/img1.jpeg')
                            ]
                        ];
                    @endphp

                    <div class="timeline">
                        @foreach($milestones as $index => $item)
                            <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <div class="timeline-content">
                                    <div class="timeline-year">{{ $item['year'] }}</div>
                                    <h3 class="timeline-title">{{ $item['title'] }}</h3>
                                    <p class="timeline-desc">{{ $item['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        .timeline-container {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        /* Garis tengah */
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 2px;
            background-color: rgba(255, 255, 255, 0.1);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1px;
        }

        .timeline {
            position: relative;
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        /* Lingkaran penanda */
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            right: -8px;
            background-color: var(--accent-color);
            border: 4px solid var(--primary-color);
            top: 25px;
            border-radius: 50%;
            z-index: 1;
            transition: all 0.3s;
        }

        .timeline-item.right::after {
            left: -8px;
        }

        .timeline-item.left {
            left: 0;
            text-align: right;
        }

        .timeline-item.right {
            left: 50%;
            text-align: left;
        }

        .timeline-content {
            padding: 2.5rem;
            background: var(--dark-color);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s;
        }

        .timeline-item:hover .timeline-content {
            border-color: var(--accent-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .timeline-item:hover::after {
            transform: scale(1.3);
            background-color: #fff;
        }

        .timeline-year {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--accent-color);
            margin-bottom: 0.5rem;
            font-family: 'Montserrat', sans-serif;
        }

        .timeline-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 1rem;
        }

        .timeline-desc {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        @media screen and (max-width: 768px) {
            .timeline-container::after {
                left: 31px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
                text-align: left !important;
            }

            .timeline-item.right {
                left: 0%;
            }

            .timeline-item::after {
                left: 23px !important;
                right: auto;
            }

            .timeline-content {
                padding: 1.5rem;
            }
        }
    </style>
@endsection
