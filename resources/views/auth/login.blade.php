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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Montserrat:wght@600;700;800&display=swap"
        rel="stylesheet">
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
            margin: 0;
            overflow: hidden;
            background: var(--dark);
        }

        h1,
        h2,
        h3 {
            font-family: 'Montserrat', sans-serif;
        }

        .login-wrapper {
            display: flex;
            height: 100vh;
        }

        /* Left: Visual */
        .login-visual {
            flex: 1.2;
            position: relative;
            overflow: hidden;
        }

        .login-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.7;
        }

        .visual-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, var(--dark) 0%, rgba(7, 17, 12, 0.4) 50%, rgba(7, 17, 12, 0.3) 100%);
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            color: white;
        }

        .visual-logo {
            position: absolute;
            top: 3rem;
            left: 3.5rem;
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: white;
            z-index: 10;
        }

        .visual-logo img {
            width: 48px;
            opacity: 1 !important;
        }

        .visual-logo span {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 0.85rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        /* Right: Form */
        .login-form-container {
            flex: 1;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem;
            z-index: 5;
        }

        .login-form-box {
            width: 100%;
            max-width: 380px;
            color: #fff;
        }

        .login-form-box h2 {
            font-weight: 800;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 0.5rem;
            letter-spacing: -0.03em;
        }

        .login-form-box>p {
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 2.5rem;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: rgba(255, 255, 255, 0.4);
            margin-bottom: 0.6rem;
        }

        .form-control {
            border-radius: 0;
            padding: 0.9rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            transition: 0.3s;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: none;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .btn-login {
            background: var(--accent);
            color: var(--primary);
            border: none;
            padding: 1rem;
            border-radius: 0;
            font-weight: 800;
            width: 100%;
            margin-top: 1.5rem;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.85rem;
        }

        .btn-login:hover {
            background: #fff;
            color: var(--primary);
        }

        .form-check-input {
            border-radius: 0;
        }

        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }

        .form-check-label {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }

        .extra-links a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 991px) {
            .login-visual {
                display: none;
            }

            .login-form-container {
                padding: 2.5rem;
            }

            body {
                overflow: auto;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-visual">
            <a href="{{ route('home') }}" class="visual-logo">
                <img src="{{ asset('image/logo.png') }}">
                <span>Cakra Manggala</span>
            </a>
            <img src="{{ asset('image/fotobersejarah2.jpg') }}" alt="Background">
            <div class="visual-overlay">
                <h1 class="display-4 fw-bold" style="letter-spacing: -0.03em;">Mendaki Tinggi,<br><span
                        style="color: var(--accent)">Menjaga Bumi</span></h1>
                <p class="fs-6 mt-3" style="color: rgba(255,255,255,0.6); max-width: 400px;">Panel administrasi khusus
                    pengelola UKM Pecinta Alam Cakra Manggala.</p>
            </div>
        </div>

        <div class="login-form-container">
            <div class="login-form-box">
                <h2>Masuk Admin</h2>
                <p>Kelola portal organisasi dari sini.</p>

                @if ($errors->any())
                    <div class="alert border-0 p-3 small mb-4"
                        style="background: rgba(220,53,69,0.1); color: #ff6b6b; border-left: 3px solid #ff6b6b !important;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="admin@cakramanggala.id" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <div class="extra-links d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>
                    </div>

                    @if ($recaptchaEnabled)
                        <div class="mb-4">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        </div>
                    @endif

                    <button type="submit" class="btn-login">Masuk Sekarang</button>
                </form>

                <div class="text-center mt-5">
                    <a href="{{ route('home') }}" class="text-white-50 text-decoration-none small">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>