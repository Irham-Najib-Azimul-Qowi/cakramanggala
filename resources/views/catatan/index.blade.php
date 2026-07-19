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
                    <div class="mb-5">
                        <form method="GET" action="{{ route('catatan-perjalanan.index') }}" class="row g-3">
                            <div class="col-lg-3 col-md-6">
                                <div class="cm-filter-group">
                                    <i class="bi bi-search cm-filter-icon"></i>
                                    <input type="text" name="search" class="cm-filter-control"
                                        value="{{ $search }}" placeholder="Cari judul, penulis, lokasi..."
                                        onchange="this.form.submit()">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="cm-dropdown" data-auto-submit="true">
                                    <button type="button" class="cm-dropdown-toggle">
                                        <div class="cm-dropdown-left">
                                            <i class="bi bi-geo-alt cm-filter-icon"></i>
                                            <span class="cm-dropdown-label">{{ $lokasi ?: 'Semua Lokasi' }}</span>
                                        </div>
                                        <i class="bi bi-chevron-down cm-dropdown-arrow"></i>
                                    </button>
                                    <div class="cm-dropdown-menu">
                                        <div class="cm-dropdown-item {{ !$lokasi ? 'selected' : '' }}" data-value="">
                                            <span>Semua Lokasi</span>
                                            <i class="bi bi-check2 cm-check-icon"></i>
                                        </div>
                                        @foreach($lokasis as $lok)
                                            <div class="cm-dropdown-item {{ $lokasi == $lok ? 'selected' : '' }}" data-value="{{ $lok }}">
                                                <span>{{ $lok }}</span>
                                                <i class="bi bi-check2 cm-check-icon"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="lokasi" value="{{ $lokasi }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="cm-dropdown" data-auto-submit="true">
                                    <button type="button" class="cm-dropdown-toggle">
                                        <div class="cm-dropdown-left">
                                            <i class="bi bi-tag cm-filter-icon"></i>
                                            <span class="cm-dropdown-label">{{ $angkatan ?: 'Semua Kategori' }}</span>
                                        </div>
                                        <i class="bi bi-chevron-down cm-dropdown-arrow"></i>
                                    </button>
                                    <div class="cm-dropdown-menu">
                                        <div class="cm-dropdown-item {{ !$angkatan ? 'selected' : '' }}" data-value="">
                                            <span>Semua Kategori</span>
                                            <i class="bi bi-check2 cm-check-icon"></i>
                                        </div>
                                        @foreach($angkatans as $ang)
                                            <div class="cm-dropdown-item {{ $angkatan == $ang ? 'selected' : '' }}" data-value="{{ $ang }}">
                                                <span>{{ $ang }}</span>
                                                <i class="bi bi-check2 cm-check-icon"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="angkatan" value="{{ $angkatan }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="cm-dropdown" data-auto-submit="true">
                                    <button type="button" class="cm-dropdown-toggle">
                                        <div class="cm-dropdown-left">
                                            <i class="bi bi-flag cm-filter-icon"></i>
                                            <span class="cm-dropdown-label">
                                                @php $selectedKeg = $kegiatans->firstWhere('id', $kegiatan_id); @endphp
                                                {{ $selectedKeg ? $selectedKeg->judul_kegiatan : 'Semua Kegiatan' }}
                                            </span>
                                        </div>
                                        <i class="bi bi-chevron-down cm-dropdown-arrow"></i>
                                    </button>
                                    <div class="cm-dropdown-menu">
                                        <div class="cm-dropdown-item {{ !$kegiatan_id ? 'selected' : '' }}" data-value="">
                                            <span>Semua Kegiatan</span>
                                            <i class="bi bi-check2 cm-check-icon"></i>
                                        </div>
                                        @foreach($kegiatans as $keg)
                                            <div class="cm-dropdown-item {{ $kegiatan_id == $keg->id ? 'selected' : '' }}" data-value="{{ $keg->id }}">
                                                <span>{{ $keg->judul_kegiatan }}</span>
                                                <i class="bi bi-check2 cm-check-icon"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="kegiatan_id" value="{{ $kegiatan_id }}">
                                </div>
                            </div>
                        </form>

                        @if($search || $lokasi || $angkatan || $kegiatan_id)
                            <div class="cm-active-filters">
                                <span class="cm-active-filters__label">Filter Aktif:</span>
                                @if($search)
                                    <span class="cm-filter-chip">
                                        Kata Kunci: "{{ $search }}"
                                        <a href="{{ route('catatan-perjalanan.index', request()->except('search')) }}"><i class="bi bi-x-lg"></i></a>
                                    </span>
                                @endif
                                @if($lokasi)
                                    <span class="cm-filter-chip">
                                        Lokasi: {{ $lokasi }}
                                        <a href="{{ route('catatan-perjalanan.index', request()->except('lokasi')) }}"><i class="bi bi-x-lg"></i></a>
                                    </span>
                                @endif
                                @if($angkatan)
                                    <span class="cm-filter-chip">
                                        Kategori: {{ $angkatan }}
                                        <a href="{{ route('catatan-perjalanan.index', request()->except('angkatan')) }}"><i class="bi bi-x-lg"></i></a>
                                    </span>
                                @endif
                                @if($kegiatan_id)
                                    @php $selectedKeg = $kegiatans->firstWhere('id', $kegiatan_id); @endphp
                                    <span class="cm-filter-chip">
                                        Kegiatan: {{ $selectedKeg->judul_kegiatan ?? 'Kegiatan' }}
                                        <a href="{{ route('catatan-perjalanan.index', request()->except('kegiatan_id')) }}"><i class="bi bi-x-lg"></i></a>
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($catatans->count() > 0)
                <div class="row g-4 mobile-horizontal-scroll">
                    @foreach($catatans as $catatan)
                        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                            <div class="premium-card">
                                <div class="premium-card__img-wrapper" style="height: 220px; overflow: hidden; position: relative;">
                                    @if($catatan->gambar)
                                        <img src="{{ str_starts_with($catatan->gambar, 'uploads/') ? asset($catatan->gambar) : asset('storage/' . $catatan->gambar) }}" class="premium-card__img" alt="{{ $catatan->judul }}">
                                    @else
                                        <div class="premium-card__img-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #1a4331 0%, #07110c 100%); display: flex; align-items: center; justify-content: center; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                            <i class="bi bi-compass" style="font-size: 3rem; color: var(--accent-color); opacity: 0.6;"></i>
                                        </div>
                                    @endif
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
