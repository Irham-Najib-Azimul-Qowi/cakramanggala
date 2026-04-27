{{-- File: resources/views/join-success.blade.php --}}
@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - UKM Cakra Manggala')

@section('content')
    <style>
        .success-wrapper {
            min-height: 100vh;
            background: var(--surface-color);
            display: flex;
            align-items: center;
            padding: 4rem 0;
        }

        /* Hide Navbar & Footer */
        .site-navbar,
        .footer {
            display: none !important;
        }

        main {
            padding-top: 0 !important;
        }

        .success-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0;
            padding: clamp(2rem, 5vw, 4rem);
            box-shadow: 0 40px 100px rgba(7, 17, 12, 0.15);
            text-align: center;
            max-width: 700px;
            margin: 0 auto;
            color: #fff;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s forwards;
        }

        .success-icon-box {
            width: 100px;
            height: 100px;
            background: var(--accent-color);
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 3rem;
            color: var(--primary-color);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .success-title {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            margin-bottom: 1rem;
            color: #fff;
        }

        .success-lead {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .info-list {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 0;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            text-align: left;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .info-item {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-icon {
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            background: var(--accent-color);
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: 800;
        }

        .info-text h6 {
            margin: 0 0 4px;
            font-weight: 700;
            color: #fff;
        }

        .info-text p {
            margin: 0;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .action-group {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .btn-action {
            padding: 1.1rem 2rem;
            border-radius: 0;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            border: none;
        }

        .btn-wa {
            background: #25d366;
            color: #fff;
        }

        .btn-wa:hover {
            background: #20c157;
            color: #fff;
            transform: translateY(-3px);
        }

        .btn-accent {
            background: var(--accent-color);
            color: var(--primary-color);
        }

        .btn-accent:hover {
            background: #fff;
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (min-width: 576px) {
            .action-group {
                flex-direction: row;
                justify-content: center;
            }

            .btn-action {
                min-width: 220px;
            }
        }
    </style>

    <div class="success-wrapper">
        <div class="container">
            <div class="success-card">
                <div class="success-icon-box">
                    <i class="bi bi-check2"></i>
                </div>

                <h1 class="success-title">Pendaftaran Terkirim!</h1>
                <p class="success-lead">
                    Halo Calon Anggota Angkatan XIV. Data kamu sudah kami terima di sistem. Panitia akan segera meninjau
                    formulir pendaftaranmu.
                </p>

                <div class="info-list">
                    <div class="info-item">
                        <div class="info-icon">1</div>
                        <div class="info-text">
                            <h6>Grup WhatsApp</h6>
                            <p>Wajib bergabung untuk informasi seleksi dan jadwal terbaru.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">2</div>
                        <div class="info-text">
                            <h6>Cek Email</h6>
                            <p>Kami mungkin mengirimkan konfirmasi atau berkas tambahan melalui email.</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">3</div>
                        <div class="info-text">
                            <h6>Mulai Persiapan</h6>
                            <p>Siapkan fisik dan semangatmu untuk petualangan bersama Cakra Manggala.</p>
                        </div>
                    </div>
                </div>

                <div class="action-group">
                    <a href="https://chat.whatsapp.com/JAT9OtV5e9V3HAw5P3unca" target="_blank" class="btn-action btn-wa">
                        <i class="bi bi-whatsapp"></i> Gabung Grup WA
                    </a>
                    <a href="{{ route('home') }}" class="btn-action btn-accent">
                        <i class="bi bi-house"></i> Kembali Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection