@extends('layouts.app')

@section('title', 'Bergabung - UKM Cakra Manggala')

@section('content')
    @php
        $jurusanOptions = ['Teknik', 'Administrasi Bisnis', 'Akuntansi'];
        $steps = [
            1 => ['label' => 'Identitas', 'icon' => 'bi-person-badge'],
            2 => ['label' => 'Akademik', 'icon' => 'bi-mortarboard'],
            3 => ['label' => 'Visi & Misi', 'icon' => 'bi-lightning-charge'],
            4 => ['label' => 'Konfirmasi', 'icon' => 'bi-check2-circle'],
        ];
    @endphp

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
                min-height: 100vh;
                background-color: var(--dark-color);
                color: #fff;
                position: relative;
                overflow-x: hidden;
                display: flex;
                align-items: center;
                padding: clamp(3rem, 6vw, 6rem) 0;
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
                margin-bottom: 2.5rem;
            }

            .join-header__label {
                font-size: 0.75rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.3em;
                color: var(--accent-color);
                margin-bottom: 1rem;
                display: block;
            }

            .join-header__title {
                font-size: clamp(1.8rem, 5vw, 3.2rem);
                font-weight: 800;
                letter-spacing: -0.04em;
                line-height: 1.15;
                margin-bottom: 1rem;
            }

            .join-header__desc {
                color: rgba(255, 255, 255, 0.6);
                font-size: clamp(0.9rem, 2.5vw, 1.05rem);
                max-width: 600px;
                margin: 0 auto;
            }

            /* Stepper UI */
            .mobile-step-indicator {
                display: none;
                background: rgba(255, 255, 255, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 50px;
                padding: 0.6rem 1.25rem;
                text-align: center;
                margin-bottom: 1.5rem;
                font-size: 0.75rem;
                font-weight: 800;
                letter-spacing: 0.1em;
                color: var(--accent-color);
            }

            .join-stepper {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1rem;
                margin-bottom: 3rem;
                position: relative;
            }

            .join-step {
                position: relative;
                text-align: center;
            }

            .join-step__icon-box {
                width: 50px;
                height: 50px;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid rgba(255, 255, 255, 0.1);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 0.75rem;
                font-size: 1.3rem;
                color: rgba(255, 255, 255, 0.3);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                border-radius: 4px;
            }

            .join-step__label {
                font-size: 0.68rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: rgba(255, 255, 255, 0.3);
                transition: all 0.4s;
            }

            .join-step.is-active .join-step__icon-box {
                background: var(--accent-color);
                color: var(--primary-color);
                border-color: var(--accent-color);
                box-shadow: 0 0 25px rgba(242, 182, 97, 0.25);
            }

            .join-step.is-active .join-step__label {
                color: var(--accent-color);
            }

            .join-step.is-complete .join-step__icon-box {
                background: var(--primary-color);
                color: #fff;
                border-color: var(--accent-color);
            }

            .join-step.is-complete .join-step__label {
                color: #fff;
            }

            /* Main Form Card */
            .join-card {
                background: var(--primary-color);
                border: 1px solid rgba(255, 255, 255, 0.08);
                box-shadow: 0 40px 80px rgba(0, 0, 0, 0.5);
                padding: clamp(1.75rem, 4vw, 3.5rem);
                position: relative;
                overflow: hidden;
            }

            .join-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 5px;
                height: 100%;
                background: var(--accent-color);
            }

            /* Panel Transitions */
            .join-panel {
                display: none;
            }

            .join-panel.is-active {
                display: block;
                animation: joinFadeSlide 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            }

            @keyframes joinFadeSlide {
                from {
                    opacity: 0;
                    transform: translateY(15px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .panel-header {
                margin-bottom: 2rem;
            }

            .panel-title {
                font-size: clamp(1.25rem, 3vw, 1.5rem);
                font-weight: 800;
                letter-spacing: -0.01em;
                margin-bottom: 0.4rem;
                color: #fff;
            }

            .panel-desc {
                color: rgba(255, 255, 255, 0.5);
                font-size: 0.88rem;
            }

            /* Form Elements */
            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                font-size: 0.72rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: rgba(255, 255, 255, 0.7);
                margin-bottom: 0.6rem;
                display: block;
            }

            .form-control,
            .form-select {
                background: rgba(0, 0, 0, 0.25);
                border: 1px solid rgba(255, 255, 255, 0.12);
                border-radius: 0;
                padding: 0.9rem 1.2rem;
                color: #fff;
                font-weight: 600;
                font-size: 1rem; /* 16px to prevent iOS auto-zoom */
                transition: all 0.3s ease;
                min-height: 52px;
            }

            .form-control:focus,
            .form-select:focus {
                background: rgba(0, 0, 0, 0.35);
                border-color: var(--accent-color);
                box-shadow: 0 0 15px rgba(242, 182, 97, 0.15);
                color: #fff;
            }

            .form-control::placeholder {
                color: rgba(255, 255, 255, 0.25);
            }

            .form-select option {
                background: #1a1a1a !important;
                color: #ffffff !important;
            }

            .form-control.is-invalid,
            .form-select.is-invalid {
                border-color: #ff5252 !important;
                background-image: none !important;
            }

            /* Buttons */
            .join-actions {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 2.5rem;
                padding-top: 2rem;
                border-top: 1px solid rgba(255, 255, 255, 0.08);
                gap: 1rem;
            }

            .btn-join-nav {
                padding: 0.95rem 2rem;
                font-weight: 900;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                font-size: 0.78rem;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.7rem;
                transition: all 0.3s;
                border: none;
                border-radius: 0;
                min-height: 50px;
                cursor: pointer;
            }

            .btn-join-prev {
                background: rgba(255, 255, 255, 0.05);
                color: #fff;
                border: 1px solid rgba(255, 255, 255, 0.15);
            }

            .btn-join-prev:hover {
                background: #fff;
                color: var(--primary-color);
            }

            .btn-join-next,
            .btn-join-submit {
                background: var(--accent-color);
                color: var(--primary-color);
            }

            .btn-join-next:hover,
            .btn-join-submit:hover {
                background: #fff;
                color: var(--primary-color);
                transform: translateY(-2px);
            }

            /* Photo Upload Zone */
            .upload-zone {
                background: rgba(0, 0, 0, 0.25);
                border: 2px dashed rgba(255, 255, 255, 0.15);
                padding: 2.5rem 1.25rem;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s;
                display: block;
            }

            .upload-zone:hover {
                border-color: var(--accent-color);
                background: rgba(242, 182, 97, 0.04);
            }

            .upload-zone.border-danger {
                border-color: #ff5252 !important;
                background: rgba(255, 82, 82, 0.05) !important;
            }

            .upload-icon {
                font-size: 2.2rem;
                color: var(--accent-color);
                margin-bottom: 0.75rem;
                display: block;
            }

            /* Review Item */
            .review-item {
                background: rgba(0, 0, 0, 0.2);
                padding: 1.25rem;
                border: 1px solid rgba(255, 255, 255, 0.06);
                height: 100%;
            }

            .review-label {
                font-size: 0.65rem;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: rgba(255, 255, 255, 0.4);
                margin-bottom: 0.3rem;
            }

            .review-value {
                font-weight: 700;
                color: #fff;
                font-size: 1rem;
                word-break: break-word;
            }

            .btn-back-exit {
                position: fixed;
                top: 1.25rem;
                left: 1.25rem;
                z-index: 100;
                width: 48px;
                height: 48px;
                background: rgba(26, 26, 26, 0.85);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.15);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 1.2rem;
                text-decoration: none;
                transition: all 0.3s;
                box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            }

            .btn-back-exit:hover {
                background: var(--accent-color);
                color: var(--primary-color);
                border-color: var(--accent-color);
            }

            /* Responsive Mobile Styles */
            @media (max-width: 768px) {
                .join-page-wrapper {
                    padding: 4.5rem 0 3rem;
                }

                .join-header {
                    margin-bottom: 2rem;
                }

                .mobile-step-indicator {
                    display: block;
                }

                .join-stepper {
                    gap: 0.5rem;
                    margin-bottom: 2rem;
                }

                .join-step__icon-box {
                    width: 42px;
                    height: 42px;
                    font-size: 1.1rem;
                    margin-bottom: 0.4rem;
                }

                .join-step__label {
                    font-size: 0.58rem;
                    letter-spacing: 0.05em;
                }

                .join-card {
                    padding: 1.75rem 1.25rem;
                }
            }

            @media (max-width: 576px) {
                .btn-back-exit {
                    top: 0.75rem;
                    left: 0.75rem;
                    width: 40px;
                    height: 40px;
                    font-size: 1rem;
                }

                .join-stepper {
                    grid-template-columns: repeat(4, 1fr);
                }

                .join-step__label {
                    display: none; /* Hidden on very small screens, mobile badge handles label */
                }

                .join-actions {
                    flex-direction: column-reverse;
                    gap: 0.75rem;
                }

                .join-actions > div,
                .btn-join-nav {
                    width: 100%;
                }

                .btn-join-nav {
                    justify-content: center;
                }
            }
        </style>
    @endpush

    <div class="join-page-wrapper">
        <div class="join-bg-accent"></div>

        <a href="{{ route('home') }}" class="btn-back-exit" title="Kembali ke Beranda">
            <i class="bi bi-x-lg"></i>
        </a>

        <div class="container">
            <div class="join-container">
                <header class="join-header">
                    <span class="join-header__label">OPEN RECRUITMENT</span>
                    <h1 class="join-header__title">GABUNG CAKRA MANGGALA</h1>
                    <p class="join-header__desc">Jadilah bagian dari penjaga rimba dan pengembara cakrawala.</p>
                </header>

                <div class="mobile-step-indicator">
                    LANGKAH <span id="currentStepNum">1</span> DARI 4: <span id="currentStepTitle">IDENTITAS DIRI</span>
                </div>

                <div class="join-stepper">
                    @foreach($steps as $index => $step)
                        <div class="join-step {{ $index === 1 ? 'is-active' : '' }}" data-step-indicator="{{ $index }}" data-step-name="{{ strtoupper($step['label']) }}">
                            <div class="join-step__icon-box">
                                <i class="bi {{ $step['icon'] }}"></i>
                            </div>
                            <span class="join-step__label">{{ $step['label'] }}</span>
                        </div>
                    @endforeach
                </div>

                <form id="joinForm" action="{{ route('join.store') }}" method="POST" enctype="multipart/form-data" class="join-card">
                    @csrf

                    @if($errors->any())
                        <div class="alert alert-danger mb-4 rounded-0 border-0 bg-danger text-white py-3 px-4">
                            <ul class="mb-0 small fw-bold">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- PANEL 1: IDENTITAS -->
                    <div class="join-panel is-active" data-step-panel="1">
                        <div class="panel-header">
                            <h2 class="panel-title">Identitas Diri</h2>
                            <p class="panel-desc">Gunakan data asli sesuai identitas KTP/KTM.</p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                        placeholder="Contoh: Ahmad Fauzi" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nomor WhatsApp</label>
                                    <input type="tel" name="no_hp" id="no_hp" class="form-control"
                                        placeholder="08xxxxxxxxxx" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                        placeholder="Kota Kelahiran" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL 2: AKADEMIK -->
                    <div class="join-panel" data-step-panel="2">
                        <div class="panel-header">
                            <h2 class="panel-title">Data Akademik</h2>
                            <p class="panel-desc">Pastikan kamu mahasiswa aktif saat mendaftar.</p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                                    <input type="text" name="nim" id="nim" class="form-control" placeholder="201xxxxxxx"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jurusan</label>
                                    <select name="jurusan" id="jurusan" class="form-select" required>
                                        <option value="">Pilih Jurusan</option>
                                        @foreach($jurusanOptions as $jur)
                                            <option value="{{ $jur }}">{{ $jur }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Program Studi</label>
                                    <input type="text" name="program_studi" id="program_studi" class="form-control"
                                        placeholder="Contoh: D4 Teknik Informatika" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Alamat di Madiun (Kos/Rumah)</label>
                                    <textarea name="alamat" id="alamat" class="form-control"
                                        placeholder="Jl. Serayu No. xxx..." rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL 3: VISI MISI -->
                    <div class="join-panel" data-step-panel="3">
                        <div class="panel-header">
                            <h2 class="panel-title">Motivasi & Visi</h2>
                            <p class="panel-desc">Tunjukkan semangat pengembaraanmu.</p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Pengalaman Organisasi (Opsional)</label>
                                    <textarea name="organisasi_yang_pernah_diikuti" class="form-control"
                                        placeholder="Sebutkan organisasi yang pernah kamu ikuti..." rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Alasan Bergabung</label>
                                    <textarea name="alasan_bergabung" id="alasan_bergabung" class="form-control"
                                        placeholder="Kenapa kamu ingin bergabung dengan Cakra Manggala?" rows="4" required
                                        minlength="20"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL 4: KONFIRMASI -->
                    <div class="join-panel" data-step-panel="4">
                        <div class="panel-header">
                            <h2 class="panel-title">Langkah Terakhir</h2>
                            <p class="panel-desc">Unggah foto dan konfirmasi data pendaftaran.</p>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label class="form-label">Unggah Foto Diri <span class="text-danger fw-bold">* (WAJIB)</span></label>
                                    <label for="foto_diri" class="upload-zone w-100" id="uploadZoneBox">
                                        <span class="upload-icon"><i class="bi bi-camera"></i></span>
                                        <p class="fw-bold mb-1 text-uppercase" style="letter-spacing:0.08em;">KLIK UNTUK UNGGAH FOTO WAJIB</p>
                                        <p class="small text-white-50 mb-0">Format JPG/PNG/WEBP/HEIC/HEIF, Maksimal 2MB</p>
                                        <input type="file" name="foto_diri" id="foto_diri" hidden accept="image/*" required>
                                        <div id="fileSelected" class="mt-2 text-accent fw-bold small" style="display:none;">
                                            <i class="bi bi-check-circle-fill me-1"></i> <span id="fileNameText">Foto terpilih</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-item">
                                    <div class="review-label">Pendaftar</div>
                                    <div class="review-value" id="summary-nama">-</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-item">
                                    <div class="review-label">NIM</div>
                                    <div class="review-value" id="summary-nim">-</div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-check d-flex gap-3 p-0 align-items-center">
                                    <input class="form-check-input flex-shrink-0" type="checkbox" name="konfirmasi"
                                        id="konfirmasi" required style="width: 22px; height: 22px; margin: 0; cursor: pointer;">
                                    <label class="form-check-label small text-white-50" for="konfirmasi" style="cursor: pointer;">
                                        Saya menyatakan bahwa seluruh data yang diisi adalah benar dan bersedia mengikuti
                                        prosedur yang berlaku.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="join-actions">
                        <button type="button" class="btn-join-nav btn-join-prev" id="btnPrev">
                            <i class="bi bi-arrow-left"></i> SEBELUMNYA
                        </button>
                        <div>
                            <button type="button" class="btn-join-nav btn-join-next" id="btnNext">
                                LANJUTKAN <i class="bi bi-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn-join-nav btn-join-submit" id="btnSubmit" style="display: none;">
                                SUBMIT FORM <i class="bi bi-shield-check"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentStep = 1;
            const form = document.getElementById('joinForm');
            const panels = document.querySelectorAll('.join-panel');
            const indicators = document.querySelectorAll('.join-step');
            const btnPrev = document.getElementById('btnPrev');
            const btnNext = document.getElementById('btnNext');
            const btnSubmit = document.getElementById('btnSubmit');
            const currentStepNum = document.getElementById('currentStepNum');
            const currentStepTitle = document.getElementById('currentStepTitle');

            function updateUI() {
                panels.forEach(p => p.classList.toggle('is-active', parseInt(p.dataset.stepPanel) === currentStep));
                
                indicators.forEach(s => {
                    const idx = parseInt(s.dataset.stepIndicator);
                    s.classList.toggle('is-active', idx === currentStep);
                    s.classList.toggle('is-complete', idx < currentStep);
                    if (idx === currentStep && s.dataset.stepName) {
                        if (currentStepNum) currentStepNum.textContent = currentStep;
                        if (currentStepTitle) currentStepTitle.textContent = s.dataset.stepName;
                    }
                });

                btnPrev.style.visibility = (currentStep === 1) ? 'hidden' : 'visible';

                if (currentStep === panels.length) {
                    btnNext.style.display = 'none';
                    btnSubmit.style.display = 'inline-flex';

                    document.getElementById('summary-nama').textContent = document.getElementById('nama_lengkap').value || '-';
                    document.getElementById('summary-nim').textContent = document.getElementById('nim').value || '-';
                } else {
                    btnNext.style.display = 'inline-flex';
                    btnSubmit.style.display = 'none';
                }

                if (currentStep > 1) {
                    document.querySelector('.join-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            function validatePanel(panelNumber) {
                const panel = document.querySelector(`.join-panel[data-step-panel="${panelNumber}"]`);
                if (!panel) return true;
                const requiredInputs = panel.querySelectorAll('[required]');
                let isValid = true;
                let firstInvalid = null;

                requiredInputs.forEach(input => {
                    let fieldValid = true;
                    if (input.type === 'checkbox') {
                        fieldValid = input.checked;
                    } else if (input.type === 'file') {
                        fieldValid = input.files && input.files.length > 0;
                    } else {
                        fieldValid = input.value && input.value.trim() !== '';
                        if (fieldValid && input.hasAttribute('minlength')) {
                            fieldValid = input.value.trim().length >= parseInt(input.getAttribute('minlength'));
                        }
                    }

                    if (!fieldValid) {
                        input.classList.add('is-invalid');
                        if (input.type === 'file') {
                            const uploadZone = document.getElementById('uploadZoneBox');
                            if (uploadZone) uploadZone.classList.add('border-danger');
                        }
                        isValid = false;
                        if (!firstInvalid) firstInvalid = input;
                    } else {
                        input.classList.remove('is-invalid');
                        if (input.type === 'file') {
                            const uploadZone = document.getElementById('uploadZoneBox');
                            if (uploadZone) uploadZone.classList.remove('border-danger');
                        }
                    }
                });

                if (!isValid && firstInvalid) {
                    firstInvalid.focus();
                }

                return isValid;
            }

            btnNext.addEventListener('click', function () {
                if (validatePanel(currentStep)) {
                    currentStep++;
                    updateUI();
                }
            });

            btnPrev.addEventListener('click', function () {
                if (currentStep > 1) {
                    currentStep--;
                    updateUI();
                }
            });

            const fotoInput = document.getElementById('foto_diri');
            if (fotoInput) {
                fotoInput.addEventListener('change', function () {
                    const feedback = document.getElementById('fileSelected');
                    const fileNameText = document.getElementById('fileNameText');
                    const uploadZoneBox = document.getElementById('uploadZoneBox');
                    if (this.files && this.files[0]) {
                        if (fileNameText) fileNameText.textContent = this.files[0].name;
                        feedback.style.display = 'block';
                        this.classList.remove('is-invalid');
                        if (uploadZoneBox) uploadZoneBox.classList.remove('border-danger');
                    }
                });
            }

            // Unified Submit Listener
            form.addEventListener('submit', function (e) {
                // Check all panels starting from panel 1 to 4
                for (let step = 1; step <= panels.length; step++) {
                    if (!validatePanel(step)) {
                        e.preventDefault();
                        if (currentStep !== step) {
                            currentStep = step;
                            updateUI();
                        }
                        return false;
                    }
                }

                // If recaptcha is enabled and script ready flag not set
                if (form.getAttribute('data-recaptcha-ready') === 'true') {
                    // Update button UI to loading state
                    btnSubmit.style.pointerEvents = 'none';
                    btnSubmit.style.opacity = '0.8';
                    btnSubmit.innerHTML = 'MEMPROSES... <span class="spinner-border spinner-border-sm ms-2"></span>';
                    return true;
                }

                @if(config('services.recaptcha.enabled') && config('services.recaptcha.site_key'))
                    e.preventDefault();

                    btnSubmit.style.pointerEvents = 'none';
                    btnSubmit.style.opacity = '0.8';
                    btnSubmit.innerHTML = 'MEMPROSES... <span class="spinner-border spinner-border-sm ms-2"></span>';

                    const recaptchaTimeout = setTimeout(function () {
                        console.warn('reCAPTCHA timeout fallback triggered');
                        form.setAttribute('data-recaptcha-ready', 'true');
                        form.submit();
                    }, 3000);

                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.ready(function () {
                            grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'join_ukm' }).then(function (token) {
                                clearTimeout(recaptchaTimeout);
                                let input = document.getElementById('g-recaptcha-response');
                                if (!input) {
                                    input = document.createElement('input');
                                    input.type = 'hidden';
                                    input.name = 'g-recaptcha-response';
                                    input.id = 'g-recaptcha-response';
                                    form.appendChild(input);
                                }
                                input.value = token;
                                form.setAttribute('data-recaptcha-ready', 'true');
                                form.submit();
                            }).catch(function (err) {
                                console.error('reCAPTCHA error:', err);
                                clearTimeout(recaptchaTimeout);
                                form.setAttribute('data-recaptcha-ready', 'true');
                                form.submit();
                            });
                        });
                    } else {
                        clearTimeout(recaptchaTimeout);
                        form.setAttribute('data-recaptcha-ready', 'true');
                        form.submit();
                    }
                @else
                    btnSubmit.style.pointerEvents = 'none';
                    btnSubmit.style.opacity = '0.8';
                    btnSubmit.innerHTML = 'MEMPROSES... <span class="spinner-border spinner-border-sm ms-2"></span>';
                @endif
            });

            updateUI();
        });
    </script>
@endpush