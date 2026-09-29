<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Dashboard Admin - Sistem Sekolah</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/logosuzuran.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css') }}">

    <style>
        * { box-sizing: border-box; }

        html, body { min-height: 100%; width: 100%; max-width: 100%; }

        body {
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            color: #212529;
            font-family: "Segoe UI", Arial, sans-serif;
            overflow-x: hidden;
            -webkit-text-size-adjust: 100%;
        }

        a { text-decoration: none; }
        img { max-width: 100%; height: auto; }

        /* ============ SIDEBAR ============ */
        .sidebar {
            width: 260px;
            height: 100vh;
            height: 100dvh;
            position: fixed;
            top: 0;
            left: 0;
            background: #1f2f46;
            color: #fff;
            overflow-y: auto;
            overflow-x: hidden;
            border-right: 1px solid #172337;
            z-index: 1050;
            transition: transform .25s ease;
            -webkit-overflow-scrolling: touch;
        }

        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-track { background: #1f2f46; }
        .sidebar::-webkit-scrollbar-thumb { background: #53667d; }

        .brand-box {
            min-height: 70px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            background: #19273a;
            border-bottom: 1px solid #30435b;
            color: #fff;
            font-size: .88rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-decoration: none;
            line-height: 1.25;
        }

        .brand-box:hover { background: #172337; color: #fff; }

        .brand-box i {
            width: 30px;
            min-width: 30px;
            margin-right: 10px;
            color: #d6b36a;
            font-size: 1rem;
            text-align: center;
        }

        .brand-box span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .nav-section-title {
            padding: 18px 20px 7px;
            color: #aeb9c8;
            font-size: .67rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .9px;
        }

        .sidebar-menu { list-style: none; margin: 0; padding: 0; }
        .sidebar-menu li { width: 100%; }

        .sidebar-menu li a {
            width: 100%;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #d5dce5;
            border-left: 3px solid transparent;
            font-size: .86rem;
            font-weight: 500;
            transition: background-color .15s ease, color .15s ease, border-color .15s ease;
        }

        .sidebar-menu li a i {
            width: 24px;
            min-width: 24px;
            margin-right: 12px;
            color: #aeb9c8;
            font-size: .93rem;
            text-align: center;
            transition: color .15s ease;
        }

        .sidebar-menu li a span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .sidebar-menu li a:hover { background: #293c56; color: #fff; }
        .sidebar-menu li a:hover i,
        .sidebar-menu li a.active i { color: #d6b36a; }

        .sidebar-menu li a.active {
            background: #2b405c;
            color: #fff;
            border-left-color: #d6b36a;
        }

        /* ============ OVERLAY MOBILE ============ */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            height: 100dvh;
            background: rgba(0,0,0,.45);
            display: none;
            opacity: 0;
            z-index: 1040;
            transition: opacity .25s ease;
        }

        /* ============ MAIN ============ */
        .main-wrapper {
            min-height: 100vh;
            min-height: 100dvh;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            transition: margin-left .25s ease;
            min-width: 0;
            max-width: 100%;
        }

        /* ============ NAVBAR ============ */
        .top-navbar {
            min-height: 68px;
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 25px;
            background: #fff;
            border-bottom: 1px solid #d9dee5;
            width: 100%;
            max-width: 100%;
        }

        .top-navbar > .d-flex {
            flex: 1;
            min-width: 0;
            max-width: 100%;
        }

        .toggle-btn {
            display: none;
            width: 40px;
            height: 40px;
            min-width: 40px;
            padding: 0;
            background: #fff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            color: #344054;
            font-size: 1rem;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
        }

        .toggle-btn:hover { background: #f6f7f9; }

        .search-form {
            width: 100%;
            max-width: 320px;
            display: flex;
            align-items: center;
            padding: 7px 12px;
            background: #f8f9fa;
            border: 1px solid #d9dee5;
            border-radius: 5px;
        }

        .search-form:focus-within { background: #fff; border-color: #8d99a8; }
        .search-form i { color: #6c757d; font-size: .82rem; flex-shrink: 0; }

        .search-form input {
            width: 100%;
            min-width: 0;
            padding: 0 0 0 10px;
            background: transparent;
            border: none;
            outline: none;
            color: #212529;
            font-size: .85rem;
        }

        .search-form input::placeholder { color: #8993a0; }

        /* ============ ADMIN PROFILE ============ */
        .admin-profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 10px 4px 4px;
            background: #fff;
            border: 1px solid #d9dee5;
            border-radius: 5px;
            color: #212529;
            cursor: pointer;
            transition: .15s ease;
            max-width: 100%;
            flex-shrink: 0;
        }

        .admin-profile-btn:hover,
        .admin-profile-btn[aria-expanded="true"] {
            background: #f8f9fa;
            border-color: #aeb7c2;
        }

        .admin-profile-btn img {
            width: 38px;
            height: 38px;
            min-width: 38px;
            object-fit: cover;
            border: 1px solid #d9dee5;
            border-radius: 4px;
        }

        .admin-info {
            display: flex;
            flex-direction: column;
            text-align: left;
            line-height: 1.2;
            min-width: 0;
        }

        .admin-name {
            color: #212529;
            font-size: .85rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .admin-role {
            margin-top: 2px;
            color: #6c757d;
            font-size: .7rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .dropdown-toggle::after { display: none; }

        /* ============ DROPDOWN ============ */
        .dropdown { position: relative; flex-shrink: 0; }

        .admin-dropdown {
            position: fixed !important;
            top: auto;
            right: auto;
            left: auto;
            min-width: 260px;
            max-width: calc(100vw - 20px);
            padding: 0;
            margin: 0 !important;
            background: #fff;
            border: 1px solid #d9dee5;
            border-radius: 6px;
            box-shadow: 0 10px 30px rgba(0,0,0,.15);
            z-index: 3000;
            display: none;
            opacity: 0;
            transform: translateY(-6px);
            transition: opacity .15s ease, transform .15s ease;
            overflow: hidden;
        }

        .admin-dropdown.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .admin-dropdown .dropdown-header {
            padding: 18px 15px 14px;
            white-space: normal;
        }

        .admin-dropdown .dropdown-header img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #d9dee5;
        }

        .admin-dropdown .dropdown-header h6 {
            margin: 8px 0 4px;
            font-size: .9rem;
            font-weight: 600;
            color: #212529;
        }

        .admin-dropdown .dropdown-header small { font-size: .75rem; }

        .admin-dropdown .dropdown-divider {
            margin: 0;
            border-top: 1px solid #e9ecef;
        }

        .admin-dropdown-item {
            display: flex;
            align-items: center;
            padding: 11px 16px;
            color: #212529;
            font-size: .85rem;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background .15s ease;
        }

        .admin-dropdown-item:hover { background: #f8f9fa; }

        .admin-dropdown-item.text-danger { color: #dc3545 !important; }

        .admin-dropdown-item i {
            width: 18px;
            text-align: center;
            margin-right: 10px;
            font-size: .85rem;
        }

        /* ============ CONTENT ============ */
        .content-area {
            flex: 1;
            padding: 25px;
            background: #f4f6f8;
            min-width: 0;
            max-width: 100%;
        }

        .content-area .table-responsive,
        .content-area .table { max-width: 100%; }

        .content-area img,
        .content-area video,
        .content-area iframe {
            max-width: 100%;
            height: auto;
        }

        /* ============ FOOTER ============ */
        .footer-box {
            padding: 15px 25px;
            background: #fff;
            border-top: 1px solid #d9dee5;
            color: #6c757d;
            text-align: center;
            font-size: .8rem;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 1199.98px) {
            .search-form { max-width: 260px; }
            .admin-name, .admin-role { max-width: 110px; }
        }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .toggle-btn { display: inline-flex; }

            .top-navbar { padding: 10px 16px; gap: 8px; }

            .search-form { display: none; }
            .admin-info { display: none; }

            .admin-profile-btn {
                padding: 4px;
                border: none;
                background: transparent;
            }

            .admin-profile-btn:hover,
            .admin-profile-btn[aria-expanded="true"] {
                background: #f8f9fa;
                border: none;
            }

            .admin-profile-btn .fa-chevron-down { display: none; }
            .content-area { padding: 18px 16px; }
        }

        @media (max-width: 767.98px) {
            .top-navbar { min-height: 60px; padding: 8px 12px; }
            .toggle-btn { width: 38px; height: 38px; min-width: 38px; }
            .content-area { padding: 14px 12px; }
            .footer-box { padding: 12px 10px; font-size: .75rem; }
        }

        @media (max-width: 575.98px) {
            .brand-box { min-height: 62px; padding: 0 16px; font-size: .8rem; }
            .top-navbar { min-height: 56px; padding: 8px 10px; }
            .toggle-btn { width: 36px; height: 36px; min-width: 36px; font-size: .9rem; }

            .admin-profile-btn img {
                width: 34px;
                height: 34px;
                min-width: 34px;
            }

            .content-area { padding: 12px 10px; }
            .footer-box { padding: 10px 8px; font-size: .72rem; }

            .admin-dropdown {
                min-width: 0;
                width: calc(100vw - 20px);
                max-width: calc(100vw - 20px);
            }

            .admin-dropdown .dropdown-header { padding: 14px 12px 10px; }
            .admin-dropdown-item { padding: 10px 14px; font-size: .82rem; }
        }

        @media (max-width: 360px) {
            .brand-box { font-size: .74rem; }
            .brand-box span { white-space: normal; line-height: 1.15; }
            .content-area { padding: 10px 8px; }
        }

        @supports (padding: max(0px)) {
            .top-navbar {
                padding-left: max(12px, env(safe-area-inset-left));
                padding-right: max(12px, env(safe-area-inset-right));
            }
            .footer-box {
                padding-bottom: max(12px, env(safe-area-inset-bottom));
            }
        }
    </style>
</head>

<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <a href="{{ route('dashboard') }}" class="brand-box">
        <i class="fas fa-building-columns"></i>
        <span>SISTEM MANAJEMEN SEKOLAH</span>
    </a>

    <div class="nav-section-title">Navigasi Utama</div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
        </li>
    </ul>

    <div class="nav-section-title">Manajemen Data</div>
    <ul class="sidebar-menu">

        {{-- SCHOOL PROFILE --}}
        <li>
            <a href="{{ route('admin.school_profile') }}"
               class="{{ request()->routeIs('admin.school_profile*') ? 'active' : '' }}">
                <i class="fas fa-school"></i>
                <span>Profil Sekolah</span>
            </a>
        </li>

        {{-- USERS --}}
        <li>
            <a href="{{ route('admin.users.index') }}"
               class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-user-gear"></i>
                <span>Data Pengelola</span>
            </a>
        </li>

        {{-- NEWS --}}
        <li>
            <a href="{{ route('admin.news.index') }}"
               class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span>Kelola Berita</span>
            </a>
        </li>

        {{-- EXTRACURRICULAR --}}
        <li>
            <a href="{{ route('admin.extracurricular.index') }}"
               class="{{ request()->routeIs('admin.extracurricular.*') ? 'active' : '' }}">
                <i class="fas fa-people-group"></i>
                <span>Ekstrakurikuler</span>
            </a>
        </li>

        {{-- TEACHERS --}}
        <li>
            <a href="{{ route('admin.guru') }}"
               class="{{ request()->routeIs('admin.guru*') ? 'active' : '' }}">
                <i class="fas fa-chalkboard"></i>
                <span>Kelola Guru</span>
            </a>
        </li>

        {{-- STUDENTS --}}
        <li>
            <a href="{{ route('admin.siswa') }}"
               class="{{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i>
                <span>Kelola Siswa</span>
            </a>
        </li>

        {{-- ✅ GALLERY — SUDAH DIPERBAIKI --}}
        <li>
            <a href="{{ route('admin.gallery.index') }}"
               class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span>Kelola Galeri</span>
            </a>
        </li>

    </ul>
</aside>

<div class="main-wrapper">

    <header class="top-navbar">
        <div class="d-flex align-items-center gap-2 gap-md-3">
            <button class="toggle-btn" id="sidebarToggle" type="button" aria-label="Buka menu">
                <i class="fas fa-bars"></i>
            </button>

            <form action="#" method="GET" class="search-form">
                <i class="fas fa-magnifying-glass"></i>
                <input type="text" name="query" placeholder="Cari data...">
            </form>
        </div>

        <div class="dropdown" id="adminDropdownWrapper">
            <button class="admin-profile-btn"
                    type="button"
                    id="adminDropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                <img src="{{ asset('assets/admin/img/faiz.png') }}"
                     alt="Foto Profil"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username ?? 'Admin') }}&background=1f2f46&color=fff&rounded=true'">

                <div class="admin-info">
                    <span class="admin-name">{{ Auth::user()->username ?? 'Admin' }}</span>
                    <span class="admin-role">{{ Auth::user()->role ?? 'Administrator' }}</span>
                </div>

                <i class="fas fa-chevron-down" style="font-size:.7rem;color:#6c757d;"></i>
            </button>

            <ul class="admin-dropdown" id="adminDropdownMenu" role="menu">
                <li>
                    <div class="dropdown-header text-center">
                        <img src="{{ asset('assets/admin/img/faiz.png') }}"
                             alt="User"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username ?? 'Admin') }}&background=1f2f46&color=fff&size=100'">

                        <h6>{{ Auth::user()->username ?? 'Admin' }}</h6>
                        <small class="text-muted d-block">
                            ID: {{ Auth::user()->id_user ?? '10293' }}
                        </small>
                        <div class="mt-1">
                            <small class="fw-semibold" style="color:#1f3b5b;">
                                {{ Auth::user()->role ?? 'Administrator' }}
                            </small>
                        </div>
                    </div>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="admin-dropdown-item text-danger">
                            <i class="fas fa-right-from-bracket"></i>
                            Keluar Aplikasi
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <main class="content-area">
        @yield('content')
    </main>

    <footer class="footer-box">
        &copy; 2026 Sistem Manajemen Sekolah. Hak cipta dilindungi.
    </footer>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ============================================================
       SIDEBAR TOGGLE
       ============================================================ */
    const sidebarToggle  = document.getElementById("sidebarToggle");
    const sidebarOverlay = document.getElementById("sidebarOverlay");
    const sidebar        = document.getElementById("sidebar");

    function openSidebar() {
        sidebar.classList.add("show");
        sidebarOverlay.style.display = "block";
        requestAnimationFrame(() => sidebarOverlay.style.opacity = "1");
        document.body.style.overflow = "hidden";
    }

    function closeSidebar() {
        sidebar.classList.remove("show");
        sidebarOverlay.style.opacity = "0";
        document.body.style.overflow = "";
        setTimeout(() => sidebarOverlay.style.display = "none", 250);
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function () {
            sidebar.classList.contains("show") ? closeSidebar() : openSidebar();
        });
    }

    if (sidebarOverlay) sidebarOverlay.addEventListener("click", closeSidebar);

    document.querySelectorAll(".sidebar-menu a").forEach(function (link) {
        link.addEventListener("click", function () {
            if (window.innerWidth <= 991.98) closeSidebar();
        });
    });

    /* ============================================================
       ADMIN DROPDOWN
       ============================================================ */
    const adminBtn   = document.getElementById("adminDropdown");
    const adminMenu  = document.getElementById("adminDropdownMenu");
    const adminWrap  = document.getElementById("adminDropdownWrapper");

    function positionDropdown() {
        if (!adminBtn || !adminMenu) return;

        const rect = adminBtn.getBoundingClientRect();
        const menuWidth = Math.min(260, window.innerWidth - 20);

        adminMenu.style.width = menuWidth + "px";

        let left = rect.right - menuWidth;
        if (left < 10) left = 10;
        if (left + menuWidth > window.innerWidth - 10) {
            left = window.innerWidth - menuWidth - 10;
        }

        adminMenu.style.top   = (rect.bottom + 8) + "px";
        adminMenu.style.left  = left + "px";
        adminMenu.style.right = "auto";
    }

    function openDropdown() {
        if (!adminMenu) return;
        positionDropdown();
        adminMenu.classList.add("show");
        adminBtn.setAttribute("aria-expanded", "true");
    }

    function closeDropdown() {
        if (!adminMenu) return;
        adminMenu.classList.remove("show");
        adminBtn.setAttribute("aria-expanded", "false");
    }

    function toggleDropdown(e) {
        e.preventDefault();
        e.stopPropagation();
        adminMenu.classList.contains("show") ? closeDropdown() : openDropdown();
    }

    if (adminBtn && adminMenu) {
        adminBtn.addEventListener("click", toggleDropdown);

        adminMenu.addEventListener("click", function (e) {
            e.stopPropagation();
        });

        document.addEventListener("click", function (e) {
            if (!adminWrap.contains(e.target) && !adminMenu.contains(e.target)) {
                closeDropdown();
            }
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") closeDropdown();
        });

        window.addEventListener("resize", function () {
            if (adminMenu.classList.contains("show")) positionDropdown();

            if (window.innerWidth > 991.98) {
                sidebar.classList.remove("show");
                sidebarOverlay.style.opacity = "0";
                sidebarOverlay.style.display = "none";
                document.body.style.overflow = "";
            }
        });

        window.addEventListener("scroll", function () {
            if (adminMenu.classList.contains("show")) positionDropdown();
        }, true);
    }

});
</script>

</body>
</html>