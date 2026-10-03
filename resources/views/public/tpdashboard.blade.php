<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Nama sekolah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @php
                        $menu = [
                            "public.dashboard" => "Beranda",
                            "public.profile"         => "Profil Sekolah",
                            "public.extracurricular" => "Ekstrakurikuler",
                            "public.teachers"        => "Guru",
                            "public.students"        => "Siswa",
                            "public.news"            => "Berita",
                            "public.gallery"         => "Galeri",
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

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="{{ asset('assets/landing/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>