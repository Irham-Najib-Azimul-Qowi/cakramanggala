{{-- File: resources/views/dashboard/artikel/create.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Buat Artikel Baru')
@section('page-title', 'Buat Artikel Baru')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Buat Artikel Baru</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.artikel.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Buat Baru</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="bi bi-pencil-square me-2"></i>Form Artikel Baru
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.artikel.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Artikel *</label>
                        <input type="text" 
                               class="form-control @error('judul') is-invalid @enderror" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul') }}" 
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Ringkasan Artikel</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                  id="excerpt" 
                                  name="excerpt" 
                                  rows="3" 
                                  placeholder="Ringkasan singkat artikel (opsional, akan dibuat otomatis jika kosong)">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Maksimal 300 karakter</div>
                    </div>

                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten Artikel *</label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" 
                                  id="konten" 
                                  name="konten" 
                                  rows="15" 
                                  required>{{ old('konten') }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-lg-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Pengaturan Artikel</h6>
                            
                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publikasikan</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gambar_utama" class="form-label">Gambar Utama</label>
                                <input type="file" 
                                       class="form-control @error('gambar_utama') is-invalid @enderror" 
                                       id="gambar_utama" 
                                       name="gambar_utama" 
                                       accept="image/*">
                                @error('gambar_utama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                            </div>

                            <!-- Preview Gambar -->
                            <div id="imagePreview" class="mb-3" style="display: none;">
                                <label class="form-label">Preview Gambar</label>
                                <div class="border rounded p-2">
                                    <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Penulis</label>
                                <div class="d-flex align-items-center">
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white me-2" 
                                         style="width: 30px; height: 30px; font-size: 12px;">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Menulis -->
                    <div class="card bg-info bg-opacity-10 mt-3">
                        <div class="card-body">
                            <h6 class="card-title text-info">
                                <i class="bi bi-lightbulb"></i> Tips Menulis
                            </h6>
                            <ul class="small mb-0">
                                <li>Gunakan judul yang menarik dan deskriptif</li>
                                <li>Buat paragraf pembuka yang engaging</li>
                                <li>Gunakan sub-heading untuk memecah konten</li>
                                <li>Sertakan gambar yang relevan</li>
                                <li>Proofread sebelum publikasi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard.artikel.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                        <div>
                            <button type="submit" name="status" value="draft" class="btn btn-outline-primary me-2">
                                <i class="bi bi-file-earmark-text"></i> Simpan Draft
                            </button>
                            <button type="submit" name="status" value="published" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Publikasikan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview gambar
    const gambarInput = document.getElementById('gambar_utama');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    gambarInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Auto-generate excerpt dari konten
    const kontenTextarea = document.getElementById('konten');
    const excerptTextarea = document.getElementById('excerpt');
    
    kontenTextarea.addEventListener('input', function() {
        if (!excerptTextarea.value.trim()) {
            const plainText = this.value.replace(/<[^>]*>/g, '');
            const excerpt = plainText.substring(0, 150);
            excerptTextarea.value = excerpt + (plainText.length > 150 ? '...' : '');
        }
    });

    // Character counter untuk excerpt
    const maxLength = 300;
    excerptTextarea.addEventListener('input', function() {
        const remaining = maxLength - this.value.length;
        let counterElement = document.getElementById('excerptCounter');
        
        if (!counterElement) {
            counterElement = document.createElement('div');
            counterElement.id = 'excerptCounter';
            counterElement.className = 'form-text';
            this.parentNode.appendChild(counterElement);
        }
        
        counterElement.textContent = `${remaining} karakter tersisa`;
        counterElement.className = remaining < 0 ? 'form-text text-danger' : 'form-text text-muted';
    });
});
</script>
@endpush