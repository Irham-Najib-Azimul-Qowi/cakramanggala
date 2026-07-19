@extends('layouts.app')

@section('title', 'Daftar Anggota - UKM Cakra Manggala')

@section('content')
    @php
        $heroImage = asset('image/fotobersejarah2.jpg');
    @endphp

    <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
        <div class="container">
            <div class="page-hero__inner">
                <span class="page-hero__eyebrow" data-aos="fade-up">
                    <i class="bi bi-people-fill"></i>
                    Persaudaraan
                </span>
                <h1 class="page-hero__title" data-aos="fade-up" data-aos-delay="100">Daftar<br><span>Anggota</span></h1>
                <p class="page-hero__lead" data-aos="fade-up" data-aos-delay="200">
                    Seluruh keluarga besar UKM Cakra Manggala dari Anggota Baru, Anggota Aktif, Demisioner, hingga Alumni.
                </p>
            </div>
        </div>
    </section>

    <section class="section-shell" style="background-color: var(--dark-color); padding-top: 4rem; padding-bottom: 8rem;">
        <div class="container">
            <!-- Search & Filters -->
            <div class="row justify-content-center mb-5" data-aos="fade-up">
                <div class="col-lg-12">
                    <div class="cm-filter-card">
                        <div class="cm-filter-header">
                            <h2 class="cm-filter-title">
                                <i class="bi bi-people-fill"></i> Filter & Direktori Anggota
                            </h2>
                            <div class="d-flex align-items-center gap-3">
                                <span class="stats-badge" style="background: rgba(242, 182, 97, 0.1); border: 1px solid rgba(242, 182, 97, 0.25); color: var(--accent-color); padding: 0.4rem 1rem; font-weight: 800; font-size: 0.78rem; border-radius: 6px;">
                                    TOTAL: {{ $members->total() }} ANGGOTA
                                </span>
                                @if($search || (isset($status) && $status) || (isset($angkatan) && $angkatan))
                                    <a href="{{ route('about.member') }}" class="cm-btn-reset px-3 text-decoration-none" style="height: 32px; font-size: 0.75rem;">
                                        <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
                                    </a>
                                @endif
                            </div>
                        </div>
                        <form action="{{ route('about.member') }}" method="GET" class="row g-3">
                            <div class="col-lg-4 col-md-6">
                                <div class="cm-filter-group">
                                    <i class="bi bi-search cm-filter-icon"></i>
                                    <input type="text" name="search" class="cm-filter-control"
                                        placeholder="Cari nama, NIA, atau angkatan..."
                                        value="{{ $search }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="cm-dropdown">
                                    <button type="button" class="cm-dropdown-toggle">
                                        <div class="cm-dropdown-left">
                                            <i class="bi bi-person-badge cm-filter-icon"></i>
                                            <span class="cm-dropdown-label">
                                                {{ (isset($status) && isset($statuses[$status])) ? $statuses[$status] : 'Semua Status' }}
                                            </span>
                                        </div>
                                        <i class="bi bi-chevron-down cm-dropdown-arrow"></i>
                                    </button>
                                    <div class="cm-dropdown-menu">
                                        <div class="cm-dropdown-item {{ (!isset($status) || !$status) ? 'selected' : '' }}" data-value="">
                                            <span>Semua Status</span>
                                            <i class="bi bi-check2 cm-check-icon"></i>
                                        </div>
                                        @if(isset($statuses))
                                            @foreach($statuses as $key => $label)
                                                <div class="cm-dropdown-item {{ (isset($status) && $status == $key) ? 'selected' : '' }}" data-value="{{ $key }}">
                                                    <span>{{ $label }}</span>
                                                    <i class="bi bi-check2 cm-check-icon"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <input type="hidden" name="status" value="{{ $status ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="cm-dropdown">
                                    <button type="button" class="cm-dropdown-toggle">
                                        <div class="cm-dropdown-left">
                                            <i class="bi bi-award cm-filter-icon"></i>
                                            <span class="cm-dropdown-label">
                                                {{ (isset($angkatan) && $angkatan) ? 'Angkatan ' . $angkatan : 'Semua Angkatan' }}
                                            </span>
                                        </div>
                                        <i class="bi bi-chevron-down cm-dropdown-arrow"></i>
                                    </button>
                                    <div class="cm-dropdown-menu">
                                        <div class="cm-dropdown-item {{ (!isset($angkatan) || !$angkatan) ? 'selected' : '' }}" data-value="">
                                            <span>Semua Angkatan</span>
                                            <i class="bi bi-check2 cm-check-icon"></i>
                                        </div>
                                        @if(isset($angkatans))
                                            @foreach($angkatans as $ang)
                                                <div class="cm-dropdown-item {{ (isset($angkatan) && $angkatan == $ang) ? 'selected' : '' }}" data-value="{{ $ang }}">
                                                    <span>Angkatan {{ $ang }}</span>
                                                    <i class="bi bi-check2 cm-check-icon"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <input type="hidden" name="angkatan" value="{{ $angkatan ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <button class="cm-btn-filter" type="submit">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </form>
                        @if($search || (isset($status) && $status) || (isset($angkatan) && $angkatan))
                            <div class="cm-active-filters">
                                <span class="cm-active-filters__label">Filter Aktif:</span>
                                @if($search)
                                    <span class="cm-filter-chip">
                                        Pencarian: "{{ $search }}"
                                        <a href="{{ route('about.member', request()->except('search')) }}"><i class="bi bi-x-lg"></i></a>
                                    </span>
                                @endif
                                @if(isset($status) && $status)
                                    <span class="cm-filter-chip">
                                        Status: {{ $statuses[$status] ?? $status }}
                                        <a href="{{ route('about.member', request()->except('status')) }}"><i class="bi bi-x-lg"></i></a>
                                    </span>
                                @endif
                                @if(isset($angkatan) && $angkatan)
                                    <span class="cm-filter-chip">
                                        Angkatan: {{ $angkatan }}
                                        <a href="{{ route('about.member', request()->except('angkatan')) }}"><i class="bi bi-x-lg"></i></a>
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($members->count() > 0)
                <!-- Member Cards Grid -->
                <div class="row g-4 mobile-horizontal-scroll">
                    @foreach($members as $index => $member)
                        <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                            <article class="member-card">
                                <div class="member-card__avatar-wrap">
                                    @if($member->foto)
                                        <img src="{{ asset($member->foto) }}" alt="{{ $member->nama }}" class="member-card__avatar">
                                    @else
                                        <div class="member-card__placeholder">
                                            {{ strtoupper(substr($member->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                    
                                    @if($member->status == 'anggota baru')
                                        <span class="member-card__badge-status" style="background: #38b000;"></span>
                                    @elseif($member->status == 'anggota')
                                        <span class="member-card__badge-status" style="background: #2ec4b6;"></span>
                                    @elseif($member->status == 'demisioner')
                                        <span class="member-card__badge-status" style="background: #ff9f1c;"></span>
                                    @else
                                        <span class="member-card__badge-status" style="background: #a8a8a8;"></span>
                                    @endif
                                </div>
                                <div class="member-card__content">
                                    <h3 class="member-card__name">{{ $member->nama }}</h3>
                                    <div class="member-card__nim">NIA. {{ $member->nia ?? '-' }}</div>
                                    <div class="member-card__major">
                                        <span class="text-accent fw-bold">Angkatan {{ $member->angkatan }}</span>
                                    </div>
                                </div>
                                <div class="member-card__footer">
                                    @if($member->status == 'anggota baru')
                                        <span class="badge-active" style="color: #38b000;"><i class="bi bi-person-plus-fill me-1"></i> ANGGOTA BARU</span>
                                    @elseif($member->status == 'anggota')
                                        <span class="badge-active" style="color: #2ec4b6;"><i class="bi bi-patch-check-fill me-1"></i> ANGGOTA AKTIF</span>
                                    @elseif($member->status == 'demisioner')
                                        <span class="badge-active" style="color: #ff9f1c;"><i class="bi bi-shield-fill-check me-1"></i> DEMISIONER</span>
                                    @else
                                        <span class="badge-active" style="color: #a8a8a8;"><i class="bi bi-mortarboard-fill me-1"></i> ALUMNI</span>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5 custom-pagination">
                    {{ $members->links() }}
                </div>
            @else
                <!-- No Results -->
                <div class="text-center py-5" data-aos="fade-up">
                    <div style="background: rgba(255,255,255,0.03); width: 100px; height: 100px; border: 1px solid rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                        <i class="bi bi-search display-4" style="color: rgba(255,255,255,0.15);"></i>
                    </div>
                    <h3 class="h4 fw-bold text-white mb-2">Anggota Tidak Ditemukan</h3>
                    <p class="text-white-50" style="max-width: 400px; margin: 0 auto;">
                        Tidak ada anggota yang cocok dengan kata kunci pencarian "{{ $search }}". Coba cari dengan kata kunci lain.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('about.member') }}" class="btn btn-outline-light" style="border-radius: 0; font-weight: 800; letter-spacing: 0.05em; padding: 0.75rem 1.5rem;">
                            LIHAT SEMUA ANGGOTA
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <style>
        /* Form Search styling */
        .search-form-wrap .search-input {
            border-radius: 0;
            padding: 0.75rem 1.25rem;
        }
        .search-form-wrap .input-group-text {
            border-radius: 0;
        }
        .search-form-wrap .search-input:focus {
            background: var(--primary-color) !important;
            border-color: var(--accent-color) !important;
            color: #fff !important;
        }

        /* Member Card Styling */
        .member-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.03);
            text-align: center;
            padding: 2.5rem 1.5rem 1.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .member-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent-color);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .member-card__avatar-wrap {
            position: relative;
            display: inline-flex;
            margin-bottom: 1.5rem;
        }

        .member-card__avatar {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.05);
            background: #000;
            transition: all 0.4s;
        }

        .member-card:hover .member-card__avatar {
            border-color: var(--accent-color);
        }

        .member-card__placeholder {
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
            color: var(--accent-color);
            font-size: 2.25rem;
            font-weight: 900;
            border: 3px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s;
        }

        .member-card:hover .member-card__placeholder {
            border-color: var(--accent-color);
        }

        .member-card__badge-status {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 14px;
            height: 14px;
            border: 2px solid var(--primary-color);
            border-radius: 50%;
        }

        .member-card__content {
            flex-grow: 1;
            width: 100%;
        }

        .member-card__name {
            font-size: 1.15rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.5rem;
            letter-spacing: -0.01em;
            line-height: 1.3;
        }

        .member-card__nim {
            font-size: 0.75rem;
            font-weight: 900;
            color: var(--accent-color);
            letter-spacing: 0.1em;
            margin-bottom: 1rem;
            font-family: monospace;
        }

        .member-card__major {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        .member-card__footer {
            width: 100%;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1rem;
            margin-top: auto;
        }

        .badge-active {
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
    </style>
@endsection
