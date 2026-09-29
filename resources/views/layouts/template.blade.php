<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Sistem Sekolah</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
            color: #334155;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .brand-box {
            font-family: 'Poppins', sans-serif;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 280px;
            background-color: #273b69;
            color: #ffffff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
            z-index: 1050;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }

        .brand-box {
            background-color: #1a2849;
            margin: 15px;
            padding: 16px 10px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.05rem;
            color: #ffffff;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .brand-box i {
            margin-right: 12px;
            font-size: 1.3rem;
            color: #60a5fa;
        }

        .nav-section-title {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 15px 20px 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            width: 100%;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            width: 100%;
            color: #cbd5e1;
            text-decoration: none;
            padding: 14px 20px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-menu li a i {
            width: 30px;
            min-width: 30px;
            font-size: 1.15rem;
            text-align: center;
            margin-right: 12px;
            color: #94a3b8;
            transition: color 0.2s;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background-color: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            border-left: 4px solid #60a5fa;
        }

        .sidebar-menu li a:hover i,
        .sidebar-menu li a.active i {
            color: #60a5fa;
        }

        /* ================= OVERLAY MOBILE ================= */

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* ================= MAIN CONTENT ================= */

        .main-wrapper {
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease-in-out;
        }

        /* ================= TOP NAVBAR ================= */

        .top-navbar {
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .toggle-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #334155;
            cursor: pointer;
            padding: 5px;
        }

        /* ================= SEARCH ================= */

        .search-form {
            background-color: #f1f5f9;
            border: 1px solid transparent;
            border-radius: 50px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            width: 320px;
            transition: all 0.3s ease;
        }

        .search-form:focus-within {
            background-color: #ffffff;
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.15);
        }

        .search-form input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            padding: 0 10px;
            font-size: 0.9rem;
            color: #334155;
        }

        .search-form input::placeholder {
            color: #94a3b8;
        }

        .search-form i {
            color: #94a3b8;
        }

        /* ================= ADMIN PROFILE ================= */

        .admin-profile-btn {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            padding: 6px 18px 6px 6px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #334155;
        }

        .admin-profile-btn:hover,
        .admin-profile-btn[aria-expanded="true"] {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }

        .admin-profile-btn img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        .admin-info {
            display: flex;
            flex-direction: column;
            text-align: left;
            line-height: 1.2;
        }

        .admin-name {
            font-weight: 600;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
        }

        .admin-role {
            font-size: 0.7rem;
            color: #64748b;
        }

        .dropdown-toggle::after {
            display: none;
        }

        /* ================= CONTENT ================= */

        .content-area {
            padding: 30px;
            flex-grow: 1;
        }

        /* ================= FOOTER ================= */

        .footer-box {
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 20px;
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 991.98px) {

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .toggle-btn {
                display: block;
            }

            .top-navbar {
                padding: 15px 20px;
                gap: 15px;
            }

            .search-form {
                display: none;
            }

            .admin-info {
                display: none;
            }

            .admin-profile-btn {
                padding: 4px;
                border: none;
                gap: 0;
            }

            .admin-profile-btn i.fa-chevron-down {
                display: none;
            }

            .content-area {
                padding: 20px 15px;
            }
        }

        @media (max-width: 575.98px) {

            .brand-box {
                font-size: 0.95rem;
                margin: 12px;
            }

            .top-navbar {
                padding: 12px 15px;
            }

            .content-area {
                padding: 15px 12px;
            }

            .footer-box {
                padding: 15px 10px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>

    <!-- Overlay Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar" id="sidebar">

        <!-- Brand -->
        <a href="{{ route('dashboard') }}" class="brand-box">
            <i class="fas fa-layer-group"></i>
            DASHBOARD ADMIN
        </a>

        <!-- Navigasi Utama -->
        <div class="nav-section-title">
            Navigasi Utama
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-border-all"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- Manajemen Data -->
        <div class="nav-section-title mt-3">
            Manajemen Data
        </div>

        <ul class="sidebar-menu">

            <!-- Profil Sekolah -->
            <li>
                <a href="{{ route('admin.school_profile') }}"
                   class="{{ request()->routeIs('admin.school_profile*') ? 'active' : '' }}">
                    <i class="fas fa-building"></i>
                    <span>Profil Sekolah</span>
                </a>
            </li>

            <!-- Data Pengelola -->
            <li>
                <a href="{{ route('admin.users.index') }}"
                   class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i>
                    <span>Data Pengelola</span>
                </a>
            </li>

            <!-- Kelola Berita -->
            <li>
                <a href="{{ route('admin.berita') }}"
                   class="{{ request()->routeIs('admin.berita') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Kelola Berita</span>
                </a>
            </li>

            <!-- Ekstrakurikuler -->
            <li>
                <a href="{{ route('admin.ekstrakulikuler') }}"
                   class="{{ request()->routeIs('admin.ekstrakulikuler') ? 'active' : '' }}">
                    <i class="fas fa-basketball-ball"></i>
                    <span>Ekstrakurikuler</span>
                </a>
            </li>

            <!-- Guru -->
            <li>
                <a href="{{ route('admin.guru') }}"
                   class="{{ request()->routeIs('admin.guru') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Kelola Guru</span>
                </a>
            </li>

            <!-- Siswa -->
            <li>
                <a href="{{ route('admin.siswa') }}"
                   class="{{ request()->routeIs('admin.siswa') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Kelola Siswa</span>
                </a>
            </li>

            <!-- Galeri -->
            <li>
                <a href="{{ route('admin.galeri') }}"
                   class="{{ request()->routeIs('admin.galeri') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Kelola Galeri</span>
                </a>
            </li>

        </ul>
    </aside>

    <!-- ================= MAIN WRAPPER ================= -->

    <div class="main-wrapper">

        <!-- ================= TOP NAVBAR ================= -->

        <header class="top-navbar">

            <div class="d-flex align-items-center gap-3 w-100">

                <!-- Mobile Toggle -->
                <button
                    class="toggle-btn"
                    id="sidebarToggle"
                    type="button"
                    aria-label="Buka menu">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Search -->
                <form action="#" method="GET" class="search-form me-auto">
                    <i class="fas fa-search"></i>

                    <input
                        type="text"
                        name="query"
                        placeholder="Cari data guru, siswa, berita...">
                </form>

            </div>

            <!-- ================= ADMIN PROFILE ================= -->

            <div class="dropdown">

                <button
                    class="admin-profile-btn dropdown-toggle"
                    type="button"
                    id="adminDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    <img
                        src="{{ asset('assets/admin/img/faiz.png') }}"
                        alt="Profile Admin"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username ?? 'Admin') }}&background=273b69&color=fff&rounded=true'">

                    <div class="admin-info">

                        <span class="admin-name">
                            {{ Auth::user()->username ?? 'Admin Sagara' }}
                        </span>

                        <span class="admin-role">
                            {{ Auth::user()->role ?? 'Administrator' }}
                        </span>

                    </div>

                    <i class="fas fa-chevron-down ms-2 text-muted"
                       style="font-size: 0.8rem;">
                    </i>

                </button>

                <!-- Dropdown -->
                <ul
                    class="dropdown-menu dropdown-menu-end border-0 shadow mt-2 rounded-3"
                    aria-labelledby="adminDropdown"
                    style="min-width: 220px;">

                    <!-- User Information -->
                    <li>
                        <div class="dropdown-header text-center pt-3 pb-2">

                            <img
                                src="{{ asset('assets/admin/img/faiz.png') }}"
                                alt="User"
                                class="rounded-circle mb-2"
                                width="60"
                                height="60"
                                style="object-fit: cover; border: 2px solid #e2e8f0;"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username ?? 'Admin') }}&background=273b69&color=fff&size=100'">

                            <h6 class="mb-0 text-dark fw-bold">
                                {{ Auth::user()->username ?? 'Admin Sagara' }}
                            </h6>

                            <small class="text-muted">
                                ID: {{ Auth::user()->id_user ?? '10293' }}
                            </small>

                            <div class="mt-1">
                                <small class="text-primary fw-semibold">
                                    {{ Auth::user()->role ?? 'Administrator' }}
                                </small>
                            </div>

                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- Logout -->
                    <li>
                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                            class="m-0 p-0">

                            @csrf

                            <button
                                type="submit"
                                class="dropdown-item text-danger fw-bold py-2 px-4 d-flex align-items-center">

                                <i class="fas fa-sign-out-alt me-3"></i>
                                Keluar Aplikasi

                            </button>

                        </form>
                    </li>

                </ul>

            </div>
        </header>

        <!-- ================= CONTENT ================= -->

        <main class="content-area">
            @yield('content')
        </main>

        <!-- ================= FOOTER ================= -->

        <footer class="footer-box">
            &copy; 2026 Dashboard Admin Sekolah Terpadu. All rights reserved.
        </footer>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Mobile -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebarOverlay = document.getElementById("sidebarOverlay");
            const sidebar = document.getElementById("sidebar");

            function openSidebar() {
                sidebar.classList.add("show");
                sidebarOverlay.style.display = "block";

                setTimeout(function () {
                    sidebarOverlay.style.opacity = "1";
                }, 10);
            }

            function closeSidebar() {
                sidebar.classList.remove("show");
                sidebarOverlay.style.opacity = "0";

                setTimeout(function () {
                    sidebarOverlay.style.display = "none";
                }, 300);
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener("click", function () {

                    if (sidebar.classList.contains("show")) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }

                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener("click", closeSidebar);
            }

            // Tutup sidebar setelah memilih menu di perangkat mobile
            document.querySelectorAll(".sidebar-menu a").forEach(function (link) {

                link.addEventListener("click", function () {

                    if (window.innerWidth <= 991.98) {
                        closeSidebar();
                    }

                });

            });

            // Reset sidebar saat kembali ke ukuran desktop
            window.addEventListener("resize", function () {

                if (window.innerWidth > 991.98) {
                    sidebar.classList.remove("show");
                    sidebarOverlay.style.opacity = "0";
                    sidebarOverlay.style.display = "none";
                }

            });

        });
    </script>

</body>
</html>