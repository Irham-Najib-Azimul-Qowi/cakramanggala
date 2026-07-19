@extends('layouts.app')

@section('title', 'Panjat Tebing - UKM Cakra Manggala')

@section('content')
    <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
        <div class="container">
            <div class="page-hero__inner">
                <span class="page-hero__eyebrow" data-aos="fade-up">
                    <i class="bi bi-hazard"></i>
                    Divisi Panjat Tebing
                </span>
                <h1 class="page-hero__title" data-aos="fade-up" data-aos-delay="100">Aktivitas Panjat Tebing</h1>
                <p class="page-hero__lead" data-aos="fade-up" data-aos-delay="200">
                    Menantang gravitasi di tebing alam maupun buatan, menguasai teknik pemanjatan, tali-temali, serta mengutamakan keselamatan tingkat tinggi.
                </p>
            </div>
        </div>
    </section>

    <section class="section-shell" style="background-color: var(--dark-color); color: #fff; min-height: 80vh;">
        <div class="container">
            <!-- Search & Filter -->
            <div class="row justify-content-center mb-5" data-aos="fade-up" style="position: relative; z-index: 1050;">
                <div class="col-lg-10">
                    <div class="mb-5">
                        <form method="GET" action="{{ route('activities.panjat-tebing') }}" class="row g-3">
                            <div class="col-md-7">
                                <div class="cm-filter-group">
                                    <i class="bi bi-search cm-filter-icon"></i>
                                    <input type="text" name="search" class="cm-filter-control"
                                        value="{{ request('search') }}" placeholder="Cari kegiatan panjat tebing..."
                                        onchange="this.form.submit()">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="cm-dropdown" data-auto-submit="true">
                                    <button type="button" class="cm-dropdown-toggle">
                                        <div class="cm-dropdown-left">
                                            <i class="bi bi-calendar3 cm-filter-icon"></i>
                                            <span class="cm-dropdown-label">{{ request('tahun') ? 'Tahun ' . request('tahun') : 'Semua Tahun' }}</span>
                                        </div>
                                        <i class="bi bi-chevron-down cm-dropdown-arrow"></i>
                                    </button>
                                    <div class="cm-dropdown-menu">
                                        <div class="cm-dropdown-item {{ !request('tahun') ? 'selected' : '' }}" data-value="">
                                            <span>Semua Tahun</span>
                                            <i class="bi bi-check2 cm-check-icon"></i>
                                        </div>
                                        @foreach(range(date('Y'), 2020) as $year)
                                            <div class="cm-dropdown-item {{ request('tahun') == $year ? 'selected' : '' }}" data-value="{{ $year }}">
                                                <span>Tahun {{ $year }}</span>
                                                <i class="bi bi-check2 cm-check-icon"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                                </div>
                            </div>
                        </form>
                        @if(request('search') || request('tahun'))
                            <div class="cm-active-filters">
                                <span class="cm-active-filters__label">Filter Aktif:</span>
                                @if(request('search'))
                                    <span class="cm-filter-chip">
                                        Kata Kunci: "{{ request('search') }}"
                                        <a href="{{ route('activities.panjat-tebing', request()->except('search')) }}"><i class="bi bi-x-lg"></i></a>
                                    </span>
                                @endif
                                @if(request('tahun'))
                                    <span class="cm-filter-chip">
                                        Tahun: {{ request('tahun') }}
                                        <a href="{{ route('activities.panjat-tebing', request()->except('tahun')) }}"><i class="bi bi-x-lg"></i></a>
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if(isset($kegiatans) && $kegiatans->count() > 0)
                <div class="row g-4 mobile-horizontal-scroll">
                    @foreach($kegiatans as $kegiatan)
                        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                            <a href="{{ route('activities.show', $kegiatan->id) }}" class="text-decoration-none">
                                <article class="doc-card" style="height: 440px;">
                                    <div class="doc-card__img-container">
                                        @if($kegiatan->gambar_utama)
                                            <img src="{{ asset($kegiatan->gambar_utama) }}" alt="Dokumentasi: {{ $kegiatan->judul_kegiatan }} di {{ $kegiatan->tempat }}" class="doc-card__img" loading="lazy">
                                        @else
                                            <div class="doc-card__img-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a4331 0%, #07110c 100%); display: flex; align-items: center; justify-content: center; position: absolute; inset: 0;">
                                                <i class="bi bi-activity" style="font-size: 4rem; color: var(--accent-color); opacity: 0.5;"></i>
                                            </div>
                                        @endif
                                        <div class="doc-card__overlay"></div>
                                    </div>
                                    <div class="doc-card__content" style="padding: 2rem;">
                                        <span class="doc-card__tag"
                                            style="background: var(--accent-color); color: var(--primary-color); font-size: 0.6rem;">Panjat Tebing</span>
                                        <span class="doc-card__date"
                                            style="font-size: 0.7rem;">{{ $kegiatan->tanggal_pelaksanaan->translatedFormat('d M Y') }}</span>
                                        <h3 class="doc-card__title" style="font-size: 1.4rem;">{{ $kegiatan->judul_kegiatan }}</h3>
                                        <p class="x-small text-white-50 mb-0"><i
                                                class="bi bi-geo-alt-fill text-accent me-2"></i>{{ $kegiatan->tempat }}</p>
                                        <div class="doc-card__excerpt" style="font-size: 0.85rem;">
                                            {{ Str::limit($kegiatan->deskripsi ?: $kegiatan->materi, 100) }}
                                        </div>
                                        <span class="doc-card__link mt-3">Detail <i class="bi bi-arrow-right"></i></span>
                                    </div>
                                </article>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5" data-aos="fade-up">
                    <div
                        style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                        <i class="bi bi-activity display-3" style="color: rgba(255,255,255,0.15);"></i>
                    </div>
                    <h3 class="fw-bold" style="color: #fff;">Belum Ada Kegiatan</h3>
                    <p style="color: rgba(255,255,255,0.5);">Kegiatan kategori Panjat Tebing tidak ditemukan.</p>
                    <a href="{{ route('activities.panjat-tebing') }}" class="btn btn-outline-light rounded-0 px-4 py-2 mt-3"
                        style="font-size: 0.85rem; border-color: rgba(255,255,255,0.2);">Reset Pencarian</a>
                </div>
            @endif
        </div>
    </section>

    <style>
        .doc-card {
            position: relative;
            background: var(--dark-color);
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
            transition: transform 0.5s ease;
        }

        .doc-card:hover .doc-card__content {
            transform: translateY(-5px);
        }

        .doc-card__tag {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 1rem;
        }

        .doc-card__date {
            display: block;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 700;
            margin-bottom: 0.35rem;
            letter-spacing: 0.05em;
        }

        .doc-card__title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            line-height: 1.25;
            color: #fff;
            margin-bottom: 0.75rem;
        }

        .doc-card__excerpt {
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.6;
            height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .doc-card:hover .doc-card__excerpt {
            height: auto;
            opacity: 1;
            margin-top: 1rem;
        }

        .doc-card__link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--accent-color);
            font-weight: 800;
            font-size: 0.75rem;
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
    </style>
@endsection
