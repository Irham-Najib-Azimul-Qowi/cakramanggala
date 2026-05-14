@extends('layouts.dashboard')

@section('title', 'Manajemen Perlengkapan')

@section('content')
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon text-accent"><i class="bi bi-box-seam"></i></div>
                <div>
                    <div class="stat-label">Total Alat</div>
                    <div class="stat-value">{{ $stats['total_alat'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon text-success"><i class="bi bi-check-circle"></i></div>
                <div>
                    <div class="stat-label">Alat Tersedia</div>
                    <div class="stat-value">{{ $stats['alat_tersedia'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon text-warning"><i class="bi bi-gear-wide-connected"></i></div>
                <div>
                    <div class="stat-label">Alat Dipakai</div>
                    <div class="stat-value">{{ $stats['alat_dipakai'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon text-info"><i class="bi bi-activity"></i></div>
                <div>
                    <div class="stat-label">Kegiatan Aktif</div>
                    <div class="stat-value">{{ $stats['kegiatan_aktif'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <h3 class="h6 fw-bold text-accent text-uppercase mb-4" style="letter-spacing: 0.1em;">
                    <i class="bi bi-tools me-2"></i> Daftar Alat
                </h3>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th>Total</th>
                                <th>Tersedia</th>
                                <th>Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alats as $alat)
                                <tr>
                                    <td class="fw-bold">{{ $alat->name }}</td>
                                    <td>{{ $alat->category ?? '-' }}</td>
                                    <td>{{ $alat->total_qty }}</td>
                                    <td>
                                        <span class="badge {{ $alat->available_qty > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $alat->available_qty }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="admin-badge {{ $alat->condition == 'good' ? 'admin-badge--success' : 'admin-badge--danger' }}">
                                            {{ $alat->condition == 'good' ? 'Bagus' : 'Rusak' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">Belum ada data alat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="admin-card">
                <h3 class="h6 fw-bold text-accent text-uppercase mb-4" style="letter-spacing: 0.1em;">
                    <i class="bi bi-calendar-check me-2"></i> Daftar Kegiatan
                </h3>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Alat Digunakan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kegiatans as $kegiatan)
                                <tr>
                                    <td class="fw-bold">{{ $kegiatan->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kegiatan->date)->format('d M Y') }}</td>
                                    <td>
                                        <span class="admin-badge 
                                            {{ $kegiatan->status == 'completed' ? 'admin-badge--success' : ($kegiatan->status == 'ongoing' ? 'admin-badge--warning' : '') }}">
                                            {{ strtoupper($kegiatan->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $kegiatan->alats_count }} jenis</td>
                                    <td>
                                        <a href="{{ route('dashboard.inventaris.kegiatan', $kegiatan->id) }}" class="btn-accent py-1 px-3" style="font-size: 0.6rem;">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">Belum ada data kegiatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card">
                <h3 class="h6 fw-bold text-accent text-uppercase mb-4" style="letter-spacing: 0.1em;">
                    <i class="bi bi-pie-chart me-2"></i> Statistik Penggunaan
                </h3>
                <canvas id="usageChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('usageChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    data: {!! json_encode($chartData['data']) !!},
                    backgroundColor: ['#1a4331', '#f2b661'],
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                            font: {
                                family: 'Outfit',
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush
