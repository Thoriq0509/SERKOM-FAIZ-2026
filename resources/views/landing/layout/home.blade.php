<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sekolah')</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/aos-library/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container position-relative">

            {{-- Brand: logo + nama --}}
            <a class="navbar-brand navbar-brand-custom" href="{{ route('landing.dashboard') }}">
                <img src="{{ asset('assets/admin/img/smatn.png') }}"
                     alt="Logo Sekolah"
                     class="brand-logo">
                <span class="brand-name">SMA TARUNA NUSANTARA</span>
            </a>

            {{-- Toggler mobile --}}
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu — DORONG KE KANAN --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    @php
                        $menu = [
                            "landing.dashboard"       => "Beranda",
                            "landing.profile"         => "Profil Sekolah",
                            "landing.teachers"        => "Guru",
                            "landing.students"        => "Siswa",
                            "landing.extracurricular" => "Ekstrakurikuler",
                            "landing.news"            => "Berita",
                            "landing.gallery"         => "Galeri",
                        ];
                    @endphp

                    @foreach ($menu as $route => $label)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}"
                               href="{{ route($route) }}">{{ $label }}</a>
                        </li>
                    @endforeach

                </ul>
            </div>

        </div>
    </nav>

    {{-- Konten --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="landing-footer">
        <div class="container">
            <div class="row g-4">

                {{-- Brand --}}
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <img src="{{ asset('assets/admin/img/smatn.png') }}"
                             alt="Logo Sekolah"
                             class="footer-logo">
                        <h5>SMA Taruna Nusantara</h5>
                    </div>
                    <p class="footer-desc">
                        Membangun generasi unggul, berkarakter, dan berprestasi
                        dengan semangat kenusantaraan.
                    </p>

                    <div class="footer-social">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                {{-- Kontak --}}
                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-title">Kontak Kami</h6>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-location-dot"></i>
                            <span>Jl. Raya Magelang - Purworejo KM 5, Banyurojo, Mertoyudan, Magelang, Jawa Tengah 56172</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>(0293) 364195</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>info@smatn.sch.id</span>
                        </li>
                    </ul>
                </div>

                {{-- Tautan --}}
                <div class="col-lg-4 col-md-12">
                    <h6 class="footer-title">Tautan Cepat</h6>
                    <div class="row">
                        <div class="col-6">
                            <ul class="footer-links">
                                <li><a href="{{ route('landing.dashboard') }}">Beranda</a></li>
                                <li><a href="{{ route('landing.profile') }}">Profil</a></li>
                                <li><a href="{{ route('landing.teachers') }}">Guru</a></li>
                                <li><a href="{{ route('landing.students') }}">Siswa</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="footer-links">
                                <li><a href="{{ route('landing.extracurricular') }}">Ekstrakurikuler</a></li>
                                <li><a href="{{ route('landing.news') }}">Berita</a></li>
                                <li><a href="{{ route('landing.gallery') }}">Galeri</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Copyright --}}
            <div class="footer-bottom">
                <p class="mb-0">
                    &copy; {{ date('Y') }} <strong>SMA Taruna Nusantara</strong>. Hak cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/landing/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landing/aos-library/aos.js') }}"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>

    @stack('scripts')
</body>
</html>