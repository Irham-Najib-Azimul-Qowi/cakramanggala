{{-- File: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UKM Cakra Manggala')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #4caf50;
            --accent-color: #ff6b35;
            --dark-color: #1b5e20;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Sticky Navbar */
        .navbar {
            background: rgba(46, 125, 50, 0.95) !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            padding: 1rem 0;
        }
        
        .navbar.scrolled {
            background: rgba(46, 125, 50, 0.98) !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem !important;
        }
        
        .navbar-nav .nav-link:hover {
            color: #ffeb3b !important;
            transform: translateY(-2px);
        }

        /* Logo Section Responsive */
        .logo-section {
            display: flex;
            align-items: center;
        }

        .logo-section img {
            width: 70px;
            height: 70px;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-title {
            font-weight: bold;
            color: white;
            font-size: 1.5rem;
        }

        .logo-divider {
            width: 160px;
            height: 2px;
            background-color: black;
            margin: 2px 0;
        }

        .logo-subtitle {
            font-style: italic;
            color: #e8f5e8;
            font-size: 0.9rem;
        }

        /* Navbar Toggler Custom */
        .navbar-toggler {
            border: 2px solid white;
            padding: 4px 8px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Login Button */
        .btn-login {
            background-color: white;
            color: var(--primary-color);
            border: 2px solid white;
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            background-color: transparent;
            color: white;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 80vh;
            display: flex;
            align-items: center;
            color: white;
            overflow: hidden;
            z-index: 1;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            animation: bgSlider 18s infinite;
            z-index: -2;
            opacity: 0.5;
        }
        .hero-section::after {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        @keyframes bgSlider {
            0%   { background-image: url('/image/fotobersejarah1.jpg'); }
            33%  { background-image: url('/image/fotobersejarah2.jpg'); }
            66%  { background-image: url('/image/fotobersejarah3.jpg'); }
            100% { background-image: url('/image/fotobersejarah1.jpg'); }
        }

        .hero-title,
        .hero-subtitle {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
          
        .btn-oprec {
            background: var(--accent-color);
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-oprec:hover {
            background: #e55722;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
        }
        
        /* Statistics Section */
        .stats-section {
            background: var(--primary-color);
            color: white;
            padding: 4rem 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 2rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            color: var(--accent-color);
        }
        
        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        /* News Section */
        .news-section {
            padding: 5rem 0;
            background: #f8f9fa;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .news-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .news-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        
        .news-meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        /* Quick Links */
        .quick-links {
            padding: 4rem 0;
            background: white;
        }
        
        .quick-link-item {
            text-align: center;
            padding: 2rem;
            border-radius: 15px;
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
        }
        
        .quick-link-item:hover {
            border-color: var(--secondary-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(76, 175, 80, 0.1);
        }
        
        .quick-link-icon {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }
        
        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem;
        }
        
        .footer-content {
            margin-bottom: 2rem;
        }
        
        .footer-title {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--accent-color);
        }
        
        .social-links a {
            color: white;
            font-size: 1.5rem;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }
        
        /* Mobile Responsive */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(46, 125, 50, 0.98);
                border-radius: 15px;
                margin-top: 1rem;
                padding: 1.5rem;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            }

            .navbar-nav .nav-item {
                margin: 0.25rem 0;
            }

            .navbar-nav .nav-link {
                padding: 0.75rem 1rem !important;
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .navbar-nav .nav-link:hover {
                background: rgba(255, 255, 255, 0.1);
                transform: translateX(5px);
            }

            .btn-login {
                margin-top: 1rem;
                width: 100%;
                justify-content: center;
                padding: 0.75rem 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }

            .logo-section img {
                width: 50px;
                height: 50px;
            }

            .logo-title {
                font-size: 1.2rem;
            }

            .logo-divider {
                width: 120px;
            }

            .logo-subtitle {
                font-size: 0.8rem;
            }

            /* Hero section height adjustment */
            .hero-section {
                height: 70vh;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                padding: 0.75rem 0;
            }

            .hero-section {
                height: 60vh;
            }

            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }

            .logo-title {
                font-size: 1.1rem;
            }

            .logo-divider {
                width: 100px;
            }

            .stat-number {
                font-size: 1.8rem;
            }

            .stat-item {
                padding: 1rem;
            }
        }
        
        /* Animation */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }
        
        .fade-in-up.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Ensure proper z-index for navbar */
        .navbar {
            position: relative;
            z-index: 1030;
        }

        /* Fix for small screens */
        @media (max-width: 350px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }

            .logo-text {
                margin-left: 0.5rem;
            }
        }
    </style>
</head>
<body>
   <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <!-- Logo Section -->
            <div class="logo-section">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="me-2 me-md-3">
                <div class="logo-text">
                    <span class="logo-title">Cakra Manggala</span>
                    <div class="logo-divider"></div>
                    <small class="logo-subtitle">Tabah, Tangguh, Terampil</small>
                </div>
            </div>

            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('about') }}">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('struktur-kepengurusan') }}">Kepengurusan</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('activities') }}">Galeri</a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('contact') }}">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn-login">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Masuk</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row footer-content">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-title">UKM Pecinta Alam Cakra Manggala</h5>
                    <p>CAKRA MANGGALA adalah organisasi mahasiswa pecinta alam di Politeknik Negeri Madiun yang didirikan pada 26 Juli 2013 yang berfungsi sebagai wadah bagi mahasiswa yang mencintai alam untuk menyalurkan minat mereka melalui kegiatan positif di alam bebas, sekaligus menjadi tempat pembentukan karakter pribadi yang tangguh, berjiwa sosial, dan peduli lingkungan</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-light text-decoration-none">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('activities') }}" class="text-light text-decoration-none">Kegiatan</a></li>
                        <li class="mb-2"><a href="{{ route('join') }}" class="text-light text-decoration-none">Bergabung</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}" class="text-light text-decoration-none">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-title">Ikuti Sosial Media Cakra Manggala</h5>
                    <div class="social-links">
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Cakra Manggala. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Counter animation
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                element.textContent = Math.floor(current);
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                }
            }, 20);
        }
        
        // Trigger counter animation when in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target'));
                    animateCounter(counter, target);
                    observer.unobserve(counter);
                }
            });
        });
        
        document.querySelectorAll('.stat-number').forEach(counter => {
            observer.observe(counter);
        });

        // Close navbar on link click (mobile)
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                    toggle: false
                });
                bsCollapse.hide();
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>