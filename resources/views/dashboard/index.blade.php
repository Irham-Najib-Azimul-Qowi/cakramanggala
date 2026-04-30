{{-- File: resources/views/dashboard/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<!-- Welcome Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border-radius: 20px;">
            <div class="card-body p-4 text-white">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-2">Selamat Datang, {{ $user->name }}! 👋</h3>
                        <p class="mb-0 opacity-90">Kelola website dan data UKM Pecinta Alam Cakra Manggala dengan mudah melalui dashboard ini.</p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <i class="bi bi-speedometer2" style="font-size: 4rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<!--<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: #3b82f6;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">{{ $stats['total_pendaftar'] }}</div>
            <div class="stat-label">Total Pendaftar</div>
            <div class="small text-success mt-1">
                <i class="bi bi-arrow-up"></i> +12% dari bulan lalu
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: #10b981;">
                <i class="bi bi-newspaper"></i>
            </div>
            <div class="stat-number">{{ $stats['artikel_bulan_ini'] }}</div>
            <div class="stat-label">Artikel Bulan Ini</div>
            <div class="small text-success mt-1">
                <i class="bi bi-arrow-up"></i> +5 artikel baru
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: #f59e0b;">
                <i class="bi bi-calendar-event"></i>
            </div>
            <div class="stat-number">{{ $stats['kegiatan_aktif'] }}</div>
            <div class="stat-label">Kegiatan Aktif</div>
            <div class="small text-warning mt-1">
                <i class="bi bi-clock"></i> 2 kegiatan mendatang
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: #8b5cf6;">
                <i class="bi bi-star-fill"></i>
            </div>
            <div class="stat-number">{{ $stats['anggota_aktif'] }}</div>
            <div class="stat-label">Anggota Aktif</div>
            <div class="small text-info mt-1">
                <i class="bi bi-people"></i> Status aktif
            </div>
        </div>
    </div>
</div>

<!-- Charts and Recent Activity -->
<!--<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 pb-0" style="border-radius: 15px 15px 0 0;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">Statistik Pendaftaran</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-calendar3"></i> 6 Bulan Terakhir
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">3 Bulan Terakhir</a></li>
                            <li><a class="dropdown-item" href="#">6 Bulan Terakhir</a></li>
                            <li><a class="dropdown-item" href="#">1 Tahun Terakhir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="registrationChart" height="100"></canvas>
            </div>
        </div>
    </div>-->
    
    <!-- Recent Activities -->
    <!--<div class="col-xl-4 col-lg-5">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 pb-0" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0 fw-bold text-dark">Aktivitas Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="activity-item d-flex align-items-center mb-3 pb-3 border-bottom">
                    <div class="activity-icon me-3" style="width: 40px; height: 40px; background: #3b82f6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-person-plus text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">Pendaftar Baru</div>
                        <div class="small text-muted">Ahmad Rizki mendaftar</div>
                        <div class="small text-muted">2 jam yang lalu</div>
                    </div>
                </div>
                
                <div class="activity-item d-flex align-items-center mb-3 pb-3 border-bottom">
                    <div class="activity-icon me-3" style="width: 40px; height: 40px; background: #10b981; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-file-earmark-text text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">Artikel Diterbitkan</div>
                        <div class="small text-muted">"Tips Mendaki Gunung"</div>
                        <div class="small text-muted">5 jam yang lalu</div>
                    </div>
                </div>
                
                <div class="activity-item d-flex align-items-center mb-3 pb-3 border-bottom">
                    <div class="activity-icon me-3" style="width: 40px; height: 40px; background: #f59e0b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-calendar-plus text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">Kegiatan Baru</div>
                        <div class="small text-muted">Hiking Gunung Salak</div>
                        <div class="small text-muted">1 hari yang lalu</div>
                    </div>
                </div>
                
                <div class="activity-item d-flex align-items-center">
                    <div class="activity-icon me-3" style="width: 40px; height: 40px; background: #8b5cf6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-images text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">Galeri Diperbarui</div>
                        <div class="small text-muted">15 foto baru ditambahkan</div>
                        <div class="small text-muted">2 hari yang lalu</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 pb-0" style="border-radius: 15px 15px 0 0;">
                <h5 class="mb-0 fw-bold text-dark">Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="{{ route('dashboard.pendaftar') }}" class="text-decoration-none">
                            <div class="quick-action-card p-3 text-center border rounded-3 h-100" style="transition: all 0.3s ease;">
                                <i class="bi bi-person-plus-fill text-primary" style="font-size: 2rem;"></i>
                                <h6 class="mt-2 mb-0">Lihat Pendaftar</h6>
                                <small class="text-muted">Kelola data pendaftar</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="{{ route('dashboard.artikel.index') }}" class="text-decoration-none">
                            <div class="quick-action-card p-3 text-center border rounded-3 h-100" style="transition: all 0.3s ease;">
                                <i class="bi bi-plus-circle-fill text-success" style="font-size: 2rem;"></i>
                                <h6 class="mt-2 mb-0">Tambah Artikel</h6>
                                <small class="text-muted">Buat artikel baru</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="{{ route('dashboard.kegiatan.index') }}" class="text-decoration-none">
                            <div class="quick-action-card p-3 text-center border rounded-3 h-100" style="transition: all 0.3s ease;">
                                <i class="bi bi-images text-warning" style="font-size: 2rem;"></i>
                                <h6 class="mt-2 mb-0">Jadwal Kegiatan</h6>
                                <small class="text-muted">Lihat Jadwal kegiatan</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="#" class="text-decoration-none">
                            <div class="quick-action-card p-3 text-center border rounded-3 h-100" style="transition: all 0.3s ease;">
                                <i class="bi bi-gear-fill text-info" style="font-size: 2rem;"></i>
                                <h6 class="mt-2 mb-0">Pengaturan</h6>
                                <small class="text-muted">Konfigurasi website</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.quick-action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    border-color: var(--secondary-color) !important;
}
</style>
@endsection

@push('scripts')
<script>
// Registration Chart
const ctx = document.getElementById('registrationChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Pendaftar',
            data: [12, 19, 8, 15, 25, 22],
            borderColor: '#2e7d32',
            backgroundColor: 'rgba(46, 125, 50, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#f1f3f4'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        elements: {
            point: {
                radius: 6,
                backgroundColor: '#2e7d32',
                borderColor: '#ffffff',
                borderWidth: 2
            }
        }
    }
});
</script>
@endpush