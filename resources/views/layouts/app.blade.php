{{-- File: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UKM Cakra Manggala - Pecinta Alam & Konservasi')</title>
    
    <meta name="description" content="@yield('meta_description', 'UKM Cakra Manggala adalah organisasi mahasiswa pecinta alam yang berdedikasi pada pelestarian lingkungan, pendidikan karakter, dan petualangan alam bebas.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Cakra Manggala, Pecinta Alam Madiun, UKM Mapala, Konservasi Lingkungan, Survival, Pendakian Gunung, Pendidikan Karakter')">
    <meta name="author" content="UKM Cakra Manggala">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'UKM Cakra Manggala - Pecinta Alam & Konservasi')">
    <meta property="og:description" content="@yield('meta_description', 'UKM Cakra Manggala adalah organisasi mahasiswa pecinta alam yang berdedikasi pada pelestarian lingkungan.')">
    <meta property="og:image" content="@yield('og_image', asset('image/logo.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'UKM Cakra Manggala - Pecinta Alam & Konservasi')">
    <meta property="twitter:description" content="@yield('meta_description', 'UKM Cakra Manggala adalah organisasi mahasiswa pecinta alam yang berdedikasi pada pelestarian lingkungan.')">
    <meta property="twitter:image" content="@yield('og_image', asset('image/logo.png'))">

    @yield('structured_data')

    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Organization",
      "name": "UKM Cakra Manggala",
      "url": "https://cakramanggalapnm.com",
      "logo": "{{ asset('favicon.png') }}",
      "description": "UKM Cakra Manggala adalah organisasi mahasiswa pecinta alam di Politeknik Negeri Madiun yang berfokus pada pelestarian lingkungan and pendidikan karakter.",
      "sameAs": [
        "https://www.instagram.com/cakramanggala.pnm"
      ]
    }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Montserrat:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Favicon & App Icons -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <style>
        :root {
            --primary-color: #1a4331;
            --secondary-color: #255b44;
            --accent-color: #f2b661;
            --dark-color: #07110c;
            --surface-color: #f3efe7;
            --surface-soft: #faf6ef;
            --surface-panel: #fffdf8;
            --text-color: #122119;
            --muted-color: #5d675f;
            --border-soft: rgba(18, 33, 25, 0.08);
            --shadow-soft: 0 18px 45px rgba(7, 17, 12, 0.08);
            --shadow-hover: 0 22px 55px rgba(7, 17, 12, 0.13);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--surface-color);
            color: var(--text-color);
            overflow-x: hidden;
            --nav-foreground: #ffffff;
            --nav-chip-bg: rgba(255, 255, 255, 0.08);
            --nav-chip-border: rgba(255, 255, 255, 0.18);
        }

        a {
            color: inherit;
        }

        select.form-select,
        select.form-control {
            color: #ffffff !important;
            background-color: #1a1a1a !important;
        }

        select option {
            background-color: #111111 !important;
            color: #ffffff !important;
            padding: 10px;
        }

        img {
            max-width: 100%;
        }

        .container {
            width: min(100% - 2rem, 1180px);
        }

        body.site-menu-open {
            overflow: hidden;
        }

        .layout-overlay-nav {
            --nav-foreground: #ffffff;
            --nav-chip-bg: rgba(255, 255, 255, 0.08);
            --nav-chip-border: rgba(255, 255, 255, 0.18);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .section-title,
        .footer-title {
            font-family: 'Montserrat', sans-serif;
        }

        main {
            padding-top: clamp(6rem, 9vw, 7rem);
        }

        .layout-overlay-nav main {
            padding-top: 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .section-shell {
            padding: clamp(4rem, 8vw, 6rem) 0;
        }

        .section-shell--soft {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.68) 0%, rgba(255, 255, 255, 0.28) 100%);
        }

        .section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.55rem 0.85rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(26, 67, 49, 0.12);
            background: rgba(255, 255, 255, 0.72);
            color: var(--primary-color);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .section-heading {
            margin-bottom: 1rem;
            font-size: clamp(2rem, 4vw, 3.2rem);
            line-height: 1.05;
            letter-spacing: -0.04em;
            color: var(--primary-color);
        }

        .section-lead {
            max-width: 680px;
            margin: 0;
            color: var(--muted-color);
            font-size: 1.02rem;
            line-height: 1.8;
        }

        .text-accent {
            color: var(--accent-color) !important;
        }

        .text-secondary-accent {
            color: var(--secondary-color) !important;
        }

        .bg-white-10 {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        .section-intro {
            max-width: 760px;
            margin: 0 auto 2.75rem;
            text-align: center;
        }

        .surface-card {
            height: 100%;
            padding: clamp(1.35rem, 2vw, 2rem);
            border: 1px solid var(--border-soft);
            background: rgba(255, 253, 248, 0.96);
            box-shadow: var(--shadow-soft);
            transition: transform 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease;
        }

        .surface-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(26, 67, 49, 0.14);
        }

        .surface-card--compact {
            padding: 1.2rem;
        }

        .media-panel {
            position: relative;
            overflow: hidden;
            min-height: 100%;
            background: #d9e1d9;
            box-shadow: var(--shadow-soft);
        }

        .media-panel img {
            width: 100%;
            height: 100%;
            min-height: 320px;
            object-fit: cover;
        }

        .icon-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 3.8rem;
            height: 3.8rem;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            color: #fff;
            font-size: 1.5rem;
            box-shadow: 0 14px 30px rgba(26, 67, 49, 0.18);
        }

        .chip-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 0.8rem;
            border: 1px solid rgba(26, 67, 49, 0.1);
            background: rgba(26, 67, 49, 0.05);
            color: var(--primary-color);
            font-size: 0.86rem;
            font-weight: 600;
        }

        .metric-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.9rem;
            margin-top: 1.5rem;
        }

        .metric-item {
            padding: 1rem;
            border: 1px solid var(--border-soft);
            background: rgba(255, 255, 255, 0.78);
        }

        .metric-value {
            display: block;
            margin-bottom: 0.35rem;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .metric-label {
            color: var(--muted-color);
            font-size: 0.86rem;
            line-height: 1.5;
        }

        /* Premium Card Component - Square & Dark Theme */
        .premium-card {
            background: var(--primary-color);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            color: #fff;
        }

        .premium-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.25);
            border-color: var(--accent-color);
        }

        .premium-card__img-wrapper {
            position: relative;
            overflow: hidden;
            aspect-ratio: 16 / 11;
            border-radius: 0;
        }

        .premium-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .premium-card:hover .premium-card__img {
            transform: scale(1.1);
        }

        .premium-card__badge {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.6rem 1.2rem;
            background: var(--accent-color);
            color: var(--primary-color);
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            z-index: 2;
        }

        .premium-card__body {
            padding: 2.2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .premium-card__meta {
            display: flex;
            gap: 1rem;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .premium-card__meta i {
            color: var(--accent-color);
        }

        .premium-card__title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 1rem;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .premium-card__text {
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.7;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .premium-card__footer {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-premium-link {
            font-weight: 800;
            color: var(--accent-color);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.3s ease;
        }

        .btn-premium-link:hover {
            gap: 0.9rem;
            color: #fff;
        }

        .btn-premium {
            background: var(--accent-color);
            color: var(--primary-color);
            padding: 1rem 2rem;
            font-weight: 800;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border: none;
            border-radius: 0;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-premium:hover {
            background: #fff;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .page-hero {
            position: relative;
            overflow: hidden;
            min-height: clamp(24rem, 58vw, 36rem);
            display: flex;
            align-items: flex-end;
            padding: clamp(8rem, 13vw, 10.5rem) 0 clamp(4rem, 8vw, 6.2rem);
            color: #fff;
            background: #09110d;
            background-image: var(--hero-image);
            background-size: cover;
            background-position: center;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(to bottom, rgba(4, 9, 7, 0.3) 0%, rgba(4, 9, 7, 0.5) 50%, rgba(4, 9, 7, 0.8) 100%);
            pointer-events: none;
        }

        .page-hero__media {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .page-hero__title {
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .page-hero .container {
            position: relative;
            z-index: 2;
            width: min(100% - 2rem, 1180px);
        }

        .page-hero__inner {
            max-width: 820px;
        }

        .page-hero__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.7rem 1.1rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.88);
        }

        .page-hero__title {
            margin-bottom: 1.2rem;
            font-size: clamp(2.8rem, 8vw, 5.8rem);
            font-weight: 800;
            line-height: 0.92;
            letter-spacing: -0.05em;
            text-transform: uppercase;
            text-wrap: balance;
        }

        .page-hero__title span {
            color: var(--accent-color);
        }

        .page-hero__lead {
            max-width: 680px;
            margin: 0;
            color: rgba(255, 255, 255, 0.82);
            font-size: clamp(1rem, 2vw, 1.18rem);
            line-height: 1.75;
        }

        .page-hero+.section-shell {
            padding-top: clamp(3rem, 6vw, 4.5rem);
        }

        .news-section {
            padding: 5rem 0;
            background: #f8f9fa;
        }

        .news-card {
            border: none;
            border-radius: 0;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .news-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .news-meta {
            color: #5d675f;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .site-navbar {
            position: fixed;
            inset: 0 0 auto;
            z-index: 1080;
            padding: 0;
            background: rgba(26, 67, 49, 0.56);
            border-bottom: 1px solid rgba(255, 255, 255, 0.14);
            box-shadow: 0 16px 40px rgba(6, 14, 10, 0.18);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            transition: background 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .site-navbar-shell {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 82px;
            padding: 0.65rem 0;
        }

        .site-navbar.is-scrolled {
            background: rgba(18, 52, 37, 0.74);
            border-color: rgba(255, 255, 255, 0.12);
            box-shadow: 0 20px 46px rgba(6, 14, 10, 0.24);
        }

        .site-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.85rem;
            min-width: 0;
            text-decoration: none;
            color: var(--nav-foreground);
        }

        .site-brand:hover {
            color: var(--nav-foreground);
        }

        .site-brand img {
            width: 58px;
            height: 58px;
            object-fit: contain;
            padding: 0;
            background: transparent;
            border: none;
            filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.2));
        }

        .site-brand-label {
            color: var(--nav-foreground);
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .site-navbar-links {
            display: none;
            align-items: center;
            gap: 0.35rem;
            margin-left: auto;
            margin-right: 1rem;
        }

        .site-navbar-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0.72rem 0.9rem;
            color: rgba(255, 255, 255, 0.82);
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 600;
            transition: color 0.22s ease, background 0.22s ease;
        }

        .site-navbar-link:hover,
        .site-navbar-link:focus-visible,
        .site-navbar-link.is-active {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
        }

        /* Custom Hover Dropdown for Navbar */
        .site-navbar-dropdown {
            position: relative;
            display: inline-block;
        }

        .site-navbar-dropdown-content {
            display: none;
            position: absolute;
            top: calc(100% + 32px);
            left: 50%;
            transform: translateX(-50%);
            background: rgba(26, 67, 49, 0.85);
            min-width: 220px;
            box-shadow: 0 20px 48px rgba(6, 14, 10, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            z-index: 1090;
            padding: 0.5rem 0;
        }

        .site-navbar-dropdown-content::before {
            content: '';
            position: absolute;
            top: -34px;
            left: 0;
            right: 0;
            height: 34px;
            background: transparent;
        }

        .site-navbar-dropdown-content a {
            display: block;
            padding: 0.8rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            transition: all 0.25s ease;
            text-transform: none;
            letter-spacing: normal;
        }

        .site-navbar-dropdown-content a:hover,
        .site-navbar-dropdown-content a.is-active {
            color: var(--accent-color);
            background: rgba(255, 255, 255, 0.05);
            padding-left: 1.8rem;
        }

        .site-navbar-dropdown:hover .site-navbar-dropdown-content {
            display: block;
        }

        .site-navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-left: auto;
        }

        .site-navbar-join,
        .site-menu-join,
        .btn-premium {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.95rem 1.45rem;
            border: 1px solid rgba(242, 182, 97, 0.6);
            background: linear-gradient(135deg, #f2c57b 0%, #de9541 100%);
            color: #15120d;
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.84rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            box-shadow: 0 16px 40px rgba(222, 149, 65, 0.22);
            transition: transform 0.25s ease, filter 0.25s ease, box-shadow 0.25s ease;
        }

        .site-navbar-join:hover,
        .site-menu-join:hover,
        .btn-premium:hover {
            color: #15120d;
            transform: translateY(-2px);
            filter: brightness(1.05);
            box-shadow: 0 22px 50px rgba(222, 149, 65, 0.28);
        }

        .site-navbar-join {
            white-space: nowrap;
        }

        .site-menu-join {
            width: 100%;
            gap: 0.8rem;
            padding: 1.1rem 1.25rem;
            font-size: 0.9rem;
            box-shadow: 0 18px 40px rgba(222, 149, 65, 0.24);
        }

        .site-menu-trigger,
        .site-menu-close {
            display: inline-flex;
            align-items: center;
            gap: 0.85rem;
            min-height: auto;
            padding: 0;
            border: none;
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            transition: opacity 0.22s ease, transform 0.22s ease;
        }

        .site-menu-trigger {
            color: var(--nav-foreground);
        }

        .site-menu-close {
            color: #ffffff;
        }

        .site-navbar-join:hover,
        .site-navbar-join:focus-visible,
        .site-menu-join:hover,
        .site-menu-join:focus-visible {
            color: #15120d;
            transform: translateY(-2px);
            filter: brightness(1.03);
        }

        .site-menu-trigger:hover,
        .site-menu-trigger:focus-visible,
        .site-menu-close:hover,
        .site-menu-close:focus-visible {
            opacity: 1;
            transform: translateY(-1px);
            filter: none;
        }

        .site-menu-trigger:hover,
        .site-menu-trigger:focus-visible {
            color: var(--nav-foreground);
        }

        .site-menu-close:hover,
        .site-menu-close:focus-visible {
            color: #ffffff;
        }

        .site-menu-trigger__icon,
        .site-menu-close__icon {
            display: inline-flex;
            flex-direction: column;
            gap: 4px;
        }

        .site-menu-trigger__icon span,
        .site-menu-close__icon span {
            width: 20px;
            height: 2px;
            background: currentColor;
            transition: transform 0.22s ease, opacity 0.22s ease;
        }

        .site-menu-close__icon span:first-child {
            transform: translateY(3px) rotate(45deg);
        }

        .site-menu-close__icon span:last-child {
            transform: translateY(-3px) rotate(-45deg);
        }

        .site-menu-trigger[aria-expanded="true"] .site-menu-trigger__icon span:nth-child(1) {
            transform: translateY(6px) rotate(45deg);
        }

        .site-menu-trigger[aria-expanded="true"] .site-menu-trigger__icon span:nth-child(2) {
            opacity: 0;
        }

        .site-menu-trigger[aria-expanded="true"] .site-menu-trigger__icon span:nth-child(3) {
            transform: translateY(-6px) rotate(-45deg);
        }

        .site-menu-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1110;
            background: rgba(3, 8, 6, 0.22);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.28s ease, visibility 0.28s ease;
        }

        .site-menu-panel {
            position: fixed;
            top: 0.75rem;
            right: 0.75rem;
            z-index: 1120;
            width: min(430px, calc(100vw - 1.5rem));
            height: calc(100vh - 1.5rem);
            padding: 0.8rem;
            background: rgba(8, 19, 13, 0.34);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 26px 80px rgba(4, 9, 7, 0.22);
            backdrop-filter: blur(24px) saturate(120%);
            -webkit-backdrop-filter: blur(24px) saturate(120%);
            transform: translateX(100%);
            opacity: 0;
            visibility: hidden;
            transition: transform 0.32s ease, opacity 0.32s ease, visibility 0.32s ease;
        }

        body.site-menu-open .site-menu-backdrop,
        body.site-menu-open .site-menu-panel {
            opacity: 1;
            visibility: visible;
        }

        body.site-menu-open .site-menu-panel {
            transform: translateX(0);
        }

        .site-menu-panel__inner {
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 1.15rem;
            border: none;
            background: transparent;
        }

        .site-menu-panel__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding-bottom: 0.95rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .site-menu-panel__title {
            margin: 0;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .site-menu-panel__eyebrow {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.66rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
        }

        .site-menu-panel__body {
            display: flex;
            flex-direction: column;
            padding-top: 1.15rem;
            flex: 1;
            overflow: hidden;
            min-height: 0;
        }

        .site-menu-links {
            display: grid;
            gap: 0;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.1) transparent;
        }

        .site-menu-links::-webkit-scrollbar {
            width: 3px;
        }

        .site-menu-links::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.15);
        }

        .site-menu-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.75rem 0.2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.82);
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            transition: color 0.22s ease, padding-left 0.22s ease, background 0.22s ease;
            flex-shrink: 0;
        }

        .site-menu-link:last-child {
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .site-menu-link:hover,
        .site-menu-link:focus-visible,
        .site-menu-link.is-active {
            color: #fff;
            padding-left: 0.45rem;
            background: rgba(255, 255, 255, 0.025);
        }

        .site-menu-panel__meta {
            display: grid;
            gap: 0.5rem;
            flex-shrink: 0;
            margin-top: 0.75rem;
        }

        .site-menu-panel__contact {
            margin: 0;
            color: rgba(255, 255, 255, 0.62);
            line-height: 1.7;
            font-size: 0.9rem;
        }

        @media (max-width: 767px) {
            .site-navbar {
                padding: 0;
            }

            .site-brand img {
                width: 44px;
                height: 44px;
            }

            .site-brand-label {
                font-size: 0.82rem;
            }

            .site-navbar-shell {
                min-height: 64px;
                padding: 0.5rem 0;
            }

            .site-navbar-actions {
                gap: 0.65rem;
            }

            .site-navbar-join {
                padding: 0.65rem 0.8rem;
                font-size: 0.7rem;
            }

            .site-menu-trigger {
                min-height: auto;
                padding: 0;
            }

            .site-menu-trigger__label {
                font-size: 0.7rem;
            }

            .site-menu-panel {
                top: 0;
                right: 0;
                width: 100vw;
                height: 100vh;
                padding: 0.5rem;
                border-radius: 0;
                border: none;
            }

            .site-menu-panel__inner {
                padding: 0.85rem;
            }

            .site-menu-panel__header {
                padding-bottom: 0.75rem;
            }

            .site-menu-panel__title {
                font-size: 0.88rem;
            }

            .site-menu-link {
                font-size: 0.82rem;
                padding: 0.65rem 0.15rem;
            }

            .site-menu-link i {
                font-size: 0.8rem;
            }

            /* Mobile menu join button compact */
            .site-menu-join {
                padding: 0.85rem 1rem;
                font-size: 0.8rem;
            }

            /* Keep cards 2-column on mobile */
            .mobile-2col {
                column-count: 2;
            }
        }

        /* Global mobile card grid fix - ensure min 2 cols on small screens */
        @media (max-width: 575px) {
            .row-mobile-2col > [class*="col-12"] {
                width: 50% !important;
                flex: 0 0 50% !important;
                max-width: 50% !important;
            }
        }

        @media (min-width: 992px) {
            .site-navbar-links {
                display: flex;
            }

            .site-navbar-actions {
                margin-left: 0;
            }

            .site-menu-trigger {
                display: none;
            }
        }

        @media (max-width: 991px) {
            .site-navbar-join {
                display: none;
            }
        }

        .footer {
            position: relative;
            background: #07110c;
            color: #fff;
            padding: 4.25rem 0 0;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            inset: 0 0 auto;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 20%, rgba(255, 255, 255, 0.2) 80%, transparent 100%);
        }

        .footer-grid {
            row-gap: 2rem;
        }

        .footer-column {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .footer [data-footer-item] {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .footer.is-visible [data-footer-item] {
            opacity: 1;
            transform: translateY(0);
        }

        .footer-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent-color);
        }

        .footer-logo {
            display: inline-flex;
            align-items: center;
            gap: 0.9rem;
            text-decoration: none;
            color: #fff;
        }

        .footer-logo img {
            width: 58px;
            height: 58px;
            padding: 0.35rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-logo strong {
            display: block;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.05rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .footer-logo span span,
        .footer-description,
        .footer-address,
        .footer-list-date,
        .footer-note {
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.8;
        }

        .footer-list {
            display: grid;
            gap: 0.95rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .footer-list a {
            color: rgba(255, 255, 255, 0.84);
            text-decoration: none;
            transition: color 0.22s ease, padding-left 0.22s ease;
        }

        .footer-list a:hover,
        .footer-list a:focus-visible {
            color: #fff;
            padding-left: 0.3rem;
        }

        .footer-list-title {
            display: block;
            font-weight: 600;
        }

        .footer-list-date {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.82rem;
        }

        .footer-social {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .footer-social a,
        .footer-action {
            border-radius: 0;
        }

        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.04);
            color: #fff;
            text-decoration: none;
            transition: background 0.22s ease, border-color 0.22s ease, transform 0.22s ease;
        }

        .footer-social a:hover,
        .footer-social a:focus-visible {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .footer-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.65rem;
            padding: 0.95rem 1.2rem;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.04);
            color: #fff;
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition: background 0.22s ease, border-color 0.22s ease, transform 0.22s ease;
        }

        .footer-action:hover,
        .footer-action:focus-visible {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .footer-bottom {
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-bottom__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.25rem 0;
            color: rgba(255, 255, 255, 0.56);
            font-size: 0.88rem;
        }

        @media (max-width: 991px) {
            .footer-bottom__inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 767px) {
            .footer {
                padding-top: 3.5rem;
            }

            .metric-strip {
                grid-template-columns: 1fr;
            }

            .page-hero {
                padding-top: 7.6rem;
            }

            .section-shell {
                padding: 3.5rem 0;
            }
        }

        /* ── Mobile Horizontal Scrollable Card Strip ── */
        @media (max-width: 767px) {
            .mobile-horizontal-scroll {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 1rem;
                padding-top: 0.5rem;
                margin-left: -0.75rem;
                margin-right: -0.75rem;
                padding-left: 0.75rem;
                padding-right: 0.75rem;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }
            .mobile-horizontal-scroll::-webkit-scrollbar {
                display: none;
            }
            .mobile-horizontal-scroll > [class*="col-"] {
                flex: 0 0 82% !important;
                max-width: 82% !important;
                width: 82% !important;
                scroll-snap-align: start;
            }
        }

        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in-up.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* ==========================================================================
           Cakra Manggala Design System - Unified Card List Filter Component
           ========================================================================== */
        .cm-filter-card {
            background: linear-gradient(145deg, rgba(26, 67, 49, 0.45) 0%, rgba(7, 17, 12, 0.75) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(242, 182, 97, 0.22);
            border-radius: 14px;
            padding: 1.5rem 1.75rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.08);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .cm-filter-card:hover {
            border-color: rgba(242, 182, 97, 0.35);
            box-shadow: 0 22px 45px rgba(0, 0, 0, 0.42), inset 0 1px 0 rgba(255, 255, 255, 0.12);
        }

        .cm-filter-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .cm-filter-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent-color);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cm-filter-group {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .cm-filter-group .cm-filter-icon {
            position: absolute;
            left: 1rem;
            color: var(--accent-color);
            font-size: 1.1rem;
            pointer-events: none;
            z-index: 3;
            display: flex;
            align-items: center;
        }

        .cm-filter-control {
            width: 100%;
            background-color: rgba(7, 17, 12, 0.85) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
            font-size: 0.92rem;
            font-family: 'Inter', sans-serif;
            border-radius: 8px !important;
            padding: 0.75rem 1rem 0.75rem 2.75rem !important;
            transition: all 0.25s ease !important;
            height: 48px;
        }

        .cm-filter-control::placeholder {
            color: rgba(255, 255, 255, 0.45);
        }

        .cm-filter-control:focus {
            background-color: rgba(7, 17, 12, 0.95) !important;
            border-color: var(--accent-color) !important;
            box-shadow: 0 0 0 3px rgba(242, 182, 97, 0.25) !important;
            outline: none !important;
        }

        select.cm-filter-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23f2b661' class='bi bi-chevron-down' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 1rem center !important;
            background-size: 14px 14px !important;
            padding-right: 2.5rem !important;
            cursor: pointer;
        }

        select.cm-filter-control option {
            background-color: #0f2118 !important;
            color: #ffffff !important;
            padding: 12px 16px;
        }

        .cm-btn-filter {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, var(--accent-color) 0%, #e0a34b 100%);
            color: var(--primary-color) !important;
            border: none;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 0.82rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(242, 182, 97, 0.25);
            cursor: pointer;
            text-decoration: none;
        }

        .cm-btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(242, 182, 97, 0.4);
            background: linear-gradient(135deg, #f7c579 0%, var(--accent-color) 100%);
            color: var(--primary-color) !important;
        }

        .cm-btn-reset {
            width: 100%;
            height: 48px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.85) !important;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .cm-btn-reset:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.28);
            color: #ffffff !important;
        }

        .cm-active-filters {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
            padding-top: 0.85rem;
            border-top: 1px dashed rgba(255, 255, 255, 0.1);
        }

        .cm-active-filters__label {
            font-size: 0.75rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-right: 0.25rem;
        }

        .cm-filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(242, 182, 97, 0.12);
            border: 1px solid rgba(242, 182, 97, 0.3);
            color: var(--accent-color);
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .cm-filter-chip a {
            color: rgba(255, 255, 255, 0.6);
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .cm-filter-chip a:hover {
            color: #ffffff;
        }

        /* ==========================================================================
           Cakra Manggala Design System - Custom Glassmorphism Select Dropdown UI
           ========================================================================== */
        .cm-select-wrapper {
            position: relative;
            width: 100%;
        }

        .cm-select-trigger {
            width: 100%;
            height: 48px;
            background-color: rgba(7, 17, 12, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #ffffff;
            font-size: 0.92rem;
            font-family: 'Inter', sans-serif;
            border-radius: 8px;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.25s ease;
            user-select: none;
        }

        .cm-select-trigger:hover,
        .cm-select-wrapper.open .cm-select-trigger {
            background-color: rgba(12, 28, 20, 0.95);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(242, 182, 97, 0.2);
        }

        .cm-select-trigger .cm-select-label {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #ffffff;
            flex-grow: 1;
        }

        .cm-select-trigger .cm-select-arrow {
            color: var(--accent-color);
            transition: transform 0.3s ease;
            font-size: 0.85rem;
            margin-left: 0.5rem;
            flex-shrink: 0;
        }

        .cm-select-wrapper.open .cm-select-arrow {
            transform: rotate(180deg);
        }

        .cm-select-menu {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            z-index: 1050;
            background: linear-gradient(160deg, rgba(10, 26, 18, 0.96) 0%, rgba(7, 17, 12, 0.98) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(242, 182, 97, 0.3);
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5), 0 0 15px rgba(242, 182, 97, 0.15);
            max-height: 280px;
            overflow-y: auto;
            display: none;
            padding: 0.5rem;
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .cm-select-wrapper.open .cm-select-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .cm-select-optgroup-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent-color);
            padding: 0.6rem 0.8rem 0.3rem;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.1);
            margin-bottom: 0.25rem;
            margin-top: 0.4rem;
        }

        .cm-select-optgroup-label:first-child {
            margin-top: 0;
        }

        .cm-select-item {
            padding: 0.65rem 0.85rem;
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.88rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.18s ease;
            margin-bottom: 2px;
        }

        .cm-select-item:hover {
            background: rgba(242, 182, 97, 0.15);
            color: var(--accent-color);
            padding-left: 1.1rem;
        }

        .cm-select-item.selected {
            background: rgba(242, 182, 97, 0.22);
            color: var(--accent-color);
            font-weight: 700;
        }

        .cm-select-item .cm-check-icon {
            opacity: 0;
            color: var(--accent-color);
            transition: opacity 0.2s ease;
        }

        .cm-select-item.selected .cm-check-icon {
            opacity: 1;
        }

        .cm-select-menu::-webkit-scrollbar {
            width: 6px;
        }
        .cm-select-menu::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }
        .cm-select-menu::-webkit-scrollbar-thumb {
            background: rgba(242, 182, 97, 0.3);
            border-radius: 4px;
        }
        .cm-select-menu::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
        }
    </style>

    @stack('styles')
</head>
@php
    $bodyClasses = implode(' ', array_filter([
        trim($__env->yieldContent('body_class')),
        request()->routeIs('home', 'home.alt', 'about', 'about.history', 'about.member', 'contact', 'struktur-kepengurusan', 'artikel.index', 'artikel.show', 'catatan-perjalanan.index', 'catatan-perjalanan.show', 'activities', 'activities.show', 'activities.gunung-hutan', 'activities.panjat-tebing') ? 'layout-overlay-nav' : null,
    ]));
@endphp

<body class="{{ $bodyClasses }}">
    <nav class="site-navbar" data-site-navbar>
        <div class="container">
            <div class="site-navbar-shell">
                <a class="site-brand" href="{{ route('home') }}">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo Cakra Manggala">
                    <span class="site-brand-label">Cakra Manggala</span>
                </a>

                <nav class="site-navbar-links" aria-label="Navigasi desktop">
                    <a class="site-navbar-link {{ request()->routeIs('home', 'home.alt') ? 'is-active' : '' }}"
                        href="{{ route('home') }}">Beranda</a>

                    <div class="site-navbar-dropdown">
                        <a class="site-navbar-link {{ request()->routeIs('about', 'about.history', 'struktur-kepengurusan', 'about.member') ? 'is-active' : '' }}" href="javascript:void(0)">
                            Profil <i class="bi bi-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                        </a>
                        <div class="site-navbar-dropdown-content">
                            <a class="{{ request()->routeIs('about') ? 'is-active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                            <a class="{{ request()->routeIs('about.history') ? 'is-active' : '' }}" href="{{ route('about.history') }}">Sejarah</a>
                            <a class="{{ request()->routeIs('struktur-kepengurusan') ? 'is-active' : '' }}" href="{{ route('struktur-kepengurusan') }}">Pengurus</a>
                            <a class="{{ request()->routeIs('about.member') ? 'is-active' : '' }}" href="{{ route('about.member') }}">Anggota</a>
                        </div>
                    </div>

                    <div class="site-navbar-dropdown">
                        <a class="site-navbar-link {{ request()->routeIs('catatan-perjalanan.index', 'catatan-perjalanan.show', 'artikel.index', 'artikel.show') ? 'is-active' : '' }}" href="javascript:void(0)">
                            Jurnal <i class="bi bi-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                        </a>
                        <div class="site-navbar-dropdown-content">
                            <a class="{{ request()->routeIs('catatan-perjalanan.index', 'catatan-perjalanan.show') ? 'is-active' : '' }}" href="{{ route('catatan-perjalanan.index') }}">Catatan Perjalanan</a>
                            <a class="{{ request()->routeIs('artikel.index', 'artikel.show') ? 'is-active' : '' }}" href="{{ route('artikel.index') }}">Artikel</a>
                        </div>
                    </div>

                    <div class="site-navbar-dropdown">
                        <a class="site-navbar-link {{ request()->routeIs('activities', 'activities.show', 'activities.gunung-hutan', 'activities.panjat-tebing') ? 'is-active' : '' }}" href="javascript:void(0)">
                            Aktivitas <i class="bi bi-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                        </a>
                        <div class="site-navbar-dropdown-content">
                            <a class="{{ request()->routeIs('activities') ? 'is-active' : '' }}" href="{{ route('activities') }}">Kegiatan</a>
                            <a class="{{ request()->routeIs('activities.gunung-hutan') ? 'is-active' : '' }}" href="{{ route('activities.gunung-hutan') }}">Gunung Hutan</a>
                            <a class="{{ request()->routeIs('activities.panjat-tebing') ? 'is-active' : '' }}" href="{{ route('activities.panjat-tebing') }}">Panjat Tebing</a>
                        </div>
                    </div>

                    <a class="site-navbar-link {{ request()->routeIs('contact') ? 'is-active' : '' }}"
                        href="{{ route('contact') }}">Kontak</a>
                </nav>

                <div class="site-navbar-actions">
                    <a href="{{ route('join') }}" class="site-navbar-join">Gabung</a>
                    <button type="button" class="site-menu-trigger" data-site-menu-trigger aria-expanded="false"
                        aria-controls="siteMenuPanel" aria-label="Buka menu navigasi">
                        <span class="site-menu-trigger__label">Menu</span>
                        <span class="site-menu-trigger__icon" aria-hidden="true">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="site-menu-backdrop" data-site-menu-close></div>

    <aside class="site-menu-panel" id="siteMenuPanel" aria-hidden="true">
        <div class="site-menu-panel__inner">
            <div class="site-menu-panel__header">
                <div>
                    <div class="site-menu-panel__eyebrow">Navigasi</div>
                    <h2 class="site-menu-panel__title">Menu</h2>
                </div>
                <button type="button" class="site-menu-close" data-site-menu-close aria-label="Tutup menu">
                    <span>Tutup</span>
                    <span class="site-menu-close__icon" aria-hidden="true">
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="site-menu-panel__body">
                <nav class="site-menu-links" aria-label="Menu utama">
                    <a class="site-menu-link {{ request()->routeIs('home', 'home.alt') ? 'is-active' : '' }}"
                        href="{{ route('home') }}">
                        <span>Beranda</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('about') ? 'is-active' : '' }}"
                        href="{{ route('about') }}">
                        <span>Tentang Kami</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('about.history') ? 'is-active' : '' }}"
                        href="{{ route('about.history') }}">
                        <span>Sejarah</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('struktur-kepengurusan') ? 'is-active' : '' }}"
                        href="{{ route('struktur-kepengurusan') }}">
                        <span>Pengurus</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('about.member') ? 'is-active' : '' }}"
                        href="{{ route('about.member') }}">
                        <span>Anggota</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('catatan-perjalanan.index', 'catatan-perjalanan.show') ? 'is-active' : '' }}"
                        href="{{ route('catatan-perjalanan.index') }}">
                        <span>Catatan Perjalanan</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('artikel.index', 'artikel.show') ? 'is-active' : '' }}"
                        href="{{ route('artikel.index') }}">
                        <span>Artikel</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('activities') ? 'is-active' : '' }}"
                        href="{{ route('activities') }}">
                        <span>Kegiatan</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('activities.gunung-hutan') ? 'is-active' : '' }}"
                        href="{{ route('activities.gunung-hutan') }}">
                        <span>Gunung Hutan</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('activities.panjat-tebing') ? 'is-active' : '' }}"
                        href="{{ route('activities.panjat-tebing') }}">
                        <span>Panjat Tebing</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                    <a class="site-menu-link {{ request()->routeIs('contact') ? 'is-active' : '' }}"
                        href="{{ route('contact') }}">
                        <span>Kontak</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                </nav>

                <div class="mt-4">
                    <a href="{{ route('join') }}" class="site-menu-join">
                        <span>Gabung Sekarang</span>
                        <i class="bi bi-person-plus-fill"></i>
                    </a>
                </div>

                <div class="site-menu-panel__meta">
                    <div class="site-menu-panel__contact">
                        Sekretariat UKM Pecinta Alam Cakra Manggala<br>
                        Politeknik Negeri Madiun
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <main>
        @yield('content')
    </main>

    <footer class="footer" data-footer-reveal>
        <div class="container">
            <div class="row footer-grid">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-column" data-footer-item>
                        <a href="{{ route('home') }}" class="footer-logo">
                            <img src="{{ asset('image/logo.png') }}" alt="Logo Cakra Manggala">
                            <span>
                                <strong>Cakra Manggala</strong>
                                <span>UKM Pecinta Alam</span>
                            </span>
                        </a>
                        <h5 class="footer-title">Visi Singkat</h5>
                        <p class="footer-description">Menjadi ruang bertumbuh bagi mahasiswa yang tangguh, terampil, dan
                            bertanggung jawab dalam petualangan serta pelestarian alam.</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-column" data-footer-item>
                        <h5 class="footer-title">Quick Links</h5>
                        <ul class="footer-list">
                            <li><a href="{{ route('home') }}">Beranda</a></li>
                            <li><a href="{{ route('artikel.index') }}">Artikel</a></li>
                            <li><a href="{{ route('catatan-perjalanan.index') }}">Catatan Perjalanan</a></li>
                            <li><a href="{{ route('activities') }}">Kegiatan</a></li>
                            <li><a href="{{ route('join') }}">Gabung</a></li>
                            <li><a href="{{ route('contact') }}">Kontak</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-column" data-footer-item>
                        <h5 class="footer-title">Latest Activities</h5>
                        <ul class="footer-list">
                            @forelse(($footerActivities ?? collect()) as $activity)
                                <li>
                                    <a href="{{ route('activities') }}#activity-{{ $activity->id }}">
                                        <span class="footer-list-title">{{ $activity->judul_kegiatan }}</span>
                                        <span class="footer-list-date">{{ $activity->tanggal_pelaksanaan->format('d M Y') }}
                                            · {{ $activity->tempat }}</span>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <a href="{{ route('activities') }}">
                                        <span class="footer-list-title">Lihat arsip kegiatan</span>
                                        <span class="footer-list-date">Dokumentasi kegiatan dan aktivitas lapangan
                                            terbaru.</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('artikel.index') }}">
                                        <span class="footer-list-title">Buka halaman artikel</span>
                                        <span class="footer-list-date">Update artikel, catatan perjalanan, dan laporan
                                            kegiatan.</span>
                                    </a>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-column" data-footer-item>
                        <h5 class="footer-title">Stay Connected</h5>
                        <div class="footer-social">
                            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                        </div>
                        <p class="footer-address">Sekretariat UKM Pecinta Alam Cakra Manggala<br>Politeknik Negeri
                            Madiun<br>Madiun, Jawa Timur</p>
                        <a href="{{ route('contact') }}" class="footer-action">
                            <i class="bi bi-envelope-open"></i>
                            <span>Contact</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom__inner">
                    <p class="mb-0">&copy; {{ date('Y') }} Cakra Manggala. All rights reserved.</p>
                    <p class="footer-note mb-0">Build for explorers, training, and environmental stewardship.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        if (window.AOS) {
            AOS.init({
                duration: 800,
                once: true
            });
        }

        const siteNavbar = document.querySelector('[data-site-navbar]');

        if (siteNavbar) {
            const syncNavbarState = () => {
                siteNavbar.classList.toggle('is-scrolled', window.scrollY > 24);
            };

            syncNavbarState();
            window.addEventListener('scroll', syncNavbarState, { passive: true });
        }

        const menuTrigger = document.querySelector('[data-site-menu-trigger]');
        const menuPanel = document.getElementById('siteMenuPanel');
        const menuCloseTargets = document.querySelectorAll('[data-site-menu-close]');

        if (menuTrigger && menuPanel) {
            const toggleMenu = (forceState) => {
                const nextState = typeof forceState === 'boolean'
                    ? forceState
                    : !document.body.classList.contains('site-menu-open');

                document.body.classList.toggle('site-menu-open', nextState);
                menuTrigger.setAttribute('aria-expanded', String(nextState));
                menuPanel.setAttribute('aria-hidden', String(!nextState));
            };

            menuTrigger.addEventListener('click', () => toggleMenu());

            menuCloseTargets.forEach((target) => {
                target.addEventListener('click', () => toggleMenu(false));
            });

            document.querySelectorAll('.site-menu-link').forEach((link) => {
                link.addEventListener('click', () => toggleMenu(false));
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    toggleMenu(false);
                }
            });
        }

        const counters = document.querySelectorAll('.stat-number');

        if (counters.length && 'IntersectionObserver' in window) {
            const animateCounter = (element, target) => {
                let current = 0;
                const increment = target / 100;
                const timer = setInterval(() => {
                    current += increment;
                    element.textContent = Math.floor(current);

                    if (current >= target) {
                        element.textContent = target;
                        clearInterval(timer);
                    }
                }, 20);
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target'), 10);

                    if (!Number.isNaN(target)) {
                        animateCounter(counter, target);
                    }

                    observer.unobserve(counter);
                });
            });

            counters.forEach((counter) => observer.observe(counter));
        }

        const footer = document.querySelector('[data-footer-reveal]');

        if (footer && 'IntersectionObserver' in window) {
            const footerObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    footer.classList.add('is-visible');
                    footerObserver.unobserve(entry.target);
                });
            }, { threshold: 0.18 });

            footerObserver.observe(footer);
        } else if (footer) {
            footer.classList.add('is-visible');
        }

        // ==========================================================================
        // Cakra Manggala Custom Glassmorphism Select Dropdown Enhancer
        // ==========================================================================
        function initCmCustomSelects() {
            document.querySelectorAll('select.cm-filter-control, .cm-filter-card select').forEach(function(select) {
                if (select.dataset.cmCustomInit) return;
                select.dataset.cmCustomInit = 'true';

                select.style.display = 'none';

                const wrapper = document.createElement('div');
                wrapper.className = 'cm-select-wrapper';

                const parentGroup = select.closest('.cm-filter-group');
                let iconHtml = '';
                if (parentGroup) {
                    const iconElem = parentGroup.querySelector('.cm-filter-icon');
                    if (iconElem) {
                        iconHtml = iconElem.outerHTML;
                        iconElem.remove();
                    }
                }

                const selectedOption = select.options[select.selectedIndex] || select.options[0];
                const initialText = selectedOption ? selectedOption.text : 'Pilih...';

                const trigger = document.createElement('div');
                trigger.className = 'cm-select-trigger';
                trigger.innerHTML = `
                    ${iconHtml}
                    <span class="cm-select-label">${initialText}</span>
                    <i class="bi bi-chevron-down cm-select-arrow"></i>
                `;

                const menu = document.createElement('div');
                menu.className = 'cm-select-menu';

                function addOptionItem(opt, idx) {
                    const item = document.createElement('div');
                    item.className = 'cm-select-item' + (opt.selected ? ' selected' : '');
                    item.dataset.value = opt.value;
                    item.dataset.index = idx;
                    item.innerHTML = `
                        <span>${opt.text}</span>
                        <i class="bi bi-check2 cm-check-icon"></i>
                    `;

                    item.addEventListener('click', function(e) {
                        e.stopPropagation();
                        select.selectedIndex = idx;
                        select.dispatchEvent(new Event('change', { bubbles: true }));

                        menu.querySelectorAll('.cm-select-item').forEach(i => i.classList.remove('selected'));
                        item.classList.add('selected');
                        trigger.querySelector('.cm-select-label').textContent = opt.text;
                        wrapper.classList.remove('open');

                        if (select.getAttribute('onchange')) {
                            if (select.form) {
                                select.form.submit();
                            }
                        }
                    });

                    menu.appendChild(item);
                }

                let optIndex = 0;
                Array.from(select.children).forEach(function(child) {
                    if (child.tagName === 'OPTGROUP') {
                        const groupLabel = document.createElement('div');
                        groupLabel.className = 'cm-select-optgroup-label';
                        groupLabel.textContent = child.label;
                        menu.appendChild(groupLabel);

                        Array.from(child.children).forEach(function(opt) {
                            addOptionItem(opt, optIndex++);
                        });
                    } else if (child.tagName === 'OPTION') {
                        addOptionItem(child, optIndex++);
                    }
                });

                wrapper.appendChild(trigger);
                wrapper.appendChild(menu);
                select.parentNode.insertBefore(wrapper, select);
                wrapper.appendChild(select);

                trigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    document.querySelectorAll('.cm-select-wrapper.open').forEach(w => {
                        if (w !== wrapper) w.classList.remove('open');
                    });
                    wrapper.classList.toggle('open');
                });
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCmCustomSelects);
        } else {
            initCmCustomSelects();
        }
        window.addEventListener('load', initCmCustomSelects);

        document.addEventListener('click', function() {
            document.querySelectorAll('.cm-select-wrapper.open').forEach(w => w.classList.remove('open'));
        });
    </script>

    @stack('scripts')
</body>

</html>