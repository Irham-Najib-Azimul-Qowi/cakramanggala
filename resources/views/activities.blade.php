@extends('layouts.app')

@section('title', 'Kegiatan - UKM Cakra Manggala')

@section('content')
    @php
        $heroImage = asset('image/fotobersejarah2.jpg');
    @endphp

    <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
        <div class="container">
            <div class="page-hero__inner">
                <span class="page-hero__eyebrow" data-aos="fade-up">
                    <i class="bi bi-calendar-event"></i>
                    Rekam Jejak
                </span>
                <h1 class="page-hero__title" data-aos="fade-up" data-aos-delay="100">Galeri Aktivitas</h1>
                <p class="page-hero__lead" data-aos="fade-up" data-aos-delay="200">
                    Dokumentasi kegiatan lapangan, latihan rutin, dan aksi keberlanjutan yang telah kami lalui.
                </p>
            </div>
        </div>
    </section>

    <section class="section-shell" style="background-color: var(--dark-color); color: #fff; min-height: 80vh;">
        <div class="container">
            <!-- Search -->
            <div class="row justify-content-center mb-5" data-aos="fade-up">
                <div class="col-lg-7">
                    <form method="GET" action="{{ route('activities') }}">
                        <div class="input-group input-group-lg"
                            style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.03);">
                            <span class="input-group-text bg-transparent border-0 ps-4">
                                <i class="bi bi-search" style="color: var(--accent-color);"></i>
                            </span>
                            <input type="text" name="search"
                                class="form-control bg-transparent border-0 text-white py-3 shadow-none"
                                value="{{ request('search') }}" placeholder="Cari tempat atau nama kegiatan..."
                                style="font-size: 1.1rem; letter-spacing: 0.02em;">
                            <button class="btn px-4" type="submit"
                                style="background: var(--accent-color); color: var(--primary-color); border-radius: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.85rem;">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Filters -->
            <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-10">
                    <form method="GET" action="{{ route('activities') }}" class="row g-3">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <div class="col-md-5">
                            <select name="tahun" class="form-select bg-transparent text-white border-0 py-3 rounded-0"
                                style="background-color: rgba(255,255,255,0.03) !important; border: 1px solid rgba(255,255,255,0.1) !important;"
                                onchange="this.form.submit()">
                                <option value="">Semua Tahun</option>
                                @foreach(range(date('Y'), 2020) as $year)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select name="sifat" class="form-select bg-transparent text-white border-0 py-3 rounded-0"
                                style="background-color: rgba(255,255,255,0.03) !important; border: 1px solid rgba(255,255,255,0.1) !important;"
                                onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                <option value="umum" {{ request('sifat') == 'umum' ? 'selected' : '' }}>Umum</option>
                                <option value="gunung_hutan" {{ request('sifat') == 'gunung_hutan' ? 'selected' : '' }}>Gunung Hutan</option>
                                <option value="panjat_tebing" {{ request('sifat') == 'panjat_tebing' ? 'selected' : '' }}>Panjat Tebing</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('activities') }}" class="btn btn-outline-light w-100 py-3 rounded-0 border-0"
                                style="background: rgba(255,255,255,0.05); font-size: 0.8rem; font-weight: 700;">RESET</a>
                        </div>
                    </form>
                </div>
            </div>

            @if(isset($kegiatans) && $kegiatans->count() > 0)
                <div class="row g-3 card-grid-2col">
                    @foreach($kegiatans as $kegiatan)
                        <div class="col-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                            <a href="{{ route('activities.show', $kegiatan->id) }}" class="text-decoration-none">
                                <article class="doc-card" style="height: 440px;">
                                    <div class="doc-card__img-container">
                                        @if($kegiatan->gambar_utama)
                                            <img src="{{ asset($kegiatan->gambar_utama) }}" alt="Dokumentasi Kegiatan: {{ $kegiatan->judul_kegiatan }} di {{ $kegiatan->tempat }}" class="doc-card__img" loading="lazy">
                                        @else
                                            <div class="doc-card__img-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a4331 0%, #07110c 100%); display: flex; align-items: center; justify-content: center; position: absolute; inset: 0;">
                                                <i class="bi bi-calendar3" style="font-size: 4rem; color: var(--accent-color); opacity: 0.5;"></i>
                                            </div>
                                        @endif
                                        <div class="doc-card__overlay"></div>
                                    </div>
                                    <div class="doc-card__content" style="padding: 2rem;">
                                        <span class="doc-card__tag"
                                            style="background: var(--accent-color); color: var(--primary-color); font-size: 0.6rem;">{{ str_replace('_', ' ', $kegiatan->sifat) }}</span>
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
                        style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 0; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                        <i class="bi bi-calendar-x display-3" style="color: rgba(255,255,255,0.15);"></i>
                    </div>
                    <h3 class="fw-bold" style="color: #fff;">Kegiatan Tidak Ditemukan</h3>
                    <p style="color: rgba(255,255,255,0.5);">Cari kegiatan lain atau reset filter untuk melihat semua arsip.</p>
                    <a href="{{ route('activities') }}" class="btn-join-premium mt-4"
                        style="padding: 0.8rem 2.5rem; font-size: 0.85rem;">Tampilkan Semua</a>
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

        @media (max-width: 575px) {
            .doc-card {
                height: 260px !important;
            }

            .doc-card__content {
                padding: 1rem !important;
            }

            .doc-card__title {
                font-size: 0.82rem !important;
                line-height: 1.2;
                margin-bottom: 0.4rem;
            }

            .doc-card__tag {
                font-size: 0.5rem !important;
                padding: 0.25rem 0.5rem;
                margin-bottom: 0.5rem;
            }

            .doc-card__date {
                font-size: 0.58rem !important;
                margin-bottom: 0.25rem;
            }

            .doc-card__excerpt,
            .doc-card__link {
                display: none !important;
            }
        }
    </style>
@endsection