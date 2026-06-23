@extends('layouts.app')

@section('title', $artikel->judul . ' - UKM Cakra Manggala')
@section('meta_description', $artikel->excerpt ?: Str::limit(strip_tags($artikel->konten), 160))

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
            font-size: clamp(2rem, 5vw, 3.5rem);
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: -0.04em;
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

        .article-figure {
            margin: 0 0 4rem;
        }

        .article-figure img {
            width: 100%;
            max-height: 600px;
            object-fit: cover;
        }

        .article-figure figcaption {
            padding: 1rem;
            color: rgba(255,255,255,0.4);
            font-size: 0.75rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            background: rgba(0,0,0,0.15);
        }

        .article-content {
            color: rgba(255,255,255,0.85);
            font-size: 1.15rem;
            line-height: 1.9;
        }

        .article-content p {
            margin-bottom: 1.8rem;
        }

        .article-content blockquote {
            margin: 4rem 0;
            padding: 3rem;
            background: var(--dark-color);
            border-left: 4px solid var(--accent-color);
            color: var(--accent-color);
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1.35;
            font-style: italic;
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
            border: 1px solid rgba(255,255,255,0.05);
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

        .article-related-item__media {
            width: 90px;
            height: 65px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .article-related-item__media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

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

        @media (max-width: 991px) {
            .article-layout { grid-template-columns: 1fr; gap: 3rem; }
            .article-main__body { padding: 2.5rem 1.5rem; }
        }
    </style>
@endpush

@section('structured_data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BlogPosting",
    "headline": "{{ $artikel->judul }}",
    "image": "{{ $artikel->gambar_utama ? asset($artikel->gambar_utama) : asset('image/logo.png') }}",
    "author": {
      "@@type": "Person",
      "name": "{{ $artikel->user->name }}"
    },
    "publisher": {
      "@@type": "Organization",
      "name": "UKM Cakra Manggala",
      "logo": {
        "@@type": "ImageObject",
        "url": "{{ asset('image/logo.png') }}"
      }
    },
  "datePublished": "{{ $artikel->created_at->toIso8601String() }}",
  "dateModified": "{{ $artikel->updated_at->toIso8601String() }}",
  "description": "{{ $artikel->excerpt ?: Str::limit(strip_tags($artikel->konten), 160) }}"
}
</script>
@endsection

@section('content')
    <section class="section-shell" style="background: var(--dark-color); padding-top: 6rem; padding-bottom: 8rem;">
        <div class="container">
            <div class="article-layout">
                <article class="article-main" data-aos="fade-up">
                    <div class="article-main__body">
                        <!-- Back Button -->
                        <div class="mb-4">
                            <a href="{{ route('artikel.index') }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i> Kembali ke Artikel
                            </a>
                        </div>

                        <nav class="article-breadcrumb">
                            <a href="{{ route('home') }}">Beranda</a>
                            <span>/</span>
                            <a href="{{ route('artikel.index') }}">Artikel</a>
                            <span>/</span>
                            <span style="color: #fff">Baca Tulisan</span>
                        </nav>

                        <header class="article-head">
                            <h1 class="article-head__title">{{ $artikel->judul }}</h1>
                            <div class="article-head__meta">
                                <div class="article-meta-item">
                                    <div class="article-author__badge">{{ strtoupper(substr($artikel->user->name, 0, 1)) }}</div>
                                    <span>{{ $artikel->user->name }}</span>
                                </div>
                                <div class="article-meta-item">
                                    <i class="bi bi-calendar3"></i>
                                    <span>{{ $artikel->created_at->format('d F Y') }}</span>
                                </div>
                                <div class="article-meta-item">
                                    <i class="bi bi-clock"></i>
                                    <span>{{ $artikel->reading_time }} Baca</span>
                                </div>
                                <div class="article-meta-item">
                                    <i class="bi bi-eye"></i>
                                    <span>{{ number_format($artikel->views) }} Views</span>
                                </div>
                            </div>

                            @if($artikel->excerpt)
                                <div class="article-summary">
                                    {{ $artikel->excerpt }}
                                </div>
                            @endif
                        </header>

                        @if($artikel->gambar_utama)
                            <figure class="article-figure">
                                <img src="{{ asset($artikel->gambar_utama) }}" alt="Foto Utama: {{ $artikel->judul }}" loading="lazy">
                                <figcaption>Dokumentasi: {{ $artikel->judul }}</figcaption>
                            </figure>
                        @endif

                        <div class="article-content">
                            {!! $artikel->konten !!}
                        </div>

                        <div class="article-share-bar">
                            <h2>Bagikan Tulisan</h2>
                            <div class="article-share-actions">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="article-share-action">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($artikel->judul) }}" target="_blank" class="article-share-action">
                                    <i class="bi bi-twitter-x"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' - ' . request()->fullUrl()) }}" target="_blank" class="article-share-action">
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
                    @if($relatedArtikels->count() > 0)
                        <div class="article-sidebar-card" data-aos="fade-up" data-aos-delay="100">
                            <h2>Lainnya</h2>
                            <div class="article-related-list">
                                @foreach($relatedArtikels as $related)
                                    <a href="{{ route('artikel.show', $related->slug) }}" class="article-related-item">
                                        <div class="article-related-item__media">
                                            <img src="{{ $related->gambar_utama ? asset($related->gambar_utama) : asset('image/fotobersejarah2.jpg') }}" alt="Artikel Terkait: {{ $related->judul }}" loading="lazy">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h3 class="article-related-item__title">{{ Str::limit($related->judul, 50) }}</h3>
                                            <div class="article-related-item__meta">{{ $related->created_at->format('d M Y') }}</div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="article-sidebar-card shadow-lg" data-aos="fade-up" data-aos-delay="150" style="background: var(--dark-color); border: 1px solid rgba(255,255,255,0.05);">
                        <h2>Eksplorasi</h2>
                        <p style="color: rgba(255,255,255,0.5); font-size: 0.95rem; margin-bottom: 2.5rem; line-height: 1.8;">
                            Kembali ke arsip untuk menemukan wawasan dan kisah perjalanan lainnya dari Cakra Manggala.
                        </p>
                        <a href="{{ route('artikel.index') }}" class="article-sidebar-action">
                            <i class="bi bi-collection-fill"></i> Semua Artikel
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