{{-- File: resources/views/join.blade.php --}}
@extends('layouts.app')

@section('title', 'Bergabung - UKM Cakra Manggala')

@section('content')
<style>
    .form-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
    }
    
    .form-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .form-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 3rem;
        text-align: center;
    }
    
    .form-body {
        padding: 3rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.8rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, var(--accent-color), #e55722);
        border: none;
        padding: 1rem 3rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        color: white;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
        background: linear-gradient(135deg, #e55722, var(--accent-color));
    }
    
    .required {
        color: #dc3545;
    }
    
    .alert {
        border-radius: 10px;
        border: none;
    }
    
    .invalid-feedback {
        display: block;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .form-text {
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>

<section class="form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container" data-aos="fade-up">
                    <div class="form-header">
                        <h2><i class="bi bi-person-plus me-3"></i>Pendaftaran Calon Anggota Baru UKM Cakra Manggala Angkatan XIV</h2>
                        <p class="mb-0">Bergabunglah dengan keluarga besar UKM Mapala Cakra Manggala</p>
                    </div>
                    
                    <div class="form-body">
                        @if($errors->any())
                            <div class="alert alert-danger" data-aos="fade-in">
                                <h6><i class="bi bi-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('join.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Data Pribadi -->
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="section-title mb-4">
                                        <i class="bi bi-person me-2"></i>Data Pribadi
                                    </h5>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nama_lengkap" class="form-label">
                                            Nama Lengkap <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                               id="nama_lengkap" 
                                               name="nama_lengkap" 
                                               value="{{ old('nama_lengkap') }}"
                                               placeholder="Masukkan nama lengkap">
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nim" class="form-label">
                                            NIM <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('nim') is-invalid @enderror" 
                                               id="nim" 
                                               name="nim" 
                                               value="{{ old('nim') }}"
                                               placeholder="Masukkan NIM">
                                        @error('nim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="jurusan" class="form-label">
                                            Jurusan <span class="required">*</span>
                                        </label>
                                        <select class="form-select @error('jurusan') is-invalid @enderror" 
                                                id="jurusan" 
                                                name="jurusan">
                                            <option value="">Pilih Jurusan</option>
                                            <option value="Teknik" {{ old('jurusan') == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                                            <option value="Akuntansi" {{ old('jurusan') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                                            <option value="Administrasi Bisnis" {{ old('jurusan') == 'Administrasi Bisnis' ? 'selected' : '' }}>Administrasi Bisnis</option>
                                        </select>
                                        @error('jurusan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="program_studi" class="form-label">
                                            Program Studi <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('program_studi') is-invalid @enderror" 
                                               id="program_studi" 
                                               name="program_studi" 
                                               value="{{ old('program_studi') }}"
                                               placeholder="Masukkan program studi">
                                        @error('program_studi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="form-label">
                                            Jenis Kelamin <span class="required">*</span>
                                        </label>
                                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                                id="jenis_kelamin" 
                                                name="jenis_kelamin">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="no_hp" class="form-label">
                                            No. HP <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('no_hp') is-invalid @enderror" 
                                               id="no_hp" 
                                               name="no_hp" 
                                               value="{{ old('no_hp') }}"
                                               placeholder="Masukkan nomor HP">
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir" class="form-label">
                                            Tempat Lahir <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                               id="tempat_lahir" 
                                               name="tempat_lahir" 
                                               value="{{ old('tempat_lahir') }}"
                                               placeholder="Masukkan tempat lahir">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="form-label">
                                            Tanggal Lahir <span class="required">*</span>
                                        </label>
                                        <input type="date" 
                                               class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                               id="tanggal_lahir" 
                                               name="tanggal_lahir" 
                                               value="{{ old('tanggal_lahir') }}">
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="alamat" class="form-label">
                                    Alamat Lengkap <span class="required">*</span>
                                </label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" 
                                          name="alamat" 
                                          rows="3" 
                                          placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Data Tambahan -->
                            <div class="row mt-5">
                                <div class="col-12">
                                    <h5 class="section-title mb-4">
                                        <i class="bi bi-info-circle me-2"></i>Informasi Tambahan
                                    </h5>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="organisasi_yang_pernah_diikuti" class="form-label">
                                    Organisasi yang Pernah Diikuti
                                </label>
                                <textarea class="form-control @error('organisasi_yang_pernah_diikuti') is-invalid @enderror" 
                                          id="organisasi_yang_pernah_diikuti" 
                                          name="organisasi_yang_pernah_diikuti" 
                                          rows="3" 
                                          placeholder="Sebutkan organisasi yang pernah Anda ikuti (opsional)">{{ old('organisasi_yang_pernah_diikuti') }}</textarea>
                                <div class="form-text">Kosongkan jika belum pernah mengikuti organisasi</div>
                                @error('organisasi_yang_pernah_diikuti')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="alasan_bergabung" class="form-label">
                                    Alasan Bergabung <span class="required">*</span>
                                </label>
                                <textarea class="form-control @error('alasan_bergabung') is-invalid @enderror" 
                                          id="alasan_bergabung" 
                                          name="alasan_bergabung" 
                                          rows="4" 
                                          placeholder="Alasan Anda ingin bergabung dengan UKM Cakra Manggala (minimal 20 karakter)">{{ old('alasan_bergabung') }}</textarea>
                                <div class="form-text">Minimal 20 karakter</div>
                                @error('alasan_bergabung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="foto_diri" class="form-label">
                                    Foto Diri <span class="required">*</span>
                                </label>
                                <input type="file" 
                                       class="form-control @error('foto_diri') is-invalid @enderror" 
                                       id="foto_diri" 
                                       name="foto_diri" 
                                       accept="image/*">
                                <div class="form-text">Upload foto diri bebas (JPG, PNG, maksimal 2MB)</div>
                                @error('foto_diri')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mt-4">
                                <button type="submit" class="btn btn-submit">
                                    <i class="bi bi-send me-2"></i>Daftar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection