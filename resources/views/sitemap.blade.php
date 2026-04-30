<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('about') }}</loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('activities') }}</loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('join') }}</loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('contact') }}</loc>
        <priority>0.7</priority>
    </url>

    @foreach ($artikels as $artikel)
    <url>
        <loc>{{ url('/artikel/' . $artikel->slug) }}</loc>
        <lastmod>{{ $artikel->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach

    @foreach ($kegiatans as $kegiatan)
    <url>
        <loc>{{ route('activities', ['search' => $kegiatan->judul_kegiatan]) }}</loc>
        <lastmod>{{ $kegiatan->updated_at->toAtomString() }}</lastmod>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>
