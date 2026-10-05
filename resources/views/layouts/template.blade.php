<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    @php
        $role = Auth::user()->role ?? null;
        $schoolProfile = \App\Models\SchoolProfile::first();
    @endphp

    <title>Dashboard Admin - {{ $schoolProfile->nama_sekolah ?? 'Sistem Sekolah' }}</title>

    {{-- Favicon: pakai logo sekolah kalau ada, fallback ke default --}}
    <link rel="icon" type="image/png"
          href="{{ $schoolProfile?->logo ? asset('storage/'.$schoolProfile->logo) : asset('assets/admin/img/smatn.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/css/datatables.min.css') }}">

    @stack('styles')
</head>

<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <a href="{{ route('dashboard') }}" class="brand-box">
        <span>SISTEM MANAJEMEN</span>
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

        {{-- Profil Sekolah - Admin & Operator --}}
        <li>
            <a href="{{ route('admin.school_profile') }}"
               class="{{ request()->routeIs('admin.school_profile*') ? 'active' : '' }}">
                <i class="fas fa-school"></i>
                <span>Profil Sekolah</span>
            </a>
        </li>

        @if($role === 'Admin')
            <li>
                <a href="{{ route('admin.users.index') }}"
                   class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-user-gear"></i>
                    <span>Data Pengelola</span>
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('admin.news.index') }}"
               class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span>Kelola Berita</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.extracurricular.index') }}"
               class="{{ request()->routeIs('admin.extracurricular.*') ? 'active' : '' }}">
                <i class="fas fa-people-group"></i>
                <span>Kelola Ekstrakurikuler</span>
            </a>
        </li>

        @if($role === 'Admin')
            <li>
                <a href="{{ route('admin.guru') }}"
                   class="{{ request()->routeIs('admin.guru*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard"></i>
                    <span>Kelola Guru</span>
                </a>
            </li>
        @endif

        @if($role === 'Admin')
            <li>
                <a href="{{ route('admin.siswa') }}"
                   class="{{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Kelola Siswa</span>
                </a>
            </li>
        @endif

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

        <div class="d-flex align-items-center gap-2 gap-md-3 flex-grow-1 min-w-0">
            <button class="toggle-btn" id="sidebarToggle" type="button" aria-label="Buka menu">
                <i class="fas fa-bars"></i>
            </button>

            <div class="navbar-school-name d-none d-md-flex align-items-center">
                @if($schoolProfile?->logo)
                    <img src="{{ asset('storage/'.$schoolProfile->logo) }}"
                         alt="Logo {{ $schoolProfile->nama_sekolah }}"
                         class="navbar-school-logo">
                @else
                    <img src="{{ asset('assets/admin/img/smatn.png') }}"
                         alt="Logo Sekolah"
                         class="navbar-school-logo">
                @endif

                <span>{{ $schoolProfile->nama_sekolah ?? 'Nama Sekolah' }}</span>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2 gap-md-3">

            <div class="navbar-datetime d-none d-md-flex">
                <i class="far fa-clock navbar-datetime-icon"></i>
                <span class="navbar-datetime-text">
                    <span id="liveDate"></span>
                    <span class="navbar-datetime-sep">•</span>
                    <span id="liveClock">--:--:--</span>
                </span>
            </div>

            <div class="dropdown" id="adminDropdownWrapper">
                <button class="admin-profile-btn"
                        type="button"
                        id="adminDropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                    <img src="{{ asset('assets/admin/img/user.png') }}"
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
                            <img src="{{ asset('assets/admin/img/user.png') }}"
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

        </div>
    </header>

    <main class="content-area">

        @hasSection('breadcrumb')
            <nav class="breadcrumb-clean" aria-label="breadcrumb">
                <ol>
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-house"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @yield('breadcrumb')
                </ol>
            </nav>
        @endif

        @yield('content')
    </main>

    <footer class="footer-box">
        &copy; {{ date('Y') }} {{ $schoolProfile->nama_sekolah ?? 'Sistem Manajemen Sekolah' }}. Hak cipta dilindungi.
    </footer>

</div>

<script src="{{ asset('assets/datatables/js/jquery-4.0.0.min.js') }}"></script>
<script src="{{ asset('assets/datatables/js/datatables.js') }}"></script>
<script src="{{ asset('assets/datatables/js/datatables.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Live clock & date
    const hariIndo  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const bulanIndo = ['Januari','Februari','Maret','April','Mei','Juni',
                       'Juli','Agustus','September','Oktober','November','Desember'];

    function updateLiveClock() {
        const now = new Date();

        const hari   = hariIndo[now.getDay()];
        const tgl    = String(now.getDate()).padStart(2, '0');
        const bulan  = bulanIndo[now.getMonth()];
        const tahun  = now.getFullYear();

        const jam    = String(now.getHours()).padStart(2, '0');
        const menit  = String(now.getMinutes()).padStart(2, '0');
        const detik  = String(now.getSeconds()).padStart(2, '0');

        const dateEl  = document.getElementById('liveDate');
        const clockEl = document.getElementById('liveClock');

        if (dateEl)  dateEl.textContent  = hari + ', ' + tgl + ' ' + bulan + ' ' + tahun;
        if (clockEl) clockEl.textContent = jam + ':' + menit + ':' + detik;
    }

    updateLiveClock();
    setInterval(updateLiveClock, 1000);

    // Sidebar toggle
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

    // Admin dropdown
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

    // =========================================================
    // AUTO-DISMISS ALERT — SEMUA ALERT HILANG SETELAH 3 DETIK
    // =========================================================
    document.querySelectorAll("[data-alert]").forEach(function (box) {
        setTimeout(function () {
            box.style.transition = "opacity .4s ease, transform .4s ease";
            box.style.opacity = "0";
            box.style.transform = "translateY(-10px)";
            setTimeout(() => box.remove(), 400);
        }, 3000); // 3000ms = 3 detik
    });

});
</script>

<script>
    // Auto-init semua tabel yang punya atribut data-datatable
    $(function () {
        $('table[data-datatable]').each(function () {
            if (!$.fn.DataTable.isDataTable(this)) {
                $(this).DataTable({
                    pageLength: 10,
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                        infoEmpty: "Tidak ada data",
                        zeroRecords: "Data tidak ditemukan",
                        paginate: { previous: "Sebelumnya", next: "Berikutnya" }
                    }
                });
            }
        });
    });
</script>

</body>
</html>