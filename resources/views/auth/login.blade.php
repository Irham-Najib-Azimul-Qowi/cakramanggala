{{-- File: resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UKM Mapala Cakra Manggala</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #4caf50;
            --accent-color: #ff6b35;
            --dark-color: #1b5e20;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            margin: auto;
        }
        
        .login-left {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 400px;
        }
        
        .login-right {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 400px;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
            object-fit: contain;
        }
        
        .btn-login {
            background: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .btn-login:hover {
            background: var(--dark-color);
            transform: translateY(-2px);
        }
        
        .btn-login:disabled {
            background: #6c757d;
            transform: none;
            cursor: not-allowed;
        }
        
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }
        
        .input-group-text {
            border: 2px solid #e9ecef;
            border-right: none;
            background-color: #f8f9fa;
        }
        
        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
        }
        
        .g-recaptcha {
            transform: scale(1);
            transform-origin: 0 0;
            margin-bottom: 1rem;
        }
        
        /* Responsive Design */
        @media (max-width: 991.98px) {
            .login-container {
                max-width: 500px;
            }
            
            .login-left {
                padding: 2rem;
                min-height: 300px;
            }
            
            .login-right {
                padding: 2rem;
                min-height: auto;
            }
            
            .logo {
                width: 60px;
                height: 60px;
            }
            
            h2, h3 {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 767.98px) {
            body {
                padding: 0.5rem;
            }
            
            .login-container {
                margin: 0.5rem;
                border-radius: 15px;
            }
            
            .login-left {
                padding: 1.5rem;
                min-height: 250px;
            }
            
            .login-right {
                padding: 1.5rem;
            }
            
            .logo {
                width: 50px;
                height: 50px;
            }
            
            h2, h3 {
                font-size: 1.3rem;
                margin-bottom: 0.5rem;
            }
            
            .fs-5 {
                font-size: 1rem !important;
            }
            
            .form-control, .input-group-text {
                font-size: 0.9rem;
            }
            
            .btn-login {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 575.98px) {
            .login-left {
                padding: 1rem;
                min-height: 200px;
            }
            
            .login-right {
                padding: 1rem;
            }
            
            .g-recaptcha {
                transform: scale(0.9);
                transform-origin: 0 0;
            }
            
            .form-control, .input-group-text {
                font-size: 0.85rem;
                padding: 0.6rem 0.8rem;
            }
            
            .btn-login {
                font-size: 0.85rem;
            }
        }
        
        /* reCAPTCHA responsive */
        @media (max-width: 400px) {
            .g-recaptcha {
                transform: scale(0.8);
            }
        }
        
        @media (max-width: 350px) {
            .g-recaptcha {
                transform: scale(0.7);
            }
        }
        
        /* Loading state */
        .btn-login.loading {
            pointer-events: none;
        }
        
        .btn-login.loading::after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        @keyframes button-loading-spinner {
            from {
                transform: translate(-50%, -50%) rotate(0turn);
            }
            to {
                transform: translate(-50%, -50%) rotate(1turn);
            }
        }
        
        .btn-login.loading .btn-text {
            visibility: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="login-container">
                    <div class="row g-0">
                        <!-- Left Side -->
                        <div class="col-lg-6 login-left">
                            <img src="{{ asset('image/logo.png') }}" alt="Logo Cakra Manggala" class="logo">
                            <h2 class="fw-bold mb-2">UKM Mapala</h2>
                            <h3 class="fw-bold mb-3">Cakra Manggala</h3>
                            <div style="width: 80px; height: 3px; background-color: white; margin: 1rem auto;"></div>
                            <p class="fs-5 fst-italic mb-3">Tabah, Tangguh, Terampil</p>
                            <p class="opacity-75 d-none d-lg-block">Masuk ke dashboard untuk mengelola website dan data UKM Mapala Cakra Manggala</p>
                        </div>
                        
                        <!-- Right Side -->
                        <div class="col-lg-6 login-right">
                            <div class="mb-4">
                                <h4 class="fw-bold text-dark mb-2">Selamat Datang Kembali!</h4>
                                <p class="text-muted">Silakan masuk ke akun yang terdaftar</p>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}" id="loginForm">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                                            <i class="bi bi-envelope text-muted"></i>
                                        </span>
                                        <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" 
                                               placeholder="Masukkan email Anda" required style="border-radius: 0 10px 10px 0;"
                                               autocomplete="email">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                                            <i class="bi bi-lock text-muted"></i>
                                        </span>
                                        <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                               id="password" name="password" 
                                               placeholder="Masukkan password Anda" required style="border-radius: 0 10px 10px 0;"
                                               autocomplete="current-password">
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label text-muted" for="remember">
                                            Ingat saya
                                        </label>
                                    </div>
                                </div>

                                <!-- Google reCAPTCHA -->
                                <div class="mb-3">
                                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                    @error('g-recaptcha-response')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-login text-white w-100 mb-3" id="loginBtn">
                                    <span class="btn-text">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                                    </span>
                                </button>
                            </form>

                            <div class="text-center mt-4">
                                <a href="{{ route('home') }}" class="text-decoration-none text-muted">
                                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Handle form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('loginBtn');
            const recaptchaResponse = grecaptcha.getResponse();
            
            // Check if reCAPTCHA is completed
            if (!recaptchaResponse) {
                e.preventDefault();
                alert('Mohon selesaikan verifikasi reCAPTCHA terlebih dahulu.');
                return;
            }
            
            // Add loading state
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // Reset reCAPTCHA on page load if there are errors
        window.addEventListener('load', function() {
            if (loginConfig.hasErrors && typeof grecaptcha !== 'undefined') {
                grecaptcha.reset();
            }
        });

        // Handle reCAPTCHA callback
        function onRecaptchaSuccess() {
            // Optional: You can add custom logic here when reCAPTCHA is completed
        }

        // Responsive reCAPTCHA scaling
        function scaleRecaptcha() {
            const recaptcha = document.querySelector('.g-recaptcha');
            if (recaptcha) {
                const width = Math.min(window.innerWidth - 40, 304); // 304 is default reCAPTCHA width
                const scale = width / 304;
                recaptcha.style.transform = `scale(${scale})`;
            }
        }

        // Scale reCAPTCHA on window resize
        window.addEventListener('resize', scaleRecaptcha);
        window.addEventListener('load', scaleRecaptcha);
    </script>
</body>
</html>