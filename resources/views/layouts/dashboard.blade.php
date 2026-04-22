{{-- File: resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin Cakra Manggala</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary: #1a4331;
            --secondary: #255b44;
            --accent: #f2b661;
            --dark: #07110c;
            --surface: #f3efe7;
            --surface-soft: #faf6ef;
            --surface-panel: #fffdf8;
            --text: #122119;
            --muted: #5d675f;
            --border-soft: rgba(18, 33, 25, 0.08);
            --sidebar-w: 280px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--surface);
            color: var(--text);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .sidebar-brand {
            font-family: 'Montserrat', sans-serif;
        }

        /* Sidebar Design */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, var(--primary) 0%, var(--dark) 100%);
            color: white;
            transition: 0.3s ease;
            z-index: 1050;
            box-shadow: 10px 0 40px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            padding: 2rem 1.5rem;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-nav {
            padding: 1.5rem 1rem;
        }

        .nav-link {
            color: rgba(255,255,255,0.6);
            padding: 0.9rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 12px;
            margin-bottom: 0.4rem;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .nav-link i {
            font-size: 1.2rem;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.08);
            transform: translateX(5px);
        }

        .nav-link.active {
            color: white;
            background: rgba(242, 182, 97, 0.15);
            box-shadow: inset 0 0 0 1px rgba(242, 182, 97, 0.2);
        }

        .nav-link.active i {
            color: var(--accent);
        }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            transition: 0.3s ease;
        }

        .main-header {
            background: white;
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .main-content {
            padding: 2.5rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); width: 100%; max-width: 300px; }
            .sidebar.show { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .mobile-toggle { display: flex !important; }
        }

        .mobile-toggle {
            display: none;
            background: white;
            padding: 1rem 1.5rem;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1040;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .btn-menu {
            border: none;
            background: var(--primary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem;
            background: rgba(255,255,255,0.03);
            border-radius: 15px;
            margin: 1rem;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--accent);
            color: var(--dark);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1045;
            backdrop-filter: blur(4px);
        }

        .sidebar-overlay.show { display: block; }
    </style>
</head>
<body>
    <div class="mobile-toggle">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('image/logo.png') }}" width="30">
            <span class="fw-bold fs-6">Admin Panel</span>
        </div>
        <button class="btn-menu" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
    </div>

    <div class="sidebar" id="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand text-decoration-none">
            <img src="{{ asset('image/logo.png') }}" width="35">
            <span class="text-white">Cakra Manggala</span>
        </a>

        <div class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="{{ route('dashboard.pendaftar') }}" class="nav-link {{ request()->routeIs('dashboard.pendaftar*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Pendaftar
            </a>
            <a href="{{ route('dashboard.artikel.index') }}" class="nav-link {{ request()->routeIs('dashboard.artikel*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Artikel
            </a>
            <a href="{{ route('dashboard.kegiatan.index') }}" class="nav-link {{ request()->routeIs('dashboard.kegiatan*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> Kegiatan
            </a>
            <a href="{{ route('dashboard.pesan') }}" class="nav-link {{ request()->routeIs('dashboard.pesan*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots-fill"></i> Pesan Masuk
            </a>
        </div>

        <div class="mt-auto pb-4">
            <div class="user-profile">
                <div class="user-avatar">{{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'A' }}</div>
                <div class="overflow-hidden">
                    <div class="small fw-bold text-white text-truncate">{{ Auth::check() ? Auth::user()->name : 'Admin' }}</div>
                    <div class="small text-white-50" style="font-size: 0.75rem;">Administrator</div>
                </div>
            </div>
            <div class="px-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 py-2 rounded-3 border-0" style="background: rgba(220, 53, 69, 0.15); color: #ff6b6b;">
                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="main-wrapper">
        <header class="main-header d-none d-lg-flex">
            <div>
                <h5 class="fw-bold mb-0">Selamat Datang, {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Admin' }}!</h5>
                <p class="text-muted small mb-0">{{ now()->format('l, d F Y') }}</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 border rounded-circle" style="cursor: pointer;"><i class="bi bi-bell"></i></div>
                <a href="{{ route('home') }}" class="btn btn-light btn-sm rounded-pill px-3">
                    <i class="bi bi-globe me-1"></i> Lihat Web
                </a>
            </div>
        </header>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center gap-3">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>
</html>
