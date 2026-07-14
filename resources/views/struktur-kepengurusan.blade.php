@extends('layouts.app')

@section('title', 'Struktur Kepengurusan - UKM Cakra Manggala')

@section('content')
    @php
        $heroImage = asset('image/fotobersejarah2.jpg');
    @endphp

    <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
        <div class="container">
            <div class="page-hero__inner" data-aos="fade-up">
                <span class="page-hero__eyebrow">
                    <i class="bi bi-people"></i>
                    Pilar Pergerakan
                </span>
                <h1 class="page-hero__title">STRUKTUR<br><span>ORGANISASI</span></h1>
                <p class="page-hero__lead">
                    Mengenal tim di balik layar yang menggerakkan roda UKM Cakra Manggala menuju visi pengembaraan yang unggul.
                </p>
            </div>
        </div>
    </section>

    <section class="section-shell" style="background-color: var(--dark-color); padding-bottom: 2rem;">
        <div class="container">
            <div class="org-period-banner" data-aos="fade-up">
                <span class="section-kicker mb-3">
                    <i class="bi bi-clock-history"></i>
                    Kepengurusan Aktif
                </span>
                <h2 class="section-heading">PERIODE 2024 — 2025</h2>
                <p class="section-lead mx-auto text-white-50" style="max-width: 600px;">
                    Barisan pengurus yang berdedikasi untuk melanjutkan estafet perjuangan dan pelestarian alam.
                </p>
            </div>
        </div>
    </section>

    <!-- LIST PENGURUS -->
    <section class="section-shell" style="background-color: var(--dark-color); padding-top: 0; padding-bottom: 8rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="officer-stack">
                        @foreach($penguruses as $member)
                            <div class="officer-horizontal-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                <div class="oh-card__inner">
                                    <div class="oh-card__photo">
                                        @if($member->foto)
                                            <img src="{{ asset($member->foto) }}" alt="Pengurus Cakra Manggala: {{ $member->nama }} - {{ $member->jabatan }}" loading="lazy">
                                        @else
                                            <div class="oh-card__placeholder">
                                                {{ strtoupper(substr($member->nama, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="oh-card__content">
                                        <div class="oh-card__header">
                                            <span class="oh-card__position">{{ strtoupper($member->jabatan) }}</span>
                                            <h3 class="oh-card__name">{{ $member->nama }}</h3>
                                            @if($member->prodi_semester)
                                                <p class="x-small text-accent mt-1 mb-0 fw-bold">
                                                    {{ strtoupper($member->prodi_semester) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="oh-card__footer">
                                            <div class="d-flex align-items-center gap-3">
                                                <div style="width: 30px; height: 1px; background: rgba(255,255,255,0.2);"></div>
                                                <span class="x-small text-white-50 fw-bold">PENGURUS AKTIF</span>
                                            </div>
                                            @if($member->instagram_url)
                                                <a href="{{ $member->instagram_url }}" target="_blank" class="oh-card__social">
                                                    <i class="bi bi-instagram"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .page-wrapper {
            background-color: var(--dark-color);
        }

        .org-period-banner {
            padding: 4rem 2.5rem;
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .org-period-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--accent-color);
        }

        .org-period-banner .section-kicker {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
            color: var(--accent-color);
        }

        .org-period-banner .section-heading {
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .officer-stack {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .officer-horizontal-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.03);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .officer-horizontal-card:hover {
            border-color: var(--accent-color);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .oh-card__inner {
            display: flex;
            align-items: stretch;
            min-height: 140px;
        }

        .oh-card__photo {
            width: 140px;
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.03);
            overflow: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .oh-card__photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }

        .officer-horizontal-card:hover .oh-card__photo img {
            transform: scale(1.1);
        }

        .oh-card__placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 900;
            color: var(--accent-color);
            background: var(--dark-color);
        }

        .oh-card__content {
            flex-grow: 1;
            padding: 2rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .oh-card__position {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.2em;
            color: var(--accent-color);
            display: block;
            margin-bottom: 0.5rem;
        }

        .oh-card__name {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            margin: 0;
            letter-spacing: -0.01em;
        }

        .oh-card__footer {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .oh-social-link, .oh-card__social {
            color: rgba(255, 255, 255, 0.3);
            font-size: 1.2rem;
            transition: color 0.3s;
            text-decoration: none;
        }

        .oh-social-link:hover, .oh-card__social:hover {
            color: var(--accent-color);
        }

        .x-small {
            font-size: 0.75rem;
        }

        @media (max-width: 768px) {
            .oh-card__inner {
                flex-direction: column;
            }

            .oh-card__photo {
                width: 100%;
                height: 200px;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .oh-card__content {
                padding: 1.5rem;
            }
        }
    </style>
@endsection