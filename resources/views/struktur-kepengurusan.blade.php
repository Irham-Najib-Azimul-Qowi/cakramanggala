@extends('layouts.app')

@section('title', 'Struktur Kepengurusan - UKM Cakra Manggala')

@push('styles')
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

        .org-member-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.03);
            color: #fff;
            text-align: center;
            padding: 3rem 2rem;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .org-member-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent-color);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }

        .org-member-card__avatar-wrap {
            position: relative;
            display: inline-flex;
            margin-bottom: 2rem;
        }

        .org-member-card__avatar {
            width: 110px;
            height: 110px;
            border-radius: 0;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.05);
            background: #000;
            transition: all 0.4s;
        }

        .org-member-card:hover .org-member-card__avatar {
            border-color: var(--accent-color);
        }

        .org-member-card--leader .org-member-card__avatar {
            width: 140px;
            height: 140px;
            border-color: rgba(242, 182, 97, 0.3);
        }

        .org-member-card__badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            right: -5px;
            bottom: -5px;
            width: 32px;
            height: 32px;
            background: var(--accent-color);
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        .org-member-card__name {
            margin-bottom: 0.8rem;
            color: #fff;
            font-size: 1.25rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.01em;
        }

        .org-member-card__role {
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--accent-color);
            padding: 0.6rem 1.2rem;
            background: rgba(242, 182, 97, 0.05);
            border: 1px solid rgba(242, 182, 97, 0.1);
            display: inline-block;
            margin-bottom: 1rem;
        }

        .org-member-card__placeholder {
            width: 110px;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
            color: var(--accent-color);
            font-size: 2.5rem;
            font-weight: 900;
            border: 4px solid rgba(255, 255, 255, 0.05);
        }

        .org-member-card--leader .org-member-card__placeholder {
            width: 140px;
            height: 140px;
            font-size: 3.5rem;
        }

        .section-intro .section-kicker {
            background: transparent;
            border-color: rgba(255, 255, 255, 0.1);
            color: var(--accent-color);
        }

        .section-intro .section-heading {
            color: #fff;
        }

        @media (max-width: 768px) {

            .org-member-card__avatar,
            .org-member-card__placeholder {
                width: 100px;
                height: 100px;
            }

            .org-member-card--leader .org-member-card__avatar,
            .org-member-card--leader .org-member-card__placeholder {
                width: 120px;
                height: 120px;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $heroImage = asset('image/fotobersejarah2.jpg');

        $leader = $penguruses->where('jabatan', 'Ketua Umum')->first();
        $coreMembers = $penguruses->filter(fn($p) => in_array($p->jabatan, ['Sekretaris', 'Bendahara', 'Kabid. Logistik']));
        $divisionHeads = $penguruses->filter(fn($p) => !in_array($p->jabatan, ['Ketua Umum', 'Sekretaris', 'Bendahara', 'Kabid. Logistik']));
    @endphp

    <div class="page-wrapper">
        <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
            <div class="container">
                <div class="page-hero__inner" data-aos="fade-up">
                    <span class="page-hero__eyebrow">
                        <i class="bi bi-people"></i>
                        Pilar Pergerakan
                    </span>
                    <h1 class="page-hero__title">STRUKTUR<br><span>ORGANISASI</span></h1>
                    <p class="page-hero__lead">
                        Mengenal tim di balik layar yang menggerakkan roda UKM Cakra Manggala menuju visi pengembaraan yang
                        unggul.
                    </p>
                </div>
            </div>
        </section>

        <section class="section-shell" style="background-color: var(--dark-color);">
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

        <!-- KETUA UMUM -->
        @if($leader)
            <section class="section-shell" style="background-color: var(--dark-color); padding-top: 0;">
                <div class="container">
                    <div class="section-intro text-center mb-5" data-aos="fade-up">
                        <span class="section-kicker mx-auto">Pimpinan</span>
                        <h2 class="section-heading">Ketua Umum</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-5" data-aos="fade-up">
                            <article class="org-member-card org-member-card--leader">
                                <div class="org-member-card__avatar-wrap">
                                    @if($leader->foto)
                                        <img src="{{ asset($leader->foto) }}" alt="{{ $leader->nama }}"
                                            class="org-member-card__avatar">
                                    @else
                                        <div class="org-member-card__placeholder">
                                            {{ strtoupper(substr($leader->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="org-member-card__badge"><i class="bi bi-award-fill"></i></span>
                                </div>
                                <h3 class="org-member-card__name">{{ $leader->nama }}</h3>
                                <div class="org-member-card__role">{{ $leader->jabatan }}</div>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- PENGURUS INTI -->
        @if($coreMembers->count() > 0)
            <section class="section-shell" style="background-color: var(--dark-color); padding-top: 0;">
                <div class="container">
                    <div class="section-intro text-center mb-5" data-aos="fade-up">
                        <span class="section-kicker mx-auto">Operasional</span>
                        <h2 class="section-heading">Pengurus Inti</h2>
                    </div>
                    <div class="row g-4 justify-content-center">
                        @foreach($coreMembers as $member)
                            <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <article class="org-member-card">
                                    <div class="org-member-card__avatar-wrap">
                                        @if($member->foto)
                                            <img src="{{ asset($member->foto) }}" alt="{{ $member->nama }}"
                                                class="org-member-card__avatar">
                                        @else
                                            <div class="org-member-card__placeholder">
                                                {{ strtoupper(substr($member->nama, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="org-member-card__name">{{ $member->nama }}</h3>
                                    <div class="org-member-card__role">{{ $member->jabatan }}</div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- KEPALA BIDANG -->
        @if($divisionHeads->count() > 0)
            <section class="section-shell" style="background-color: var(--dark-color); padding-top: 0; padding-bottom: 8rem;">
                <div class="container">
                    <div class="section-intro text-center mb-5" data-aos="fade-up">
                        <span class="section-kicker mx-auto">Divisi</span>
                        <h2 class="section-heading">Kepala Bidang</h2>
                    </div>
                    <div class="row g-4 justify-content-center">
                        @foreach($divisionHeads as $member)
                            <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <article class="org-member-card">
                                    <div class="org-member-card__avatar-wrap">
                                        @if($member->foto)
                                            <img src="{{ asset($member->foto) }}" alt="{{ $member->nama }}"
                                                class="org-member-card__avatar">
                                        @else
                                            <div class="org-member-card__placeholder">
                                                {{ strtoupper(substr($member->nama, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="org-member-card__name">{{ $member->nama }}</h3>
                                    <div class="org-member-card__role">{{ $member->jabatan }}</div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection