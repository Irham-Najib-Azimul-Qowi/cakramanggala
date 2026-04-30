{{-- File: resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin Cakra Manggala</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Montserrat:wght@700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <style>
        :root {
            --primary: #1a4331;
            --secondary: #123124;
            --accent: #f2b661;
            --dark: #07110c;
            --dark-card: #0c1b14;
            --border-glow: rgba(242, 182, 97, 0.15);
            --sidebar-w: 280px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--dark);
            color: rgba(255, 255, 255, 0.9);
            overflow-x: hidden;
            margin: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Montserrat', sans-serif;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            position: fixed;
            background: var(--primary);
            color: white;
            transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1050;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar-brand {
            padding: 2.5rem 2rem;
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: #fff;
            position: relative;
        }

        .sidebar-brand::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 2rem;
            right: 2rem;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        }

        .sidebar-brand img {
            width: 42px;
            height: 42px;
            filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.3));
        }

        .sidebar-brand span {
            font-family: 'Montserrat', sans-serif;
            font-weight: 900;
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #fff;
        }

        .sidebar-nav {
            padding: 2rem 1.25rem;
            flex: 1;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.4);
            padding: 1.1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            transition: all 0.3s;
            border-radius: 0;
            margin-bottom: 6px;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            position: relative;
        }

        .nav-link i {
            font-size: 1.25rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .nav-link.active {
            color: var(--accent);
            background: rgba(242, 182, 97, 0.05);
            border: 1px solid rgba(242, 182, 97, 0.1);
        }

        .nav-link.active i {
            color: var(--accent);
        }

        .sidebar-footer {
            padding: 2rem 1.25rem;
            background: rgba(0, 0, 0, 0.2);
        }

        .user-widget {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 1.5rem;
            padding: 0.5rem;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            background: var(--accent);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1rem;
        }

        /* ── Main Layout ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            transition: 0.4s;
        }

        .main-header {
            background: var(--dark-card);
            padding: 1.5rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .main-content {
            padding: 3.5rem;
        }

        /* ── Mobile ── */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: 100%;
                max-width: 300px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .mobile-toggle {
                display: flex !important;
            }

            .main-content {
                padding: 2rem 1.5rem;
            }

            .main-header {
                display: none !important;
            }
        }

        .mobile-toggle {
            display: none;
            background: var(--primary);
            padding: 1.25rem 1.5rem;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1040;
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .btn-menu {
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1045;
            backdrop-filter: blur(4px);
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* ── Custom UI ── */
        .btn-accent {
            background: var(--accent);
            color: var(--primary);
            border: none;
            border-radius: 0;
            font-weight: 800;
            padding: 0.8rem 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-size: 0.75rem;
            transition: all 0.3s;
        }

        .btn-accent:hover {
            background: #fff;
            color: var(--primary);
            transform: translateY(-2px);
        }

        .btn-logout {
            width: 100%;
            padding: 1rem;
            background: rgba(255, 99, 102, 0.05);
            border: 1px solid rgba(255, 99, 102, 0.1);
            color: #ff6366;
            font-weight: 800;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .btn-logout:hover {
            background: #ff6366;
            color: #fff;
        }

        /* ── Global Dashboard Components ── */
        .admin-card {
            background: var(--dark-card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2.5rem;
            position: relative;
        }

        .admin-table-wrapper {
            background: var(--dark-card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            overflow-x: auto;
        }

        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            color: #fff;
        }

        .admin-table th {
            background: var(--primary);
            color: var(--accent);
            padding: 1.25rem 1.5rem;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            border: none;
        }

        .admin-table td {
            padding: 1.25rem 1.5rem;
            background: rgba(255, 255, 255, 0.01);
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            font-size: 0.88rem;
            vertical-align: middle;
            transition: background 0.3s;
        }

        .admin-table tr:hover td {
            background: rgba(255, 255, 255, 0.03);
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 0.8rem;
            font-size: 0.6rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .admin-badge--success {
            background: rgba(26, 67, 49, 0.5);
            color: #fff;
            border: 1px solid var(--primary);
        }

        .admin-badge--warning {
            background: rgba(242, 182, 97, 0.1);
            color: var(--accent);
            border: 1px solid rgba(242, 182, 97, 0.2);
        }

        .admin-badge--danger {
            background: rgba(255, 99, 102, 0.1);
            color: #ff6366;
            border: 1px solid rgba(255, 99, 102, 0.2);
        }

        .stat-card {
            background: var(--dark-card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 24px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .stat-icon {
            font-size: 2.2rem;
            flex-shrink: 0;
            opacity: 0.8;
        }

        .stat-label {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: rgba(255, 255, 255, 0.4);
            margin-bottom: 0.4rem;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .admin-input,
        .admin-select {
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 0 !important;
            padding: 0.8rem 1.2rem !important;
            color: #fff !important;
            font-size: 0.9rem !important;
            transition: all 0.3s;
        }

        .admin-select option {
            background-color: var(--primary) !important;
            color: #fff !important;
            padding: 10px;
        }

        .admin-input:focus,
        .admin-select:focus {
            background: rgba(255, 255, 255, 0.05) !important;
            border-color: var(--accent) !important;
            box-shadow: none !important;
        }

        .admin-input::placeholder {
            color: rgba(255, 255, 255, 0.2) !important;
        }

        .pagination {
            gap: 5px;
        }

        .pagination .page-link {
            background: var(--dark-card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: #fff;
            padding: 0.6rem 1rem;
            border-radius: 0;
        }

        .pagination .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
            color: var(--primary);
        }

        .avatar-sm {
            width: 38px;
            height: 38px;
            background: var(--accent);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 0.85rem;
        }

        .quick-link {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            text-decoration: none !important;
            color: #fff;
            transition: all 0.3s;
        }

        .quick-link:hover {
            transform: translateX(10px);
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--accent);
        }

        .quick-link__icon {
            width: 48px;
            height: 48px;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="mobile-toggle">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('image/logo.png') }}" width="32">
            <span class="fw-bold"
                style="font-family: Montserrat; letter-spacing: 0.2em; font-size: 0.8rem;">CAKRA</span>
        </div>
        <button class="btn-menu" onclick="toggleSidebar()"><i class="bi bi-list fs-4"></i></button>
    </div>

    <aside class="sidebar" id="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('image/logo.png') }}" alt="Logo">
            <span>Admin Control</span>
        </a>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Ikhtisar
            </a>
            <a href="{{ route('dashboard.pendaftar') }}"
                class="nav-link {{ request()->routeIs('dashboard.pendaftar*') ? 'active' : '' }}">
                <i class="bi bi-backpack-fill"></i> Pendaftar
            </a>
            <a href="{{ route('dashboard.artikel.index') }}"
                class="nav-link {{ request()->routeIs('dashboard.artikel*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Artikel
            </a>
            <a href="{{ route('dashboard.kegiatan.index') }}"
                class="nav-link {{ request()->routeIs('dashboard.kegiatan*') ? 'active' : '' }}">
                <i class="bi bi-calendar3-event"></i> Kegiatan
            </a>
            <a href="{{ route('dashboard.pengurus.index') }}"
                class="nav-link {{ request()->routeIs('dashboard.pengurus*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Pengurus
            </a>
            <a href="{{ route('dashboard.pesan') }}"
                class="nav-link {{ request()->routeIs('dashboard.pesan*') ? 'active' : '' }}">
                <i class="bi bi-chat-left-dots"></i> Pesan
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-widget">
                <div class="user-avatar">{{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'A' }}</div>
                <div class="overflow-hidden">
                    <div class="small fw-bold text-white text-truncate">
                        {{ Auth::check() ? Auth::user()->name : 'Admin' }}
                    </div>
                    <div class="text-accent"
                        style="font-size: 0.6rem; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 800;">
                        Administrator</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout border-0">
                    <i class="bi bi-power"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="main-header">
            <div>
                <h1 class="h5 fw-black mb-1" style="letter-spacing: -0.01em; color: #fff;">
                    PANEL KENDALI
                </h1>
                <p class="small mb-0"
                    style="color: rgba(255,255,255,0.4); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="d-flex align-items-center gap-4">
                <a href="{{ route('home') }}" target="_blank" class="btn-accent text-decoration-none">
                    <i class="bi bi-eye-fill me-2"></i> Kunjungi Situs
                </a>
            </div>
        </header>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-lg mb-5 d-flex align-items-center gap-4 px-4 py-3"
                    style="background: var(--primary); color: #fff; border-left: 4px solid var(--accent) !important; border-radius: 0;">
                    <i class="bi bi-check2-all fs-4 text-accent"></i>
                    <div class="fw-bold">{{ session('success') }}</div>
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert"></button>
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
    <style>
        /* Modern Select Fix */
        select.admin-select,
        select.form-select {
            color: #fff !important;
            background-color: #1a1a1a !important;
            cursor: pointer;
        }

        select.admin-select option,
        select.form-select option {
            background-color: #1a1a1a !important;
            color: #fff !important;
            padding: 12px !important;
        }

        /* Improved Validation Visibility */
        .invalid-feedback {
            display: block;
            margin-top: 0.5rem;
            color: #ff6366 !important;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function () {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn && !submitBtn.classList.contains('no-loader')) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.disabled = true;
                        submitBtn.style.opacity = '0.7';
                        submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> MEMPROSES...`;

                        // Small fallback if something hangs
                        setTimeout(() => {
                            if (submitBtn.disabled) {
                                // Keep it disabled but let user know it's taking time
                            }
                        }, 10000);
                    }
                });
            });
        });
    </script>
</body>

</html>