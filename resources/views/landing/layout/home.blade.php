<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sekolah')</title>

    {{-- Favicon dari database --}}
    @if (!empty($schoolProfile?->logo))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $schoolProfile->logo) }}">
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $schoolProfile->logo) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/smatn.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/admin/img/smatn.png') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/aos-library/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-custom" id="mainNavbar">
        <div class="container">

            {{-- Brand: logo + divider + nama sekolah --}}
            <a class="navbar-brand navbar-brand-custom" href="{{ route('landing.dashboard') }}">
                @if ($schoolProfile && $schoolProfile->logo)
                    <img src="{{ asset('storage/' . $schoolProfile->logo) }}"
                         alt="Logo {{ $schoolProfile->nama_sekolah }}"
                         class="brand-logo">
                @else
                    <img src="{{ asset('assets/admin/img/smatn.png') }}"
                         alt="Logo Sekolah"
                         class="brand-logo">
                @endif

                <span class="brand-divider"></span>

                <span class="brand-text">
                    <span class="brand-line-2">
                        {{ $schoolProfile->nama_sekolah ?? 'SMA Taruna Nusantara' }}
                    </span>
                </span>
            </a>

            {{-- Toggler --}}
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">

                    {{-- Beranda --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.dashboard') ? 'active' : '' }}"
                           href="{{ route('landing.dashboard') }}">Beranda</a>
                    </li>

                    {{-- Dropdown Profil --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('landing.profile') || request()->routeIs('landing.history') || request()->routeIs('landing.vision-mission') ? 'active' : '' }}"
                           href="#"
                           id="profilDropdown"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('landing.profile') ? 'active' : '' }}"
                                   href="{{ route('landing.profile') }}">
                                    Profil Sekolah
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('landing.history') ? 'active' : '' }}"
                                   href="{{ route('landing.history') }}">
                                    Sejarah
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('landing.vision-mission') ? 'active' : '' }}"
                                   href="{{ route('landing.vision-mission') }}">
                                    Visi &amp; Misi
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Menu lain --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.teachers*') ? 'active' : '' }}"
                           href="{{ route('landing.teachers') }}">Guru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.extracurricular*') ? 'active' : '' }}"
                           href="{{ route('landing.extracurricular') }}">Ekstrakurikuler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.news*') ? 'active' : '' }}"
                           href="{{ route('landing.news') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.gallery') ? 'active' : '' }}"
                           href="{{ route('landing.gallery') }}">Galeri</a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    {{-- Konten halaman --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="landing-footer">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        @if ($schoolProfile && $schoolProfile->logo)
                            <img src="{{ asset('storage/' . $schoolProfile->logo) }}"
                                 alt="Logo {{ $schoolProfile->nama_sekolah }}"
                                 class="footer-logo">
                        @else
                            <img src="{{ asset('assets/admin/img/smatn.png') }}"
                                 alt="Logo Sekolah"
                                 class="footer-logo">
                        @endif

                        <h5>{{ $schoolProfile->nama_sekolah ?? 'SMA Taruna Nusantara' }}</h5>
                    </div>
                    <p class="footer-desc">
                        Membangun generasi unggul, berkarakter, dan berprestasi
                        dengan semangat kenusantaraan.
                    </p>

                    <div class="footer-social">

                        @if (!empty($schoolProfile?->facebook))
                            <a href="{{ $schoolProfile->facebook }}"
                               target="_blank"
                               rel="noopener"
                               aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif

                        @if (!empty($schoolProfile?->instagram))
                            <a href="{{ $schoolProfile->instagram }}"
                               target="_blank"
                               rel="noopener"
                               aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif

                        @if (!empty($schoolProfile?->whatsapp))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $schoolProfile->whatsapp) }}"
                               target="_blank"
                               rel="noopener"
                               aria-label="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif

                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-title">Kontak Kami</h6>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-location-dot"></i>
                            <span>{{ $schoolProfile->alamat ?? 'Alamat sekolah' }}</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>{{ $schoolProfile->kontak ?? '(0293) 364195' }}</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>{{ $schoolProfile->email ?? 'info@smatn.sch.id' }}</span>
                        </li>
                    </ul>
                </div>

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

            <div class="footer-bottom">
                <p class="mb-0">
                    &copy; {{ date('Y') }}
                    <strong>{{ $schoolProfile->nama_sekolah ?? 'SMA Taruna Nusantara' }}</strong>.
                    Hak cipta dilindungi.
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

    {{-- Navbar scroll effect --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navbar = document.getElementById("mainNavbar");
            if (!navbar) return;

            function handleScroll() {
                if (window.scrollY > 50) {
                    navbar.classList.add("scrolled");
                } else {
                    navbar.classList.remove("scrolled");
                }
            }

            handleScroll();
            window.addEventListener("scroll", handleScroll, { passive: true });
        });
    </script>

    @stack('scripts')
</body>
</html>