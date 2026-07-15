@extends('layouts.app')

@section('title', 'Bagikan Cerita Perjalananmu')

@push('styles')
    <style>
        /* Hide Navbar & Footer for focused experience */
        .site-navbar,
        .footer {
            display: none !important;
        }

        main {
            padding-top: 0 !important;
        }

        .join-page-wrapper {
            background-color: var(--dark-color);
            color: #fff;
            position: relative;
            overflow-x: hidden;
            padding: clamp(6rem, 9vw, 9rem) 0 clamp(4rem, 8vw, 8rem) 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* Decorative Background Elements */
        .join-bg-accent {
            position: absolute;
            top: -10%;
            right: -5%;
            width: 40vw;
            height: 40vw;
            background: radial-gradient(circle, rgba(242, 182, 97, 0.05) 0%, transparent 70%);
            z-index: 1;
            pointer-events: none;
        }

        .join-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header Section */
        .join-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .join-header__label {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
            display: block;
        }

        .join-header__title {
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .join-header__desc {
            color: rgba(255, 255, 255, 0.5);
            font-size: 1.05rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Main Form Card */
        .join-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 50px 100px rgba(0, 0, 0, 0.4);
            padding: clamp(2rem, 5vw, 4rem);
            position: relative;
            overflow: hidden;
        }

        .join-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--accent-color);
        }

        .panel-header {
            margin-bottom: 3rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 1.5rem;
        }

        .panel-title {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.01em;
            margin-bottom: 0.5rem;
            color: #fff;
            text-transform: uppercase;
        }

        .panel-desc {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.9rem;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.8rem;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0.8rem;
            display: block;
        }

        .form-control,
        .form-select {
            background: rgba(0, 0, 0, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 0 !important;
            padding: 1.1rem 1.4rem !important;
            color: #fff !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            min-height: 58px;
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(0, 0, 0, 0.25) !important;
            border-color: var(--accent-color) !important;
            box-shadow: none !important;
            color: #fff !important;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.25) !important;
        }

        .form-select option {
            background: #1a1a1a !important;
            color: #ffffff !important;
        }

        /* Buttons */
        .btn-join-nav {
            padding: 1.1rem 2.22rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            transition: all 0.3s;
            border: none;
            border-radius: 0;
            text-decoration: none;
        }

        .btn-join-prev {
            background: rgba(255, 255, 255, 0.04);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-join-prev:hover {
            background: #fff;
            color: var(--primary-color);
        }

        .btn-join-submit {
            background: var(--accent-color);
            color: var(--primary-color);
        }

        .btn-join-submit:hover {
            background: #fff;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .btn-back-exit {
            position: absolute;
            top: 2.5rem;
            left: 2.5rem;
            z-index: 100;
            width: 54px;
            height: 54px;
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.25rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-back-exit:hover {
            background: var(--accent-color);
            color: var(--primary-color);
            border-color: var(--accent-color);
        }

        @media (max-width: 768px) {
            .btn-back-exit {
                top: 1rem;
                left: 1rem;
                width: 44px;
                height: 44px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="join-page-wrapper">
        <div class="join-bg-accent"></div>

        <a href="{{ route('catatan-perjalanan.index') }}" class="btn-back-exit" title="Kembali ke Catatan Perjalanan">
            <i class="bi bi-arrow-left"></i>
        </a>

        <div class="container">
            <div class="join-container">
                <header class="join-header" data-aos="fade-down">
                    <span class="join-header__label">BAGIKAN PENGALAMAN</span>
                    <h1 class="join-header__title">TAMBAHKAN PENGALAMANMU</h1>
                    <p class="join-header__desc">Bagikan catatan perjalanan, diklat, atau petualangan Anda dengan keluarga besar Cakramanggala.</p>
                </header>

                @if(session('success_otp'))
                    <div class="alert alert-success border-0 rounded-0 shadow-sm p-4 mb-4 d-flex align-items-start gap-3" style="background: rgba(46, 125, 50, 0.15); border-left: 4px solid var(--accent-color) !important; color: #fff;">
                        <i class="bi bi-envelope-check-fill text-accent fs-4"></i>
                        <div>
                            <h4 class="alert-heading fw-bold fs-6 text-accent mb-1">KODE OTP TERKIRIM</h4>
                            <p class="mb-0 text-white-50 small">{{ session('success_otp') }}</p>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-0 shadow-sm p-4 mb-4 d-flex align-items-start gap-3" style="background: rgba(198, 40, 40, 0.15); border-left: 4px solid #c62828 !important; color: #fff;">
                        <i class="bi bi-exclamation-triangle-fill text-danger fs-4"></i>
                        <div>
                            <h4 class="alert-heading fw-bold fs-6 text-danger mb-1">TERJADI KESALAHAN</h4>
                            <ul class="mb-0 ps-3 small text-white-50">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="join-card" data-aos="fade-up" data-aos-delay="200">
                    @if(session()->has('travel_log_otp') && !now()->gt(session('travel_log_otp_expires')))
                        <!-- STEP 2: OTENTIKASI & FORM CATATAN -->
                        <div class="panel-header d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="panel-title">Tulis Pengalaman</h2>
                                <p class="panel-desc">Langkah 2 dari 2: Lengkapi catatan perjalanan Anda.</p>
                            </div>
                            <form action="{{ route('catatan-perjalanan.reset') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-light rounded-0 px-3 fw-bold" style="font-size: 0.75rem;">
                                    <i class="bi bi-arrow-left-circle me-1"></i> RESET / KEMBALI
                                </button>
                            </form>
                        </div>

                        <form action="{{ route('catatan-perjalanan.simpan') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- OTP INPUT -->
                                <div class="col-12 mb-4">
                                    <div style="background: rgba(0, 0, 0, 0.25); padding: 1.5rem; border: 1px dashed rgba(255, 255, 255, 0.15);">
                                        <label class="form-label text-center d-block">
                                            KODE OTP EMAIL <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="otp" class="form-control text-center fw-black letter-spacing-lg @error('otp') is-invalid @enderror" 
                                            value="{{ old('otp') }}" placeholder="Masukkan 6 Digit OTP" required
                                            style="font-size: 1.5rem; letter-spacing: 0.2em; max-width: 300px; margin: 0 auto; height: 55px; border: 2px solid var(--accent-color) !important; background: rgba(0, 0, 0, 0.3) !important;">
                                        <div class="text-center mt-2 x-small text-white-50">
                                            Masukkan kode verifikasi yang telah dikirim ke email <strong>{{ session('travel_log_email') }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- NAMA LENGKAP -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Nama Lengkap Anda <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                            value="{{ old('nama') }}" placeholder="Contoh: Najib Azimul Qowi" required>
                                    </div>
                                </div>

                                <!-- PILIH KEGIATAN -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Pilih Kegiatan <span class="text-danger">*</span></label>
                                        <select name="kegiatan_id" class="form-select @error('kegiatan_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Kegiatan --</option>
                                            @foreach($kegiatans as $k)
                                                <option value="{{ $k->id }}" {{ old('kegiatan_id') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->judul_kegiatan }} ({{ $k->tahun }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="x-small text-white-50 mt-1">Sesuai kegiatan yang telah didaftarkan Admin.</div>
                                    </div>
                                </div>

                                <!-- JUDUL CATATAN -->
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Judul Cerita Perjalanan <span class="text-danger">*</span></label>
                                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                            value="{{ old('judul') }}" placeholder="Contoh: Perjuangan Menembus Badai Welirang" required>
                                    </div>
                                </div>

                                <!-- GAMBAR UTAMA -->
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label">Gambar Dokumentasi Utama (Opsional)</label>
                                        <input type="file" name="gambar_dokumen" class="form-control @error('gambar_dokumen') is-invalid @enderror" accept="image/*">
                                        <div class="x-small text-white-50 mt-1">Format: JPG, PNG, WEBP, HEIC, HEIF. Maksimal 2MB.</div>
                                    </div>
                                </div>

                                <!-- ISI CATATAN -->
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Isi Cerita Pengalaman <span class="text-danger">*</span></label>
                                        <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" 
                                            rows="12" placeholder="Tuliskan pengalaman Anda secara detail, dari persiapan, perjalanan, kendala, hingga evaluasi..." required style="height: auto; min-height: 250px;">{{ old('konten') }}</textarea>
                                    </div>
                                </div>

                                <!-- SUBMIT BUTTON -->
                                <div class="col-12 mt-4 pt-4 d-flex justify-content-end" style="border-top: 1px solid rgba(255, 255, 255, 0.08);">
                                    <button type="submit" class="btn-join-nav btn-join-submit px-5 py-3">
                                        KIRIM CATATAN PERJALANAN <i class="bi bi-send-fill ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <!-- STEP 1: VALIDASI KEANGGOTAAN -->
                        <div class="panel-header">
                            <h2 class="panel-title">Validasi Keanggotaan</h2>
                            <p class="panel-desc">Langkah 1 dari 2: Validasi NIM dan Email terdaftar.</p>
                        </div>

                        <form action="{{ route('catatan-perjalanan.kirim-otp') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">Alamat Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                            value="{{ old('email') }}" placeholder="Contoh: nama@domain.com" required>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">NIM (Nomor Induk Mahasiswa)</label>
                                        <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" 
                                            value="{{ old('nim') }}" placeholder="Contoh: 210411100001" required>
                                    </div>
                                </div>

                                <div class="col-12 mt-4 pt-4 d-flex justify-content-end" style="border-top: 1px solid rgba(255, 255, 255, 0.08);">
                                    <button type="submit" class="btn-join-nav btn-join-submit px-5 py-3">
                                        KIRIM KODE OTP <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
