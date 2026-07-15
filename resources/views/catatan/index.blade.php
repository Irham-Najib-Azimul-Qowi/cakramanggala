@extends('layouts.app')

@section('title', 'Catatan Perjalanan - UKM Cakra Manggala')

@section('content')
    @php
        $heroImage = asset('image/fotobersejarah2.jpg');
    @endphp

    <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
        <div class="container">
            <div class="page-hero__inner">
                <span class="page-hero__eyebrow" data-aos="fade-up">
                    <i class="bi bi-compass-fill"></i>
                    Arsip Ekspedisi
                </span>
                <h1 class="page-hero__title" data-aos="fade-up" data-aos-delay="100">Catatan Perjalanan</h1>
                <p class="page-hero__lead" data-aos="fade-up" data-aos-delay="200">
                    Jurnal perjalanan, pemetaan jalur, catatan diklat, serta petualangan alam bebas anggota UKM Cakra Manggala.
                </p>
                <div class="mt-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('catatan-perjalanan.tambah') }}" class="btn-premium">
                        <i class="bi bi-plus-circle-fill me-2"></i> Tambahkan Pengalamanmu
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell" style="background-color: var(--dark-color); color: #fff; min-height: 80vh; padding-top: 4rem; padding-bottom: 6rem;">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success border-0 rounded-0 shadow-sm p-4 mb-5 d-flex align-items-start gap-3" style="background: rgba(46, 125, 50, 0.1); border: 1px solid rgba(46, 125, 50, 0.3) !important; color: #fff;">
                    <i class="bi bi-check-circle-fill text-accent-color fs-4"></i>
                    <div>
                        <h4 class="alert-heading fw-bold fs-6 text-accent-color mb-1">BERHASIL!</h4>
                        <p class="mb-0 small text-white-50">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Search & Filters -->
            <div class="row justify-content-center mb-5" data-aos="fade-up">
                <div class="col-lg-12">
                    <form method="GET" action="{{ route('catatan-perjalanan.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <div class="input-group" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.03);">
                                <span class="input-group-text bg-transparent border-0 ps-3">
                                    <i class="bi bi-search" style="color: var(--accent-color);"></i>
                                </span>
                                <input type="text" name="search"
                                    class="form-control bg-transparent border-0 text-white py-2.5 shadow-none"
                                    value="{{ $search }}" placeholder="Cari judul, penulis, lokasi...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select name="lokasi" class="form-select text-white py-2.5 shadow-none" 
                                    style="border: 1px solid rgba(255,255,255,0.1); background: #1a1a1a; cursor: pointer;">
                                <option value="" style="background: #1a1a1a;">Semua Lokasi</option>
                                @foreach($lokasis as $lok)
                                    <option value="{{ $lok }}" style="background: #1a1a1a;" {{ $lokasi == $lok ? 'selected' : '' }}>{{ $lok }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="angkatan" class="form-select text-white py-2.5 shadow-none" 
                                    style="border: 1px solid rgba(255,255,255,0.1); background: #1a1a1a; cursor: pointer;">
                                <option value="" style="background: #1a1a1a;">Semua Angkatan/Kategori</option>
                                @foreach($angkatans as $ang)
                                    <option value="{{ $ang }}" style="background: #1a1a1a;" {{ $angkatan == $ang ? 'selected' : '' }}>{{ $ang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="kegiatan_id" class="form-select text-white py-2.5 shadow-none" 
                                    style="border: 1px solid rgba(255,255,255,0.1); background: #1a1a1a; cursor: pointer;">
                                <option value="" style="background: #1a1a1a;">Semua Kegiatan</option>
                                @foreach($kegiatans as $keg)
                                    <option value="{{ $keg->id }}" style="background: #1a1a1a;" {{ $kegiatan_id == $keg->id ? 'selected' : '' }}>{{ $keg->judul_kegiatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button class="btn w-100 py-2.5" type="submit"
                                style="background: var(--accent-color); color: var(--primary-color); border-radius: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05rem; font-size: 0.8rem;">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if($catatans->count() > 0)
                <div class="row g-4">
                    @foreach($catatans as $catatan)
                        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                            <div class="premium-card">
                                <div class="premium-card__img-wrapper">
                                    <img src="{{ $catatan->gambar_url }}" class="premium-card__img" alt="{{ $catatan->judul }}">
                                    @if($catatan->lokasi)
                                        <span class="premium-card__badge">{{ $catatan->lokasi }}</span>
                                    @endif
                                </div>
                                <div class="premium-card__body">
                                    <div class="premium-card__meta">
                                        <span><i class="bi bi-person-fill me-2"></i>{{ $catatan->penulis }}</span>
                                        @if($catatan->angkatan)
                                            <span class="ms-3"><i class="bi bi-tag-fill me-2"></i>{{ $catatan->angkatan }}</span>
                                        @endif
                                    </div>
                                    <h3 class="premium-card__title">{{ $catatan->judul }}</h3>
                                    <p class="premium-card__text">
                                        {{ $catatan->deskripsi ?: Str::limit(strip_tags($catatan->konten), 110) }}
                                    </p>
                                    <div class="premium-card__footer">
                                        <a href="{{ route('catatan-perjalanan.show', $catatan->slug) }}" class="btn-premium-link">
                                            BACA JURNAL <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                        <div style="font-size: 0.8rem; color: rgba(255,255,255,0.6);">
                                            <i class="bi bi-eye-fill me-1" style="color: var(--accent-color);"></i> {{ number_format($catatan->views) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5 custom-pagination">
                    {{ $catatans->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5" data-aos="fade-up">
                    <div
                        style="background: rgba(255,255,255,0.05); width: 120px; height: 120px; border-radius: 0; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                        <i class="bi bi-compass display-3" style="color: rgba(255,255,255,0.15);"></i>
                    </div>
                    <h3 class="fw-bold" style="color: #fff;">Catatan Tidak Ditemukan</h3>
                    <p style="color: rgba(255,255,255,0.5);">Maaf, kami tidak menemukan catatan perjalanan yang sesuai dengan pencarian Anda.</p>
                    <a href="{{ route('catatan-perjalanan.index') }}" class="btn-premium mt-4">Reset Pencarian</a>
                </div>
            @endif
        </div>
    </section>

    <style>
        .log-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .log-card:hover {
            border-color: var(--accent-color);
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .log-card__header {
            padding: 2.2rem 2.2rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .log-card__icon-badge {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .log-card__badge {
            background: var(--accent-color);
            color: var(--primary-color);
            padding: 0.4rem 1rem;
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .log-card__body {
            padding: 2.2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .log-card__meta {
            font-size: 0.75rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.4);
            margin-bottom: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .log-card__meta i {
            color: var(--accent-color);
        }

        .log-card__title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            line-height: 1.4;
            color: #fff;
            margin-bottom: 1.2rem;
            letter-spacing: -0.01em;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 4.2em; /* Ensure uniform height for title area */
        }

        .log-card__text {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 5.1em; /* Ensure uniform height for desc area */
        }

        .log-card__footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .log-card__link {
            color: #fff;
            text-decoration: none !important;
            font-weight: 800;
            font-size: 0.8rem;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            letter-spacing: 0.1em;
        }

        .log-card:hover .log-card__link {
            color: var(--accent-color);
        }

        .log-card__views {
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

        /* Responsive adjustments for selects */
        .form-select {
            border-radius: 0;
            font-size: 0.95rem;
        }
    </style>
@endsection
