{{-- File: resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - UKM Pecinta Alam Cakra Manggala</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #4caf50;
            --accent-color: #ff6b35;
            --dark-color: #1b5e20;
            --sidebar-width: 280px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fc;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--dark-color) 100%);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar-brand {
            padding: 1.5rem;
            text-align: center;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand img {
            width: 50px;
            height: 50px;
        }
        
        .sidebar-brand h5 {
            margin-top: 0.5rem;
            font-weight: 700;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-item {
            margin: 0.25rem 1rem;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .menu-link:hover,
        .menu-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .menu-icon {
            width: 20px;
            margin-right: 1rem;
            font-size: 1.2rem;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        .main-content.expanded {
            margin-left: 80px;
        }
        
        /* Topbar */
        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: between;
            align-items: center;
        }
        
        .topbar-left {
            display: flex;
            align-items: center;
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 1rem;
            cursor: pointer;
        }
        
        .topbar-right {
            display: flex;
            align-items: center;
            margin-left: auto;
        }
        
        .user-dropdown {
            position: relative;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .user-info:hover {
            background: #f8f9fa;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            color: white;
            font-weight: 600;
        }
        
        /* Content Area */
        .content-area {
            padding: 2rem;
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-title {
            color: var(--dark-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: #6c757d;
        }
        
        /* Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: none;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .content-area {
                padding: 1rem;
            }
            
            .topbar {
                padding: 1rem;
            }
        }
        
        /* Sidebar collapsed state */
        .sidebar.collapsed .sidebar-brand h5,
        .sidebar.collapsed .sidebar-brand p,
        .sidebar.collapsed .menu-text {
            display: none;
        }
        
        .sidebar.collapsed .menu-link {
            justify-content: center;
        }
        
        .sidebar.collapsed .menu-icon {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('image/logo.png') }}" alt="Logo">
            <h5 class="mb-0">Cakra Manggala</h5>
            <p class="small mb-0 opacity-75">Dashboard Admin</p>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 menu-icon"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>
            
            <div class="menu-item">
                <a href="{{ route('dashboard.pendaftar') }}" class="menu-link {{ request()->routeIs('dashboard.pendaftar*') ? 'active' : '' }}">
                    <i class="bi bi-people menu-icon"></i>
                    <span class="menu-text">Data Pendaftar</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="#" class="menu-link">
                    <i class="bi bi-people menu-icon"></i>
                    <span class="menu-text">Data Anggota Aktif</span>
                </a>
            </div>
            
            <div class="menu-item">
                <a href="{{ route('dashboard.artikel.index') }}" class="menu-link {{ request()->routeIs('dashboard.artikel.index*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper menu-icon"></i>
                    <span class="menu-text">Artikel & Berita</span>
                </a>
            </div>
            
            <!--<div class="menu-item">
                <a href="#" class="menu-link">
                    <i class="bi bi-images menu-icon"></i>
                    <span class="menu-text">Galeri Kegiatan</span>
                </a>
            </div>-->
            
            <div class="menu-item">
                <a href="{{ route('dashboard.kegiatan.index') }}" class="menu-link {{ request()->routeIs('dashboard.kegiatan*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event menu-icon"></i>
                    <span class="menu-text">Jadwal Kegiatan</span>
                </a>
            </div>
            
            <div class="menu-item">
                <a href="#" class="menu-link">
                    <i class="bi bi-gear menu-icon"></i>
                    <span class="menu-text">Pengaturan</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" id="sidebar-toggle">
                    <i class="bi bi-list"></i>
                </button>
                <h6 class="mb-0 text-muted">@yield('page-title', 'Dashboard')</h6>
            </div>
            
            <div class="topbar-right">
                <div class="user-dropdown dropdown">
                    <button class="user-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="user-details d-none d-md-block">
                            <div class="user-name fw-semibold">{{ Auth::user()->name }}</div>
                            <div class="user-role small text-muted">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="min-width: 200px;">
                        <li>
                            <div class="dropdown-header">
                                <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                <div class="small text-muted">{{ Auth::user()->email }}</div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person me-2"></i>Profil Saya
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear me-2"></i>Pengaturan
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}" target="_blank">
                                <i class="bi bi-globe me-2"></i>Lihat Website
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Content -->
        <div class="content-area">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar toggle functionality
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });
        
        // Mobile sidebar
        if (window.innerWidth <= 768) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }
        
        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
    
    @stack('scripts')