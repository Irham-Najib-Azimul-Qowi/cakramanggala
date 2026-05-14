@extends('layouts.app')

@section('title', 'Hubungi Kami - UKM Cakra Manggala')

@section('content')
    @php
        $heroImage = asset('image/fotobersejarah2.jpg');
    @endphp

    <section class="page-hero" style="--hero-image: url('{{ $heroImage }}');">
        <div class="container">
            <div class="page-hero__inner">
                <span class="page-hero__eyebrow" data-aos="fade-up">
                    <i class="bi bi-chat-left-text"></i>
                    Komunikasi
                </span>
                <h1 class="page-hero__title" data-aos="fade-up" data-aos-delay="100">Hubungi Kami</h1>
                <p class="page-hero__lead" data-aos="fade-up" data-aos-delay="200">
                    Ada pertanyaan atau ingin berkolaborasi? Kami siap mendengar dan merespons pesan Anda.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Info Cards -->
    <section class="section-shell" style="background-color: var(--dark-color); color: #fff;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="premium-card p-5 text-center"
                        style="background: var(--primary-color); border: 1px solid rgba(255,255,255,0.05); height: 100%;">
                        <div
                            style="width: 60px; height: 60px; background: var(--accent-color); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 2rem;">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h3 class="h5 fw-bold text-white mb-3" style="letter-spacing: 0.1em; text-transform: uppercase;">
                            Sekretariat</h3>
                        <div style="width: 40px; height: 2px; background: var(--accent-color); margin: 0 auto 1.5rem;">
                        </div>
                        <p class="mb-0" style="color: rgba(255,255,255,0.6); font-size: 0.95rem; line-height: 1.6;">
                            Gedung Perkuliahan Kampus 1, Lantai 1<br>
                            Politeknik Negeri Madiun<br>
                            Jl. Serayu No.84, Kota Madiun
                        </p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="premium-card p-5 text-center"
                        style="background: var(--primary-color); border: 1px solid rgba(255,255,255,0.05); height: 100%;">
                        <div
                            style="width: 60px; height: 60px; background: var(--accent-color); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 2rem;">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h3 class="h5 fw-bold text-white mb-3" style="letter-spacing: 0.1em; text-transform: uppercase;">
                            Korespondensi</h3>
                        <div style="width: 40px; height: 2px; background: var(--accent-color); margin: 0 auto 1.5rem;">
                        </div>
                        <a href="mailto:sekretariat.cakramanggala@pnm.ac.id" class="text-decoration-none fw-bold"
                            style="color: var(--accent-color); font-size: 0.85rem;">sekretariat.cakramanggala@pnm.ac.id</a>
                        <p class="mt-3 mb-0" style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">Kirimkan surat
                            elektronik untuk keperluan formal atau kerjasama.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="premium-card p-5 text-center"
                        style="background: var(--primary-color); border: 1px solid rgba(255,255,255,0.05); height: 100%;">
                        <div
                            style="width: 60px; height: 60px; background: var(--accent-color); color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 2rem;">
                            <i class="bi bi-instagram"></i>
                        </div>
                        <h3 class="h5 fw-bold text-white mb-3" style="letter-spacing: 0.1em; text-transform: uppercase;">
                            Sosial Media</h3>
                        <div style="width: 40px; height: 2px; background: var(--accent-color); margin: 0 auto 1.5rem;">
                        </div>
                        <a href="https://instagram.com/cakramanggala.pnm" target="_blank"
                            class="text-decoration-none fw-bold"
                            style="color: var(--accent-color); font-size: 1.1rem; letter-spacing: 0.05em;">@cakramanggala.pnm</a>
                        <p class="mt-3 mb-0" style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">Dapatkan info
                            terupdate dan dokumentasi dokumentasi terbaru melalui Instagram.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Map -->
    <section class="section-shell" style="background-color: var(--primary-color); color: #fff;">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="premium-card p-5"
                        style="background: var(--dark-color); border: 1px solid rgba(255,255,255,0.05);">
                        <h2 class="h3 fw-bold text-white mb-2" style="letter-spacing: -0.02em;">Kirim Pesan</h2>
                        <p style="color: rgba(255,255,255,0.5); margin-bottom: 3rem;">Kami akan membalas pesan Anda sesegera
                            mungkin.</p>

                        @if(session('success_contact'))
                            <div class="alert alert-success border-0 rounded-0 p-4 shadow-sm mb-4"
                                style="background: var(--accent-color); color: var(--primary-color); font-weight: 700;">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success_contact') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-white-50"
                                        style="text-transform: uppercase; letter-spacing: 0.1em;">Nama Lengkap</label>
                                    <input type="text" name="name"
                                        class="form-control bg-transparent py-3 text-white rounded-0"
                                        style="border: 1px solid rgba(255,255,255,0.1);" placeholder="Nama Anda" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-white-50"
                                        style="text-transform: uppercase; letter-spacing: 0.1em;">Email</label>
                                    <input type="email" name="email"
                                        class="form-control bg-transparent py-3 text-white rounded-0"
                                        style="border: 1px solid rgba(255,255,255,0.1);" placeholder="email@contoh.com"
                                        required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-white-50"
                                        style="text-transform: uppercase; letter-spacing: 0.1em;">Subjek</label>
                                    <input type="text" name="subject"
                                        class="form-control bg-transparent py-3 text-white rounded-0"
                                        style="border: 1px solid rgba(255,255,255,0.1);" placeholder="Topik pembicaraan"
                                        required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-white-50"
                                        style="text-transform: uppercase; letter-spacing: 0.1em;">Pesan</label>
                                    <textarea name="message" rows="5"
                                        class="form-control bg-transparent py-3 text-white rounded-0"
                                        style="border: 1px solid rgba(255,255,255,0.1);"
                                        placeholder="Tuliskan pesan Anda..." required></textarea>
                                </div>
                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn-join-premium w-100 py-3 rounded-0"
                                        style="padding: 1.2rem; font-size: 0.95rem;">
                                        KIRIM PESAN <i class="bi bi-send-fill ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5" data-aos="fade-left">
                    <div class="premium-card overflow-hidden h-100 shadow-sm rounded-0"
                        style="border: 1px solid rgba(255,255,255,0.05); min-height: 500px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.5123984871954!2d111.535032!3d-7.632296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79be96f6a7d3ef%3A0xe541e204c3cf7b52!2sPoliteknik%20Negeri%20Madiun!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0; filter: grayscale(1) invert(0.9) opacity(0.8);"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection