@extends('layouts.app')

@section('title', $catatan->judul . ' - UKM Cakra Manggala')
@section('meta_description', $catatan->deskripsi ?: Str::limit(strip_tags($catatan->konten), 160))

@push('styles')
    <style>
        main {
            background-color: var(--dark-color);
        }
        .container {
            max-width: 1400px !important;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.6);
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }
        .btn-back:hover {
            color: var(--accent-color);
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--accent-color);
            transform: translateX(-4px);
        }
        .article-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.7fr) minmax(280px, 0.6fr);
            gap: 3rem;
            align-items: start;
        }

        .article-main {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
        }

        .article-main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--accent-color);
        }

        .article-main__body {
            padding: clamp(1.5rem, 5vw, 4.5rem);
        }

        .article-breadcrumb {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-bottom: 2.5rem;
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.2em;
        }

        .article-breadcrumb a {
            color: var(--accent-color);
            text-decoration: none;
            transition: all 0.2s;
        }

        .article-breadcrumb a:hover {
            color: #fff;
        }

        .article-head__title {
            margin-bottom: 2rem;
            color: #fff;
            font-size: clamp(1.8rem, 4vw, 3rem);
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .article-head__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            color: rgba(255,255,255,0.5);
            font-size: 0.8rem;
            padding-bottom: 2.5rem;
            margin-bottom: 3rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 700;
        }

        .article-meta-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .article-meta-item i {
            color: var(--accent-color);
            font-size: 1.1rem;
        }

        .article-author__badge {
            width: 36px;
            height: 36px;
            background: var(--accent-color);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 0.8rem;
        }

        .article-summary {
            padding: 2.5rem;
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 4rem;
            font-style: italic;
            line-height: 1.8;
            color: rgba(255,255,255,0.8);
            position: relative;
        }

        .article-content {
            color: rgba(255,255,255,0.85);
            font-size: 1.15rem;
            line-height: 1.9;
        }

        .article-content p {
            margin-bottom: 1.8rem;
        }

        .article-share-bar {
            margin-top: 6rem;
            padding-top: 4rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .article-share-bar h2 {
            font-size: 0.75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            margin-bottom: 2rem;
            color: rgba(255,255,255,0.4);
        }

        .article-share-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .article-share-action {
            padding: 1rem 1.8rem;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff;
            text-decoration: none;
            font-weight: 800;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.3s;
        }

        .article-share-action:hover {
            background: var(--accent-color);
            color: var(--primary-color);
            border-color: var(--accent-color);
            transform: translateY(-3px);
        }

        .article-sidebar-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2.5rem;
            margin-bottom: 2rem;
        }

        .article-sidebar-card h2 {
            font-size: 0.8rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 2.5rem;
            color: var(--accent-color);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .article-sidebar-card h2::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.1);
        }

        .article-related-item {
            display: flex;
            gap: 1.5rem;
            text-decoration: none;
            color: inherit;
            margin-bottom: 2rem;
            transition: opacity 0.2s;
        }

        .article-related-item:hover { opacity: 0.7; }

        .article-related-item__title {
            font-size: 0.95rem;
            font-weight: 800;
            line-height: 1.4;
            margin-bottom: 0.4rem;
            color: #fff;
        }

        .article-related-item__meta {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.4);
        }

        .article-sidebar-action {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding: 1.25rem;
            background: var(--accent-color);
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-size: 0.8rem;
            transition: all 0.3s;
        }

        .article-sidebar-action:hover {
            background: #fff;
            color: var(--primary-color);
        }

        .download-box {
            background: rgba(242, 182, 97, 0.05);
            border: 1px dashed var(--accent-color);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .download-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #fff;
            margin-bottom: 0.2rem;
        }

        @media (max-width: 991px) {
            .article-layout { grid-template-columns: 1fr; gap: 3rem; }
            .article-main__body { padding: 2.5rem 1.5rem; }
        }
    </style>
@endpush

