{{-- File: resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
@php
    $recaptchaEnabled = config('services.recaptcha.enabled')
        && config('services.recaptcha.site_key')
        && config('services.recaptcha.secret_key');
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Cakra Manggala</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    @if ($recaptchaEnabled)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <style>
        :root {
            --primary: #1a4331;
            --secondary: #255b44;
            --accent: #f2b661;
            --dark: #07110c;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8faf8;
            margin: 0;
            overflow: hidden;
        }

        h1, h2, h3, .brand-text {
            font-family: 'Montserrat', sans-serif;
        }

        .login-wrapper {
            display: flex;
            height: 100vh;
        }

        /* Left Side: Visual */
        .login-visual {
            flex: 1.2;
            position: relative;
            background: var(--dark);
            overflow: hidden;
        }

        .login-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
            transition: 1s ease;
        }

        .login-visual:hover img {
            transform: scale(1.05);
        }

        .visual-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(7, 17, 12, 0.9), transparent);
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            color: white;
        }

        .visual-logo {
            position: absolute;
            top: 4rem;
            left: 4rem;
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: white;
            z-index: 10;
        }

        .visual-logo img {
            width: 60px;
            opacity: 1 !important;
        }

        /* Right Side: Form */
        .login-form-container {
            flex: 1;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem;
            box-shadow: -20px 0 60px rgba(0,0,0,0.05);
            z-index: 5;
        }

        .login-form-box {
            width: 100%;
            max-width: 400px;
        }

        .login-form-box h2 {
            font-weight: 800;
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .login-form-box p {
            color: #666;
            margin-bottom: 2.5rem;
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #444;
            margin-bottom: 10px;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.85rem 1.2rem;
            border: 1.5px solid #eee;
            background: #fcfcfc;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(26, 67, 49, 0.1);
            background: white;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 1rem;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(26, 67, 49, 0.2);
            filter: brightness(1.1);
        }

        .extra-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        .extra-links a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 600;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 991px) {
            .login-visual { display: none; }
            .login-form-container { padding: 2rem; }
            body { overflow: auto; }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-visual">
            <a href="{{ route('home') }}" class="visual-logo">
                <img src="{{ asset('image/logo.png') }}">
                <span class="fs-4 fw-bold">Cakra Manggala</span>
            </a>
            <img src="/adventure_nature_background_1776835811654.png" alt="Nature background">
            <div class="visual-overlay">
                <h1 class="display-3 fw-bold">Mendaki Tinggi,<br><span style="color: var(--accent)">Menjaga Bumi</span></h1>
                <p class="fs-5 opacity-75">Panel Administrasi Khusus Pengelola UKM Cakra Manggala.</p>
            </div>
        </div>

        <div class="login-form-container">
            <div class="login-form-box">
                <h2>Selamat Datang</h2>
                <p>Silakan masuk untuk mengelola portal admin.</p>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-4 py-3 small mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Email Admin</label>
                        <div class="position-relative">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="admin@cakramanggala.id" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label mb-0">Password</label>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <div class="extra-links mb-4 mt-0">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>
                        <a href="#">Lupa Password?</a>
                    </div>

                    @if ($recaptchaEnabled)
                        <div class="mb-4">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        </div>
                    @endif

                    <button type="submit" class="btn-login">Masuk Sekarang</button>
                </form>

                <div class="text-center mt-5">
                    <a href="{{ route('home') }}" class="text-muted text-decoration-none small">
                        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
