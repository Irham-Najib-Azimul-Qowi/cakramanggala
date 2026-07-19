@extends('layouts.app')

@section('title', 'Beranda - UKM Cakra Manggala')
@section('body_class', 'page-home')

@push('styles')
    <style>
        .home-hero {
            min-height: 100svh !important;
            padding-top: 12rem !important;
            padding-bottom: clamp(4rem, 7vw, 7.5rem) !important;
            display: flex !important;
            align-items: flex-end !important;
        }

        .home-hero .page-hero__title {
            font-size: clamp(3rem, 9.5vw, 5.4rem);
            line-height: 0.92;
            margin-bottom: 1.5rem;
        }

        .section-label {
            display: block;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            font-size: 0.85rem;
        }

        /* Documentary Activity Card */
        .doc-card {
            position: relative;
            background: var(--dark-color);
            height: 480px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .doc-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent-color);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
        }

        .doc-card__img-container {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .doc-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: saturate(0.8) brightness(0.7);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .doc-card:hover .doc-card__img {
            transform: scale(1.1);
            filter: saturate(1.1) brightness(0.6);
        }

        .doc-card__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(7, 17, 12, 1) 0%,
                    rgba(7, 17, 12, 0.4) 50%,
                    transparent 100%);
            z-index: 2;
        }

        .doc-card__content {
            position: relative;
            z-index: 3;
            padding: 2.5rem;
            transition: transform 0.5s ease;
        }

        .doc-card:hover .doc-card__content {
            transform: translateY(-5px);
        }

        .doc-card__tag {
            display: inline-block;
            background: var(--accent-color);
            color: var(--primary-color);
            padding: 0.4rem 1rem;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 1.2rem;
        }

        .doc-card__date {
            display: block;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: 0.05em;
        }

        .doc-card__title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1.2;
            color: #fff;
            margin-bottom: 1rem;
            letter-spacing: -0.01em;
        }

        .doc-card__excerpt {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            line-height: 1.6;
            height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .doc-card:hover .doc-card__excerpt {
            height: auto;
            opacity: 1;
            margin-bottom: 1.5rem;
        }

        .doc-card__link {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--accent-color);
            text-decoration: none !important;
            font-weight: 800;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.4s ease;
        }

        .doc-card:hover .doc-card__link {
            opacity: 1;
            transform: translateX(0);
        }

        /* Article Card (Sleek Perspective) */
        .art-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s ease;
            height: 100%;
        }

        .art-card:hover {
            border-color: var(--accent-color);
            transform: translateY(-8px);
        }

        .art-card__img-wrap {
            height: 240px;
            overflow: hidden;
            position: relative;
        }

        .art-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .art-card:hover .art-card__img {
            transform: scale(1.1);
        }

        .art-card__body {
            padding: 2.2rem;
        }

        .join-cta-card {
            background: linear-gradient(135deg, #1a4331 0%, #123124 100%);
            border-radius: 0;
            padding: 6rem 3rem;
            position: relative;
            overflow: hidden;
            color: #fff;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .join-cta-card::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(242, 182, 97, 0.1), transparent 70%);
            z-index: 1;
        }

        .join-cta-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .join-cta-desc {
            font-size: 1.1rem;
            opacity: 0.8;
            max-width: 700px;
            margin: 0 auto 3rem;
            position: relative;
            z-index: 2;
        }

        .btn-join-premium {
            background: var(--accent-color);
            color: var(--primary-color);
            padding: 1.2rem 3rem;
            border-radius: 0;
            font-weight: 800;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-join-premium:hover {
            transform: scale(1.05);
            background: #fff;
            color: var(--primary-color);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .home-hero.is-video-ready .home-hero__video {
            opacity: 1 !important;
        }

        /* Division Card */
        .division-card {
            position: relative;
            display: block;
            height: 480px;
            overflow: hidden;
            background: linear-gradient(145deg, #f2b661 0%, #d9a050 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-decoration: none;
            color: var(--primary-color);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .division-card:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .division-card__bg {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .division-card__bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            filter: saturate(1) brightness(0.8);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .division-card:hover .division-card__bg img {
            opacity: 1;
            transform: scale(1.05);
            filter: saturate(1.2) brightness(0.75);
        }

        .division-card__overlay {
            position: absolute;
            inset: 0;
            background: transparent;
            z-index: 2;
            transition: background 0.5s ease;
        }

        .division-card:hover .division-card__overlay {
            background: linear-gradient(to top,
                    rgba(7, 17, 12, 0.7) 0%,
                    rgba(7, 17, 12, 0.25) 50%,
                    transparent 100%);
        }

        .division-card__icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -60%);
            z-index: 3;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid rgba(26, 67, 49, 0.4);
            background: rgba(26, 67, 49, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .division-card__icon i {
            font-size: 2rem;
            color: var(--primary-color);
            transition: all 0.5s ease;
        }

        .division-card:hover .division-card__icon {
            transform: translate(-50%, -70%) scale(0.85);
            opacity: 0.6;
            border-color: rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.05);
        }

        .division-card__content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 3;
            padding: 2.5rem;
            text-align: center;
            transition: transform 0.5s ease;
        }

        .division-card:hover .division-card__content {
            transform: translateY(-5px);
        }

        .division-card__title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .division-card__link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--accent-color);
            opacity: 0;
            transform: translateY(8px);
            transition: all 0.4s ease;
        }

        .division-card:hover .division-card__link {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="page-hero home-hero" id="homeHero" data-hero-video>
        <div class="page-hero__media" aria-hidden="true">
            <div class="page-hero__fallback"
                style="background-image: url('{{ !empty($settings['hero_image']) ? asset($settings['hero_image']) : asset('image/fotobersejarah2.jpg') }}'); position: absolute; inset: -4%; background-size: cover; background-position: center; filter: saturate(0.9) contrast(1.1); transform: scale(1.05);">
            </div>
            <video class="home-hero__video" autoplay muted loop playsinline preload="metadata"
                poster="{{ !empty($settings['hero_image']) ? asset($settings['hero_image']) : asset('image/fotobersejarah2.jpg') }}"
                style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center bottom; opacity: 0; transition: opacity 1s ease-in-out;">
                <source src="{{ !empty($settings['hero_video']) ? asset($settings['hero_video']) : asset('videos/cinematic.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="container">
            <div class="page-hero__inner text-center mx-auto">
                <h1 class="page-hero__title" data-aos="fade-up" data-aos-delay="100">
                    {!! $settings['hero_title'] ?? 'Mendaki Tinggi,<br><span>Menjaga Bumi</span>' !!}
                </h1>
                <p class="page-hero__lead mx-auto" data-aos="fade-up" data-aos-delay="200">
                    {{ $settings['hero_description'] ?? 'Wadah pembentukan karakter melalui alam bebas untuk mereka yang berani melangkah lebih jauh.' }}
                </p>
                <div class="mt-5" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('join') }}" class="btn-join-premium">
                        Mulai Petualangan
                    </a>
                    {{-- <i class="bi bi-arrow-right"></i> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Division Section -->
    <section class="section-shell" style="background-color: var(--dark-color); color: #fff; padding-bottom: 0;">
        <div class="container">
            <!-- <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up"> -->
            <div class="d-flex justify-content-center text-center align-items-end mb-5" data-aos="fade-up">
                <div>
                    <!-- <span class="section-label" style="color: var(--accent-color);">Divisi & Aktivitas</span> -->
                    <h2 class="section-heading mb-0" style="color: #fff;">Divisi Kami</h2>
                </div>
            </div>

            <div class="row justify-content-evenly mobile-horizontal-scroll">
                <!-- Card 1: Gunung Hutan -->
                <div class="col-12 col-md-5 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('activities.gunung-hutan') }}" class="division-card">
                        <div class="division-card__bg">
                            @if($latest_gunung_hutan && $latest_gunung_hutan->gambar_utama)
                                <img src="{{ asset($latest_gunung_hutan->gambar_utama) }}" alt="Aktivitas Gunung Hutan" loading="lazy">
                            @endif
                        </div>
                        <div class="division-card__overlay"></div>
                        <div class="division-card__icon">
                            <i class="bi bi-compass"></i>
                        </div>
                        <div class="division-card__content">
                            <h3 class="division-card__title">GUNUNG HUTAN</h3>
                            <span class="division-card__link">
                                Lihat Aktivitas <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Card 2: Panjat Tebing -->
                <div class="col-12 col-md-5 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('activities.panjat-tebing') }}" class="division-card">
                        <div class="division-card__bg">
                            @if($latest_panjat_tebing && $latest_panjat_tebing->gambar_utama)
                                <img src="{{ asset($latest_panjat_tebing->gambar_utama) }}" alt="Aktivitas Panjat Tebing" loading="lazy">
                            @endif
                        </div>
                        <div class="division-card__overlay"></div>
                        <div class="division-card__icon">
                            <i class="bi bi-signpost-split"></i>
                        </div>
                        <div class="division-card__content">
                            <h3 class="division-card__title">PANJAT TEBING</h3>
                            <span class="division-card__link">
                                Lihat Aktivitas <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Activities Section - New Documentary Style -->
    <section class="section-shell" style="background-color: var(--dark-color); color: #fff;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
                <div>
                    <span class="section-label" style="color: var(--accent-color);">Dokumentasi</span>
                    <h2 class="section-heading mb-0" style="color: #fff;">Agenda & Kegiatan</h2>
                </div>
                <a href="{{ route('activities') }}" class="btn-premium-link d-none d-md-inline-flex">Lihat Semua <i
                        class="bi bi-arrow-right"></i></a>
            </div>

            <div class="row g-4 mobile-horizontal-scroll">
                @forelse($kegiatans as $kegiatan)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <article class="doc-card">
                            <div class="doc-card__img-container">
                                @if($kegiatan->gambar_utama)
                                    <img src="{{ asset($kegiatan->gambar_utama) }}" alt="Kegiatan UKM Cakra Manggala: {{ $kegiatan->judul_kegiatan }}" class="doc-card__img" loading="lazy">
                                @else
                                    <div class="doc-card__img-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a4331 0%, #07110c 100%); display: flex; align-items: center; justify-content: center; position: absolute; inset: 0;">
                                        <i class="bi bi-calendar3" style="font-size: 4rem; color: var(--accent-color); opacity: 0.5;"></i>
                                    </div>
                                @endif
                                <div class="doc-card__overlay"></div>
                            </div>
                            <div class="doc-card__content">
                                <span class="doc-card__tag">{{ $kegiatan->sifat }}</span>
                                <span class="doc-card__date">{{ $kegiatan->tanggal_pelaksanaan->format('d M Y') }} —
                                    {{ $kegiatan->tempat }}</span>
                                <h3 class="doc-card__title">{{ $kegiatan->judul_kegiatan }}</h3>
                                <div class="doc-card__excerpt">
                                    {{ Str::limit($kegiatan->materi, 120) }}
                                </div>
                                <a href="{{ route('activities') }}" class="doc-card__link">
                                    Buka Detail <i class="bi bi-plus-lg"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-white-50">Belum ada data kegiatan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Latest Articles Section - Refined Card -->
    <section class="section-shell" style="background-color: var(--primary-color); color: #fff;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label" style="color: var(--accent-color);">Literasi</span>
                <h2 class="section-heading" style="color: #fff;">Artikel</h2>
                <div class="mx-auto mt-3" style="width: 80px; height: 1px; background: rgba(255,255,255,0.2);"></div>
            </div>

            <div class="row g-4 mobile-horizontal-scroll">
                @forelse($artikels as $artikel)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="art-card">
                            <div class="art-card__img-wrap">
                                @if($artikel->gambar_utama)
                                    <img src="{{ asset($artikel->gambar_utama) }}" alt="Artikel Cakra Manggala: {{ $artikel->judul }}" class="art-card__img" loading="lazy">
                                @else
                                    <div class="art-card__img-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a4331 0%, #07110c 100%); display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-book" style="font-size: 3.5rem; color: var(--accent-color); opacity: 0.5;"></i>
                                    </div>
                                @endif
                                <span class="position-absolute top-0 end-0 bg-accent text-primary px-3 py-1 fw-bold x-small"
                                    style="background: var(--accent-color); color: var(--primary-color); z-index: 5;">
                                    ARTIKEL
                                </span>
                            </div>
                            <div class="art-card__body">
                                <div class="premium-card__meta mb-3">
                                    <span><i class="bi bi-person me-2"></i>{{ $artikel->user->name }}</span>
                                    <span class="ms-3"><i class="bi bi-eye me-2"></i>{{ number_format($artikel->views) }}</span>
                                </div>
                                <h3 class="premium-card__title">{{ $artikel->judul }}</h3>
                                <p class="premium-card__text">
                                    {{ $artikel->excerpt ?: Str::limit(strip_tags($artikel->konten), 100) }}
                                </p>
                                <div class="mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                                    <a href="{{ route('artikel.show', $artikel->slug) }}" class="btn-premium-link">Baca
                                        Selengkapnya <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-white-50">Belum ada artikel terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Join CTA Section -->
    <section class="section-shell" style="background-color: var(--dark-color); padding: 0;">
        <div class="join-cta-card"
            style="border: none; padding: 10rem 2rem; background: linear-gradient(rgba(7, 17, 12, 0.85), rgba(7, 17, 12, 0.85)), url('{{ asset('image/fotobersejarah2.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
            <div class="container">
                <div data-aos="fade-up">
                    <span class="section-label" style="color: var(--accent-color); margin-bottom: 2rem;">Kesempatan
                        Bergabung</span>
                    <h2 class="join-cta-title"
                        style="font-size: clamp(2.5rem, 7vw, 4.5rem); line-height: 1.1; margin-bottom: 2.5rem;">Terlahir
                        untuk<br><span style="color: var(--accent-color);">Menjadi Legenda</span></h2>
                    <p class="join-cta-desc" style="font-size: 1.25rem; color: rgba(255,255,255,0.7); margin-bottom: 4rem;">
                        Jadilah bagian dari Cakra Manggala. Tempa mental, fisik, dan karaktermu dalam dekapan
                        alam.
                    </p>
                    <a href="{{ route('join') }}" class="btn-join-premium" style="font-size: 1rem; padding: 1.5rem 4rem;">
                        Gabung Sekarang <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (() => {
            const hero = document.querySelector('[data-hero-video]');
            const video = hero?.querySelector('video');

            if (!hero || !video) return;

            const revealVideo = () => hero.classList.add('is-video-ready');
            video.addEventListener('playing', revealVideo, { once: true });
            video.play().then(revealVideo).catch(() => hero.classList.add('is-video-fallback'));
        })();
    </script>
@endpush