@section('content')
    <section class="section-shell" style="background: var(--dark-color); padding-top: 6rem; padding-bottom: 8rem;">
        <div class="container">
            <div class="article-layout">
                <article class="article-main" data-aos="fade-up">
                    <div class="article-main__body">
                        <!-- Back Button -->
                        <div class="mb-4">
                            <a href="{{ route('catatan-perjalanan.index') }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i> Kembali ke Catatan Perjalanan
                            </a>
                        </div>

                        <nav class="article-breadcrumb">
                            <a href="{{ route('home') }}">Beranda</a>
                            <span>/</span>
                            <a href="{{ route('catatan-perjalanan.index') }}">Catatan Perjalanan</a>
                            <span>/</span>
                            <span style="color: #fff">Detail Jurnal</span>
                        </nav>

                        <header class="article-head">
                            <h1 class="article-head__title">{{ $catatan->judul }}</h1>
                            <div class="article-head__meta">
                                <div class="article-meta-item">
                                    <div class="article-author__badge">{{ strtoupper(substr($catatan->penulis, 0, 1)) }}</div>
                                    <span>{{ $catatan->penulis }}</span>
                                </div>
                                @if($catatan->kegiatan)
                                    <div class="article-meta-item">
                                        <i class="bi bi-compass"></i>
                                        <span>Kegiatan: {{ $catatan->kegiatan->judul_kegiatan }}</span>
                                    </div>
                                @endif
                                @if($catatan->lokasi)
                                    <div class="article-meta-item">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ $catatan->lokasi }}</span>
                                    </div>
                                @endif
                                @if($catatan->angkatan)
                                    <div class="article-meta-item">
                                        <i class="bi bi-tags-fill"></i>
                                        <span>{{ $catatan->angkatan }}</span>
                                    </div>
                                @endif
                                <div class="article-meta-item">
                                    <i class="bi bi-calendar3"></i>
                                    <span>{{ $catatan->formatted_date }}</span>
                                </div>
                                <div class="article-meta-item">
                                    <i class="bi bi-clock"></i>
                                    <span>{{ $catatan->reading_time }} Baca</span>
                                </div>
                                <div class="article-meta-item">
                                    <i class="bi bi-eye"></i>
                                    <span>{{ number_format($catatan->views) }} Views</span>
                                </div>
                            </div>

                            @if($catatan->deskripsi)
                                <div class="article-summary">
                                    {{ $catatan->deskripsi }}
                                </div>
                            @endif
                        </header>

                        @if($catatan->gambar)
                            <div class="mb-5 text-center" data-aos="fade-up">
                                <img src="{{ $catatan->gambar_url }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover; border: 1px solid rgba(255,255,255,0.08);" alt="{{ $catatan->judul }}">
                            </div>
                        @endif

                        @if($catatan->file_path)
                            <div class="download-box" data-aos="fade-up">
                                <div>
                                    <h4 class="download-title"><i class="bi bi-file-earmark-arrow-down-fill text-accent me-2"></i>Berkas Lampiran Resmi</h4>
                                    <p class="small text-white-50 mb-0">Catatan perjalanan ini diimpor langsung dari berkas asli diklat/laporan resmi organisasi.</p>
                                </div>
                                <a href="{{ $catatan->file_url }}" target="_blank" class="btn btn-accent d-inline-flex align-items-center justify-content-center py-3" style="max-width: 250px;">
                                    <i class="bi bi-download me-2"></i> UNDUH DOKUMEN ASLI
                                </a>
                            </div>
                        @endif

                        <div class="article-content">
                            {!! nl2br(e($catatan->konten)) !!}
                        </div>

                        <div class="article-share-bar">
                            <h2>Bagikan Catatan Perjalanan</h2>
                            <div class="article-share-actions">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="article-share-action">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($catatan->judul) }}" target="_blank" class="article-share-action">
                                    <i class="bi bi-twitter-x"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($catatan->judul . ' - ' . request()->fullUrl()) }}" target="_blank" class="article-share-action">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                                <button type="button" class="article-share-action" onclick="copyToClipboard('{{ request()->fullUrl() }}')">
                                    <i class="bi bi-link-45deg"></i> Salin Link
                                </button>
                            </div>
                        </div>
                    </div>
                </article>

                <aside class="article-sidebar">
                    @if($recentCatatans->count() > 0)
                        <div class="article-sidebar-card" data-aos="fade-up" data-aos-delay="100">
                            <h2>Jurnal Terbaru</h2>
                            <div class="article-related-list">
                                @foreach($recentCatatans as $recent)
                                    <a href="{{ route('catatan-perjalanan.show', $recent->slug) }}" class="article-related-item">
                                        <div class="flex-grow-1">
                                            <h3 class="article-related-item__title">{{ Str::limit($recent->judul, 50) }}</h3>
                                            <div class="article-related-item__meta"><i class="bi bi-person me-1"></i> {{ $recent->penulis }} &bull; {{ $recent->formatted_date }}</div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="article-sidebar-card shadow-lg" data-aos="fade-up" data-aos-delay="150" style="background: var(--dark-color); border: 1px solid rgba(255,255,255,0.05);">
                        <h2>Navigasi</h2>
                        <p style="color: rgba(255,255,255,0.5); font-size: 0.95rem; margin-bottom: 2.5rem; line-height: 1.8;">
                            Kembali ke galeri catatan perjalanan untuk melihat lebih banyak jurnal kegiatan dan ekspedisi anggota.
                        </p>
                        <a href="{{ route('catatan-perjalanan.index') }}" class="article-sidebar-action">
                            <i class="bi bi-collection-fill"></i> Semua Catatan
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            const toast = document.createElement('div');
            toast.className = 'toast align-items-center text-white border-0 position-fixed';
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; border-radius: 0; background: var(--accent-color); color: var(--primary-color);';
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body fw-bold">
                        <i class="bi bi-check-circle-fill me-2"></i>Link berhasil disalin
                    </div>
                </div>
            `;
            document.body.appendChild(toast);
            new bootstrap.Toast(toast, {delay: 2000}).show();
            setTimeout(() => toast.remove(), 3000);
        });
    }
    </script>
@endpush
