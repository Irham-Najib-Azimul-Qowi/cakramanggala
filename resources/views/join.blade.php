@extends('layouts.app')

@section('title', 'Bergabung - UKM Cakra Manggala')

@section('content')
    @php
        $jurusanOptions = ['Teknik', 'Akuntansi', 'Administrasi Bisnis', 'Teknik Informatika', 'Teknik Mesin', 'Teknik Sipil', 'Teknik Listrik', 'Teknik Kimia'];
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
                padding: clamp(4rem, 8vw, 8rem) 0;
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

            /* Stepper UI */
            .join-stepper {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1rem;
                margin-bottom: 4rem;
                position: relative;
            }

            .join-step {
                position: relative;
                text-align: center;
            }

            .join-step__icon-box {
                width: 54px;
                height: 54px;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid rgba(255, 255, 255, 0.1);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                font-size: 1.4rem;
                color: rgba(255, 255, 255, 0.2);
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .join-step__label {
                font-size: 0.65rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.15em;
                color: rgba(255, 255, 255, 0.2);
                transition: all 0.5s;
            }

            .join-step.is-active .join-step__icon-box {
                background: var(--accent-color);
                color: var(--primary-color);
                border-color: var(--accent-color);
                box-shadow: 0 0 30px rgba(242, 182, 97, 0.15);
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

            /* Panel Transitions */
            .join-panel {
                display: none;
            }

            .join-panel.is-active {
                display: block;
                animation: joinFadeSlide 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            }

            @keyframes joinFadeSlide {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .panel-header {
                margin-bottom: 3rem;
            }

            .panel-title {
                font-size: 1.5rem;
                font-weight: 800;
                letter-spacing: -0.01em;
                margin-bottom: 0.5rem;
                color: #fff;
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
                font-size: 0.7rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: rgba(255, 255, 255, 0.5);
                margin-bottom: 0.8rem;
                display: block;
            }

            .form-control,
            .form-select {
                background: rgba(0, 0, 0, 0.15);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 0;
                padding: 1.1rem 1.4rem;
                color: #fff;
                font-weight: 600;
                transition: all 0.3s ease;
                min-height: 58px;
            }

            .form-control:focus,
            .form-select:focus {
                background: rgba(0, 0, 0, 0.25);
                border-color: var(--accent-color);
                box-shadow: none;
                color: #fff;
            }

            .form-control::placeholder {
                color: rgba(255, 255, 255, 0.15);
            }

            .form-select option {
                background: #1a1a1a !important;
                color: #ffffff !important;
            }

            /* Buttons */
            .join-actions {
                display: flex;
                justify-content: space-between;
                margin-top: 3.5rem;
                padding-top: 2.5rem;
                border-top: 1px solid rgba(255, 255, 255, 0.06);
            }

            .btn-join-nav {
                padding: 1.1rem 2.22rem;
                font-weight: 900;
                text-transform: uppercase;
                letter-spacing: 0.15em;
                font-size: 0.75rem;
                display: flex;
                align-items: center;
                gap: 0.8rem;
                transition: all 0.3s;
                border: none;
                border-radius: 0;
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
                background: rgba(0, 0, 0, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.08);
                padding: 3rem 1.5rem;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s;
            }

            .upload-zone:hover {
                border-color: var(--accent-color);
                background: rgba(242, 182, 97, 0.03);
            }

            .upload-icon {
                font-size: 2.5rem;
                color: var(--accent-color);
                margin-bottom: 1rem;
                display: block;
            }

            /* Review Item */
            .review-item {
                background: rgba(0, 0, 0, 0.12);
                padding: 1.25rem;
                border: 1px solid rgba(255, 255, 255, 0.03);
                height: 100%;
            }

            .review-label {
                font-size: 0.6rem;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: rgba(255, 255, 255, 0.3);
                margin-bottom: 0.4rem;
            }

            .review-value {
                font-weight: 700;
                color: #fff;
                font-size: 1rem;
            }

            .btn-back-exit {
                position: fixed;
                top: 1.5rem;
                left: 1.5rem;
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
                .join-stepper {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 1rem;
                }

                .join-card {
                    padding: 2rem 1.5rem;
                }

                .btn-back-exit {
                    top: 1rem;
                    left: 1rem;
                    width: 44px;
                    height: 44px;
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
                <header class="join-header" data-aos="fade-down">
                    <span class="join-header__label">OPEN RECRUITMENT</span>
                    <h1 class="join-header__title">GABUNG CAKRA MANGGALA</h1>
                    <p class="join-header__desc">Jadilah bagian dari penjaga rimba dan pengembara cakrawala.</p>
                </header>

                <div class="join-stepper" data-aos="fade-up" data-aos-delay="100">
                    @foreach($steps as $index => $step)
                        <div class="join-step {{ $index === 1 ? 'is-active' : '' }}" data-step-indicator="{{ $index }}">
                            <div class="join-step__icon-box">
                                <i class="bi {{ $step['icon'] }}"></i>
                            </div>
                            <span class="join-step__label">{{ $step['label'] }}</span>
                        </div>
                    @endforeach
                </div>

                <form id="joinForm" action="{{ route('join.store') }}" method="POST" enctype="multipart/form-data"
                    class="join-card" data-aos="fade-up" data-aos-delay="200">
                    @csrf

                    @if($errors->any())
                        <div class="alert alert-danger mb-5 rounded-0 border-0 bg-danger text-white py-3 px-4">
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
                                        placeholder="Ahmad Fauzi" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                        <option value="">Pilih...</option>
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
                                    <label class="form-label">Unggah Foto Diri</label>
                                    <label for="foto_diri" class="upload-zone w-100">
                                        <span class="upload-icon"><i class="bi bi-camera"></i></span>
                                        <p class="fw-bold mb-1">KLIK UNTUK UNGGAH FOTO</p>
                                        <p class="small text-white-50">Format JPG/PNG/WEBP/HEIC/HEIF, Maksimal 2MB</p>
                                        <input type="file" name="foto_diri" id="foto_diri" hidden accept="image/*">
                                        <div id="fileSelected" class="mt-2 text-accent fw-bold" style="display:none;">
                                            <i class="bi bi-check-circle-fill"></i> Foto terpilih
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
                            <div class="col-12 mt-4">
                                <div class="form-check d-flex gap-3 p-0">
                                    <input class="form-check-input flex-shrink-0" type="checkbox" name="konfirmasi"
                                        id="konfirmasi" required style="width: 20px; height: 20px; margin: 0;">
                                    <label class="form-check-label small text-white-50" for="konfirmasi">
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
                            <button type="submit" class="btn-join-nav btn-join-submit" id="btnSubmit"
                                style="display: none;">
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
            const panels = document.querySelectorAll('.join-panel');
            const indicators = document.querySelectorAll('.join-step');

            function updateUI() {
                panels.forEach(p => p.classList.toggle('is-active', parseInt(p.dataset.stepPanel) === currentStep));
                indicators.forEach(s => {
                    const idx = parseInt(s.dataset.stepIndicator);
                    s.classList.toggle('is-active', idx === currentStep);
                    s.classList.toggle('is-complete', idx < currentStep);
                });

                document.getElementById('btnPrev').style.visibility = (currentStep === 1) ? 'hidden' : 'visible';

                if (currentStep === panels.length) {
                    document.getElementById('btnNext').style.display = 'none';
                    document.getElementById('btnSubmit').style.display = 'flex';

                    document.getElementById('summary-nama').textContent = document.getElementById('nama_lengkap').value || '-';
                    document.getElementById('summary-nim').textContent = document.getElementById('nim').value || '-';
                } else {
                    document.getElementById('btnNext').style.display = 'flex';
                    document.getElementById('btnSubmit').style.display = 'none';
                }

                if (currentStep > 1) {
                    document.querySelector('.join-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            document.getElementById('btnNext').addEventListener('click', () => {
                const currentPanel = document.querySelector(`.join-panel[data-step-panel="${currentStep}"]`);
                const requiredInputs = currentPanel.querySelectorAll('[required]');
                let isValid = true;

                requiredInputs.forEach(input => {
                    if (!input.value || (input.type === 'checkbox' && !input.checked)) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (isValid) {
                    currentStep++;
                    updateUI();
                } else {
                    currentPanel.querySelector('.is-invalid').focus();
                }
            });

            document.getElementById('btnPrev').addEventListener('click', () => {
                if (currentStep > 1) {
                    currentStep--;
                    updateUI();
                }
            });

            document.getElementById('foto_diri').addEventListener('change', function () {
                const feedback = document.getElementById('fileSelected');
                if (this.files[0]) {
                    feedback.style.display = 'block';
                }
            });

            // Final Submit Validation
            document.getElementById('btnSubmit').addEventListener('click', function (e) {
                const currentPanel = document.querySelector(`.join-panel[data-step-panel="${currentStep}"]`);
                const requiredInputs = currentPanel.querySelectorAll('[required]');
                let isValid = true;

                requiredInputs.forEach(input => {
                    if (!input.value || (input.type === 'checkbox' && !input.checked)) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    currentPanel.querySelector('.is-invalid').focus();
                } else {
                    // Update button UI to show processing
                    const btn = this;
                    btn.disabled = true;
                    btn.innerHTML = 'MEMPROSES... <span class="spinner-border spinner-border-sm ms-2"></span>';
                }
            });

            updateUI();
        });
    </script>

    @if(config('services.recaptcha.enabled') && config('services.recaptcha.site_key'))
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
        <script>
            document.getElementById('joinForm').addEventListener('submit', function (e) {
                const form = this;
                if (form.getAttribute('data-recaptcha-ready') === 'true') return;

                e.preventDefault();

                // Set timeout for recaptcha, if it takes too long just submit
                const recaptchaTimeout = setTimeout(() => {
                    console.warn('reCAPTCHA timeout, submitting normally');
                    form.setAttribute('data-recaptcha-ready', 'true');
                    form.submit();
                }, 5000);

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
                    }).catch(err => {
                        console.error('reCAPTCHA error:', err);
                        clearTimeout(recaptchaTimeout);
                        form.setAttribute('data-recaptcha-ready', 'true');
                        form.submit();
                    });
                });
            });
        </script>
    @endif
@endpush