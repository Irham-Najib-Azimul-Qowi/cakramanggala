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
            <!-- Search and Stats Bar -->
            <div class="row align-items-center mb-5 g-4" data-aos="fade-up">
                <div class="col-md-8 col-lg-9">
                    <form action="{{ route('about.member') }}" method="GET" class="search-form-wrap">
                        <div class="input-group">
                            <span class="input-group-text" style="background: var(--primary-color); border: 1px solid rgba(255,255,255,0.05); border-right: none; color: rgba(255,255,255,0.4);">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control search-input" 
                                placeholder="Cari anggota berdasarkan nama, NIA, atau angkatan..." 
                                value="{{ $search }}" 
                                style="background: var(--primary-color); border: 1px solid rgba(255,255,255,0.05); border-left: none; color: #fff; box-shadow: none;">
                            @if($search)
                                <a href="{{ route('about.member') }}" class="btn btn-outline-secondary d-flex align-items-center" style="border: 1px solid rgba(255,255,255,0.05); border-left: none; background: var(--primary-color); color: rgba(255,255,255,0.4);">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                            <button class="btn btn-accent" type="submit" style="background: var(--accent-color); color: var(--primary-color); border: 1px solid var(--accent-color); font-weight: 800;">
                                CARI
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 col-lg-3 text-md-end">
                    <div class="stats-badge-wrap">
                        <span class="stats-badge" style="background: rgba(242, 182, 97, 0.05); border: 1px solid rgba(242, 182, 97, 0.1); color: var(--accent-color); padding: 0.75rem 1.5rem; display: inline-block; font-weight: 800; letter-spacing: 0.05em;">
                            TOTAL: {{ $members->total() }} ANGGOTA
                        </span>
                    </div>
                </div>
            </div>

            @if($members->count() > 0)
                <!-- Member Cards Grid -->
                <div class="row g-3 card-grid-anggota">
                    @foreach($members as $index => $member)
                        <div class="col-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
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

        @media (max-width: 575px) {
            .member-card {
                padding: 1.25rem 0.75rem 1rem;
            }

            .member-card__avatar-wrap {
                margin-bottom: 0.85rem;
            }

            .member-card__avatar,
            .member-card__placeholder {
                width: 60px;
                height: 60px;
            }

            .member-card__placeholder {
                font-size: 1.5rem;
            }

            .member-card__badge-status {
                width: 10px;
                height: 10px;
            }

            .member-card__name {
                font-size: 0.78rem;
                margin-bottom: 0.25rem;
            }

            .member-card__nim {
                font-size: 0.6rem;
                margin-bottom: 0.5rem;
                letter-spacing: 0.05em;
            }

            .member-card__major {
                font-size: 0.62rem;
                margin-bottom: 0.75rem;
            }

            .member-card__footer {
                padding-top: 0.65rem;
            }

            .badge-active {
                font-size: 0.55rem;
                letter-spacing: 0.06em;
            }

            .badge-active i {
                display: none;
            }
        }
    </style>
@endsection
