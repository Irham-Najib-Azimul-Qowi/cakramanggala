{{-- File: resources/views/dashboard/kegiatan/create.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Tambah Kegiatan')
@section('page-title', 'Tambah Kegiatan')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Tambah Kegiatan Baru</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.kegiatan.index') }}">Jadwal Kegiatan</a></li>
                    <li class="breadcrumb-item active">Tambah Kegiatan</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('dashboard.kegiatan.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-plus-circle me-2"></i>Form Tambah Kegiatan
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('dashboard.kegiatan.store') }}">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                            <select class="form-select @error('tahun') is-invalid @enderror" id="tahun" name="tahun" required>
                                <option value="">Pilih Tahun</option>
                                @for($year = 2020; $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ old('tahun', date('Y')) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="sifat" class="form-label">Sifat Kegiatan <span class="text-danger">*</span></label>
                            <select class="form-select @error('sifat') is-invalid @enderror" id="sifat" name="sifat" required>
                                <option value="">Pilih Sifat</option>
                                <option value="internal" {{ old('sifat') == 'internal' ? 'selected' : '' }}>Internal</option>
                                <option value="eksternal" {{ old('sifat') == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                            </select>
                            @error('sifat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="judul_kegiatan" class="form-label">Judul Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul_kegiatan') is-invalid @enderror" 
                               id="judul_kegiatan" name="judul_kegiatan" value="{{ old('judul_kegiatan') }}" 
                               placeholder="Masukkan judul kegiatan" required>
                        @error('judul_kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror" 
                                   id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" 
                                   value="{{ old('tanggal_pelaksanaan') }}" required>
                            @error('tanggal_pelaksanaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tempat" class="form-label">Tempat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tempat') is-invalid @enderror" 
                                   id="tempat" name="tempat" value="{{ old('tempat') }}" 
                                   placeholder="Masukkan tempat kegiatan" required>
                            @error('tempat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kapel_pj" class="form-label">Ketua Pelaksana (Kapel) / Penanggung Jawab (PJ) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kapel_pj') is-invalid @enderror" 
                               id="kapel_pj" name="kapel_pj" value="{{ old('kapel_pj') }}" 
                               placeholder="Masukkan nama kapel/PJ" required>
                        @error('kapel_pj')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="materi" class="form-label">Materi <span class="text-muted">(opsional)</span></label>
                        <textarea class="form-control @error('materi') is-invalid @enderror" 
                                  id="materi" name="materi" rows="4" 
                                  placeholder="Masukkan materi kegiatan (opsional)">{{ old('materi') }}</textarea>
                        @error('materi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Deskripsi singkat tentang materi atau agenda kegiatan.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard.kegiatan.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Simpan Kegiatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>Informasi
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6 class="alert-heading">
                        <i class="bi bi-lightbulb"></i> Tips Pengisian
                    </h6>
                    <small>
                        <ul class="mb-0 ps-3">
                            <li>Pastikan tanggal pelaksanaan dan tempat sudah benar</li>
                            <li>Tulis nama lengkap kapel/PJ</li>
                            <li>Materi bersifat opsional, bisa diganti catatan atau dikosongi</li>
                            <li>Kegiatan internal untuk calon atau anggota ukm saja sedangkan eksternal untuk diluar ukm, di lingkup kampus, atau umum</li>
                        </ul>
                    </small>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-clock-history me-2"></i>Kegiatan Terbaru
                </h6>
            </div>
            <div class="card-body">
                @php
                    $recentKegiatans = \App\Models\Kegiatan::latest()->take(3)->get();
                @endphp
                
                @forelse($recentKegiatans as $recent)
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-3" 
                         style="width: 35px; height: 35px; font-size: 12px;">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold small">{{ Str::limit($recent->judul_kegiatan, 30) }}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">
                            {{ $recent->formatted_date }}
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted small mb-0">Belum ada kegiatan terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today for date input
    const dateInput = document.getElementById('tanggal_pelaksanaan');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }

    // Auto capitalize first letter of each word
    const titleInput = document.getElementById('judul_kegiatan');
    const tempat = document.getElementById('tempat');
    const kapelPj = document.getElementById('kapel_pj');

    function capitalizeWords(str) {
        return str.replace(/\w\S*/g, (txt) => {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    }

    [titleInput, tempat, kapelPj].forEach(input => {
        if (input) {
            input.addEventListener('blur', function() {
                this.value = capitalizeWords(this.value);
            });
        }
    });
});
</script>
@endpush