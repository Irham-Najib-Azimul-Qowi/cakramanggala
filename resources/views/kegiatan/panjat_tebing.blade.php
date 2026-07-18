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
            <div class="row justify-content-center mb-5" data-aos="fade-up">
                <div class="col-lg-10">
                    <form method="GET" action="{{ route('activities.panjat-tebing') }}" class="row g-3 justify-content-center">
                        <div class="col-md-6">
                            <div class="input-group" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.03);">
                                <span class="input-group-text bg-transparent border-0 ps-3">
                                    <i class="bi bi-search" style="color: var(--accent-color);"></i>
                                </span>
                                <input type="text" name="search"
                                    class="form-control bg-transparent border-0 text-white py-3 shadow-none"
                                    value="{{ request('search') }}" placeholder="Cari kegiatan panjat tebing..."
                                    style="font-size: 1rem; letter-spacing: 0.02em;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="tahun" class="form-select bg-transparent text-white border-0 py-3 rounded-0"
                                style="background-color: rgba(255,255,255,0.03) !important; border: 1px solid rgba(255,255,255,0.1) !important;"
                                onchange="this.form.submit()">
                                <option value="">Semua Tahun</option>
                                @foreach(range(date('Y'), 2020) as $year)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        Tahun {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('activities.panjat-tebing') }}" class="btn btn-outline-light w-100 py-3 rounded-0 border-0"
                                style="background: rgba(255,255,255,0.05); font-size: 0.8rem; font-weight: 700; letter-spacing: 0.05em;">RESET</a>
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
