@extends('layouts.app')

@section('title', 'Artikel - UKM Cakra Manggala')

@section('content')
    @php
        $heroImage = asset('image/fotobersejarah2.jpg');
    @endphp

    <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
        <div class="container">
            <div class="page-hero__inner">
                <span class="page-hero__eyebrow" data-aos="fade-up">
                    <i class="bi bi-journal-richtext"></i>
                    Koleksi Tulisan
                </span>
                <h1 class="page-hero__title" data-aos="fade-up" data-aos-delay="100">Artikel & Catatan Perjalanan</h1>
                <p class="page-hero__lead" data-aos="fade-up" data-aos-delay="200">
                    Ruang bagi anggota untuk berbagi wawasan, teknis lapangan, hingga laporan eksplorasi alam bebas.
                </p>
            </div>
        </div>
    </section>

    <section class="section-shell" style="background-color: var(--dark-color); color: #fff; min-height: 80vh;">
        <div class="container">
            <!-- Search Bar -->
            <div class="row justify-content-center mb-5" data-aos="fade-up">
                <div class="col-lg-7">
                    <form method="GET" action="{{ route('artikel.index') }}">
                        <div class="input-group input-group-lg"
                            style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.03);">
                            <span class="input-group-text bg-transparent border-0 ps-4">
                                <i class="bi bi-search" style="color: var(--accent-color);"></i>
                            </span>
                            <input type="text" name="search"
                                class="form-control bg-transparent border-0 text-white py-3 shadow-none"
                                value="{{ $search }}" placeholder="Cari topik artikel..."
                                style="font-size: 1.1rem; letter-spacing: 0.02em;">
                            <button class="btn px-4" type="submit"
                                style="background: var(--accent-color); color: var(--primary-color); border-radius: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.85rem;">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if($artikels->count() > 0)
                <div class="row g-4">
                    @foreach($artikels as $artikel)
                        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                            <div class="art-card">
                                <div class="art-card__img-wrap">
                                    @if($artikel->gambar_utama)
                                        <img src="{{ asset($artikel->gambar_utama) }}" alt="Artikel: {{ $artikel->judul }}" class="art-card__img" loading="lazy">
                                    @else
                                        <div class="art-card__img-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a4331 0%, #07110c 100%); display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-book" style="font-size: 3.5rem; color: var(--accent-color); opacity: 0.5;"></i>
                                        </div>
                                    @endif
                                    <span class="art-card__badge">BLOG</span>
                                </div>
                                <div class="art-card__body">
                                    <div class="art-card__meta">
                                        <span><i
                                                class="bi bi-calendar3 me-2"></i>{{ $artikel->created_at->translatedFormat('d M Y') }}</span>
                                        <span class="ms-3"><i class="bi bi-person-fill me-2"></i>{{ $artikel->user->name }}</span>
                                    </div>
                                    <h3 class="art-card__title">{{ $artikel->judul }}</h3>
                                    <p class="art-card__text">
                                        {{ $artikel->excerpt ?: Str::limit(strip_tags($artikel->konten), 110) }}
                                    </p>
                                    <div class="art-card__footer">
                                        <a href="{{ route('artikel.show', $artikel->slug) }}" class="art-card__link">
                                            Baca Lanjut <i class="bi bi-chevron-right"></i>
                                        </a>
                                        <div class="art-card__views">
                                            <i class="bi bi-eye"></i> {{ number_format($artikel->views) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5 custom-pagination">
                    {{ $artikels->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5" data-aos="fade-up">
                    <div
                        style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 0; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                        <i class="bi bi-search display-3" style="color: rgba(255,255,255,0.15);"></i>
                    </div>
                    <h3 class="fw-bold" style="color: #fff;">Artikel Tidak Ditemukan</h3>
                    <p style="color: rgba(255,255,255,0.5);">Maaf, kami tidak menemukan artikel dengan kata kunci
                        "{{ $search }}".</p>
                    <a href="{{ route('artikel.index') }}" class="btn-join-premium mt-4"
                        style="padding: 0.8rem 2.5rem; font-size: 0.85rem;">Reset Pencarian</a>
                </div>
            @endif
        </div>
    </section>

    <style>
        .art-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .art-card:hover {
            border-color: var(--accent-color);
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
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
            transition: transform 0.8s ease;
        }

        .art-card:hover .art-card__img {
            transform: scale(1.1);
        }

        .art-card__badge {
            position: absolute;
            top: 0;
            right: 0;
            background: var(--accent-color);
            color: var(--primary-color);
            padding: 0.4rem 1.2rem;
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 0.1em;
            z-index: 5;
        }

        .art-card__body {
            padding: 2.2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .art-card__meta {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .art-card__title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            line-height: 1.3;
            color: #fff;
            margin-bottom: 1.2rem;
            letter-spacing: -0.01em;
        }

        .art-card__text {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            flex-grow: 1;
        }

        .art-card__footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .art-card__link {
            color: #fff;
            text-decoration: none !important;
            font-weight: 800;
            font-size: 0.85rem;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .art-card__link:hover {
            color: var(--accent-color);
        }

        .art-card__views {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.3);
            font-weight: 700;
        }

        .custom-pagination .pagination {
            gap: 5px;
        }

        .custom-pagination .page-link {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 0 !important;
            padding: 0.6rem 1rem;
            font-weight: 700;
        }

        .custom-pagination .page-item.active .page-link {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--primary-color);
        }

        .custom-pagination .page-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
        }
    </style>
@endsection