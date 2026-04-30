{{-- File: resources/views/dashboard/kegiatan/edit.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Edit Kegiatan')
@section('page-title', 'Edit Kegiatan')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Edit Kegiatan</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.kegiatan.index') }}">Jadwal Kegiatan</a></li>
                    <li class="breadcrumb-item active">Edit Kegiatan</li>
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
                    <i class="bi bi-pencil-square me-2"></i>Form Edit Kegiatan
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('dashboard.kegiatan.update', $kegiatan) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                            <select class="form-select @error('tahun') is-invalid @enderror" id="tahun" name="tahun" required>
                                <option value="">Pilih Tahun</option>
                                @for($year = 2020; $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}" {{ old('tahun', $kegiatan->tahun) == $year ? 'selected' : '' }}>
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
                                <option value="internal" {{ old('sifat', $kegiatan->sifat) == 'internal' ? 'selected' : '' }}>Internal</option>
                                <option value="eksternal" {{ old('sifat', $kegiatan->sifat) == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                            </select>
                            @error('sifat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="judul_kegiatan" class="form-label">Judul Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul_kegiatan') is-invalid @enderror" 
                               id="judul_kegiatan" name="judul_kegiatan" value="{{ old('judul_kegiatan', $kegiatan->judul_kegiatan) }}" 
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
                                   value="{{ old('tanggal_pelaksanaan', $kegiatan->tanggal_pelaksanaan->format('Y-m-d')) }}" required>
                            @error('tanggal_pelaksanaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tempat" class="form-label">Tempat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tempat') is-invalid @enderror" 
                                   id="tempat" name="tempat" value="{{ old('tempat', $kegiatan->tempat) }}" 
                                   placeholder="Masukkan tempat kegiatan" required>
                            @error('tempat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kapel_pj" class="form-label">Ketua Pelaksana (Kapel) / Penanggung Jawab (PJ) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kapel_pj') is-invalid @enderror" 
                               id="kapel_pj" name="kapel_pj" value="{{ old('kapel_pj', $kegiatan->kapel_pj) }}" 
                               placeholder="Masukkan nama kapel/PJ" required>
                        @error('kapel_pj')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="materi" class="form-label">Materi <span class="text-muted">(opsional)</span></label>
                        <textarea class="form-control @error('materi') is-invalid @enderror" 
                                  id="materi" name="materi" rows="4" 
                                  placeholder="Masukkan materi kegiatan (opsional)">{{ old('materi', $kegiatan->materi) }}</textarea>
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
                            <i class="bi bi-check-circle"></i> Update Kegiatan
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
                    <i class="bi bi-info-circle me-2"></i>Informasi Kegiatan
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Dibuat oleh:</small>
                    <div class="fw-semibold">{{ $kegiatan->user->name }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Dibuat pada:</small>
                    <div class="fw-semibold">{{ $kegiatan->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Terakhir diperbarui:</small>
                    <div class="fw-semibold">{{ $kegiatan->updated_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Status:</small>
                    <div>
                        <span class="badge bg-{{ $kegiatan->status == 'selesai' ? 'secondary' : 'warning' }}">
                            {{ $kegiatan->status == 'selesai' ? 'Selesai' : 'Akan Datang' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-lightbulb me-2"></i>Tips Editing
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <small>
                        <ul class="mb-0 ps-3">
                            <li>Pastikan perubahan yang Anda buat sudah benar</li>
                            <li>Jika tanggal sudah lewat, kegiatan akan otomatis berstatus "Selesai"</li>
                            <li>Perubahan akan tercatat dalam sistem</li>
                        </ul>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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