{{-- File: resources/views/join-success.blade.php --}}
@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - UKM Cakra Manggala')

@section('content')
<style>
    .success-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .success-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        overflow: hidden;
        text-align: center;
    }

    .success-header {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        color: white;
        padding: 4rem 2rem;
    }

    .success-icon {
        font-size: 5rem;
        margin-bottom: 1rem;
        color: #4caf50;
        animation: checkmark 1s ease-in-out;
    }

    @keyframes checkmark {
        0% { transform: scale(0); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .success-body {
        padding: 3rem 2rem;
    }

    .welcome-message {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        line-height: 1.4;
    }

    .sub-welcome {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin-bottom: 2rem;
        font-weight: 500;
    }

    .info-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 2rem;
        margin: 2rem 0;
        border-left: 5px solid var(--accent-color);
    }

    .whatsapp-btn {
        background: #25d366;
        color: white;
        padding: 1.2rem 2.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        margin: 1rem 0.5rem;
    }

    .whatsapp-btn:hover {
        background: #20c157;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
        text-decoration: none;
    }

    .home-btn {
        background: var(--primary-color);
        color: white;
        padding: 1.2rem 2.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        margin: 1rem 0.5rem;
    }

    .home-btn:hover {
        background: var(--dark-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(46, 125, 50, 0.3);
        text-decoration: none;
    }

    .user-info {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        border-radius: 15px;
        padding: 2rem;
        margin: 2rem 0;
    }

    .user-info h6 {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .next-steps {
        background: linear-gradient(135deg, #fff3e0, #ffcc02);
        border-radius: 15px;
        padding: 2rem;
        margin: 2rem 0;
        border-left: 5px solid #ff9800;
    }

    .next-steps h5 {
        color: #e65100;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .step-list {
        text-align: left;
        max-width: 500px;
        margin: 0 auto;
    }

    .step-list li {
        padding: 0.5rem 0;
        color: #bf360c;
        font-weight: 500;
    }

    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background: var(--accent-color);
        animation: confetti-fall 3s linear infinite;
    }

    @keyframes confetti-fall {
        0% {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0;
        }
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    @media (max-width: 768px) {
        .welcome-message {
            font-size: 1.5rem;
        }
        
        .sub-welcome {
            font-size: 1rem;
        }
        
        .whatsapp-btn, .home-btn {
            display: block;
            margin: 1rem 0;
            width: 100%;
            text-align: center;
        }
    }
</style>

<section class="success-section">
    <!-- Confetti Animation -->
    @for($i = 0; $i < 50; $i++)
        @php
            $left = rand(0, 100) . '%';
            $delay = rand(0, 3000) . 'ms';
            $colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3'];
            $color = $colors[array_rand($colors)];
            $style = "left: $left; animation-delay: $delay; background: $color;";
        @endphp
    @endfor

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="success-container" data-aos="zoom-in">
                    <div class="success-header">
                        <div class="success-icon pulse">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h2>Pendaftaran Berhasil!</h2>
                    </div>

                    <div class="success-body">
                        <div class="welcome-message">
                            🎉 Selamat Datang Calon Anggota Baru Angkatan XIV! 🎉
                        </div>
                        
                        <div class="sub-welcome">
                            di <strong>Unit Kegiatan Mahasiswa Pecinta Alam Cakra Manggala</strong>
                        </div>

                        @if(isset($user))
                        <div class="user-info" data-aos="fade-up" data-aos-delay="200">
                            <h6><i class="bi bi-person-circle"></i> Informasi Pendaftar</h6>
                            <p><strong>Nama:</strong> {{ $user->name ?? 'Calon Anggota' }}</p>
                            <p><strong>Email:</strong> {{ $user->email ?? '-' }}</p>
                            <p><strong>No. Telepon:</strong> {{ $user->phone ?? '-' }}</p>
                            <p class="mb-0"><strong>Tanggal Pendaftaran:</strong> {{ date('d F Y, H:i') }} WIB</p>
                        </div>
                        @endif

                        <div class="next-steps" data-aos="fade-up" data-aos-delay="300">
                            <h5><i class="bi bi-list-check"></i> Langkah Selanjutnya</h5>
                            <ul class="step-list">
                                <li><i class="bi bi-1-circle-fill text-primary"></i> Bergabung dengan grup WhatsApp</li>
                                <li><i class="bi bi-3-circle-fill text-primary"></i> Dapatkan informasi kegiatan terbaru</li>
                                <li><i class="bi bi-4-circle-fill text-primary"></i> Mulai petualangan bersama CAKRA MANGGALA!</li>
                            </ul>
                        </div>

                        <div class="info-card" data-aos="fade-up" data-aos-delay="400">
                            <h5><i class="bi bi-whatsapp text-success"></i> Bergabung</h5>
                            <p class="mb-3">
                                Yukk bergabung dengan grup WhatsApp Calon Anggota Baru UKM Cakra Manggala untuk mendapatkan informasi terbaru tentang kegiatan, jadwal latihan, dan pengumuman penting lainnya.
                            </p>
                            <a href="https://chat.whatsapp.com/JAT9OtV5e9V3HAw5P3unca" class="whatsapp-btn" target="_blank" data-aos="bounce" data-aos-delay="600">
                                <i class="bi bi-whatsapp"></i>
                                Gabung Grup WhatsApp
                            </a>
                        </div>

                        <div class="mt-4" data-aos="fade-up" data-aos-delay="700">
                            <a href="{{ route('home') }}" class="home-btn">
                                <i class="bi bi-house-fill"></i>
                                Kembali ke Beranda
                            </a>
                            <a href="{{ route('about') }}" class="home-btn" style="background: var(--secondary-color);">
                                <i class="bi bi-info-circle"></i>
                                Tentang Cakra Manggala
                            </a>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted">
                                <small><i class="bi bi-shield-check"></i> Data Anda aman dan akan digunakan sesuai dengan kebijakan privasi kami</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Auto scroll to top
        window.scrollTo(0, 0);
        
        // Add click tracking for WhatsApp button
        const whatsappBtn = document.querySelector('.whatsapp-btn');
        if (whatsappBtn) {
            whatsappBtn.addEventListener('click', function() {
                // You can add analytics tracking here
                console.log('WhatsApp group link clicked');
            });
        }
        
    });
</script>
@endsection