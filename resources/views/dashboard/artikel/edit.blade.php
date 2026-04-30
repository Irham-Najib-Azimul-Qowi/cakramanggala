{{-- File: resources/views/dashboard/artikel/edit.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Edit Artikel</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.artikel.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
            <i class="bi bi-pencil-square me-2"></i>Edit Artikel: {{ Str::limit($artikel->judul, 50) }}
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('dashboard.artikel.update', $artikel) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Artikel *</label>
                        <input type="text" 
                               class="form-control @error('judul') is-invalid @enderror" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul', $artikel->judul) }}" 
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
                                  placeholder="Ringkasan singkat artikel">{{ old('excerpt', $artikel->excerpt) }}</textarea>
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
                                  required>{{ old('konten', $artikel->konten) }}</textarea>
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
                                    <option value="draft" {{ old('status', $artikel->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $artikel->status) == 'published' ? 'selected' : '' }}>Publikasikan</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gambar Saat Ini -->
                            @if($artikel->gambar_utama)
                            <div class="mb-3">
                                <label class="form-label">Gambar Saat Ini</label>
                                <div class="border rounded p-2">
                                    <img src="{{ asset($artikel->gambar_utama) }}"
                                        alt="{{ $artikel->judul }}"
                                        class="img-fluid rounded"
                                        style="max-height: 200px;">
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="bi bi-info-circle"></i> 
                                            File: {{ basename($artikel->gambar_utama) }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="mb-3">
                                <label for="gambar_utama" class="form-label">
                                    {{ $artikel->gambar_utama ? 'Ganti Gambar' : 'Gambar Utama' }}
                                </label>
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

                            <!-- Preview Gambar Baru -->
                            <div id="imagePreview" class="mb-3" style="display: none;">
                                <label class="form-label">Preview Gambar Baru</label>
                                <div class="border rounded p-2">
                                    <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Penulis</label>
                                <div class="d-flex align-items-center">
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white me-2" 
                                         style="width: 30px; height: 30px; font-size: 12px;">
                                        {{ strtoupper(substr($artikel->user->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $artikel->user->name }}</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Statistik</label>
                                <div class="small">
                                    <div class="d-flex justify-content-between">
                                        <span>Views:</span>
                                        <strong>{{ number_format($artikel->views) }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Dibuat:</span>
                                        <strong>{{ $artikel->created_at->format('d/m/Y') }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Diupdate:</span>
                                        <strong>{{ $artikel->updated_at->format('d/m/Y') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($artikel->status == 'published')
                    <!-- Link Artikel -->
                    <div class="card bg-success bg-opacity-10 mt-3">
                        <div class="card-body">
                            <h6 class="card-title text-success">
                                <i class="bi bi-link-45deg"></i> Artikel Dipublikasikan
                            </h6>
                            <p class="small mb-2">Artikel dapat dilihat di:</p>
                            <a href="{{ route('artikel.show', $artikel->slug) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-outline-success">
                                <i class="bi bi-eye"></i> Lihat Artikel
                            </a>
                        </div>
                    </div>
                    @endif
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
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Artikel
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
    // Preview gambar baru
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

    // Character counter untuk excerpt
    const excerptTextarea = document.getElementById('excerpt');
    const maxLength = 300;
    
    function updateCounter() {
        const remaining = maxLength - excerptTextarea.value.length;
        let counterElement = document.getElementById('excerptCounter');
        
        if (!counterElement) {
            counterElement = document.createElement('div');
            counterElement.id = 'excerptCounter';
            counterElement.className = 'form-text';
            excerptTextarea.parentNode.appendChild(counterElement);
        }
        
        counterElement.textContent = `${remaining} karakter tersisa`;
        counterElement.className = remaining < 0 ? 'form-text text-danger' : 'form-text text-muted';
    }
    
    excerptTextarea.addEventListener('input', updateCounter);
    
    // Inisialisasi counter
    updateCounter();
});
</script>
@endpush