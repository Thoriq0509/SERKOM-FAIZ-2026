<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Sistem Manajemen Sekolah</title>

    {{-- Favicon --}}
    @if (!empty($schoolProfile?->logo))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $schoolProfile->logo) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/smatn.png') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/login.css') }}">
</head>

<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-body">

            {{-- Logo --}}
            <div class="school-logo">
                @if (!empty($schoolProfile?->logo))
                    <img src="{{ asset('storage/' . $schoolProfile->logo) }}"
                         alt="Logo {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}">
                @else
                    <img src="{{ asset('assets/admin/img/smatn.png') }}" alt="Logo Sekolah">
                @endif
            </div>

            {{-- Judul --}}
            <div class="school-title">Sistem Manajemen</div>
            <div class="school-title">
                {{ $schoolProfile->nama_sekolah ?? 'SMA TARUNA NUSANTARA' }}
            </div>
            <div class="school-subtitle">Silakan login untuk melanjutkan</div>

            {{-- Alert sukses (misal dari redirect) --}}
            @if (session('success'))
                <div class="login-alert login-alert-success" role="alert" data-alert>
                    <i class="fas fa-check-circle"></i>
                    <div class="alert-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                        <i class="fas fa-xmark"></i>
                    </button>
                </div>
            @endif

            {{-- Alert error dari session --}}
            @if (session('error'))
                <div class="login-alert" role="alert" data-alert>
                    <i class="fas fa-exclamation-circle"></i>
                    <div class="alert-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                        <i class="fas fa-xmark"></i>
                    </button>
                </div>
            @endif

            {{-- Alert validasi --}}
            @if ($errors->any())
                <div class="login-alert" role="alert" data-alert>
                    <i class="fas fa-exclamation-triangle"></i>
                    <div class="alert-body">
                        <strong>Login gagal.</strong>
                        <ul style="margin:6px 0 0; padding-left:16px; font-size:.78rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                        <i class="fas fa-xmark"></i>
                    </button>
                </div>
            @endif

            {{-- Form login --}}
            <form action="{{ route('auth.login.proses') }}" method="POST" autocomplete="on">
                @csrf

                {{-- Username --}}
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text"
                               name="username"
                               id="username"
                               class="form-control @error('username') is-invalid @enderror"
                               value="{{ old('username') }}"
                               placeholder="Masukkan username..."
                               autocomplete="username"
                               required
                               autofocus>
                    </div>
                    @error('username')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="passwordField" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password"
                               name="password"
                               id="passwordField"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password..."
                               autocomplete="current-password"
                               required>
                        <span class="input-group-text password-toggle"
                              id="togglePassword"
                              role="button"
                              tabindex="0"
                              title="Tampilkan password">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-login" id="btnLogin">
                        <i class="fas fa-right-to-bracket me-2"></i>MASUK KE DASHBOARD
                    </button>
                </div>
            </form>

            {{-- Footer --}}
            <div class="login-footer">
                &copy; {{ date('Y') }}
                <strong>{{ $schoolProfile->nama_sekolah ?? 'Sistem Manajemen Sekolah' }}</strong>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* =========================================================
       Toggle Password (klik + keyboard Enter/Space)
    ========================================================= */
    const togglePassword = document.getElementById("togglePassword");
    const passwordField  = document.getElementById("passwordField");
    const eyeIcon        = document.getElementById("eyeIcon");

    if (togglePassword && passwordField && eyeIcon) {

        function toggleVisibility() {
            const isPassword = passwordField.getAttribute("type") === "password";

            passwordField.setAttribute("type", isPassword ? "text" : "password");
            eyeIcon.classList.toggle("fa-eye", !isPassword);
            eyeIcon.classList.toggle("fa-eye-slash", isPassword);
            togglePassword.setAttribute("title", isPassword ? "Sembunyikan password" : "Tampilkan password");
        }

        togglePassword.addEventListener("click", toggleVisibility);
        togglePassword.addEventListener("keydown", function (e) {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                toggleVisibility();
            }
        });
    }

    /* =========================================================
       Tutup Alert manual
    ========================================================= */
    document.querySelectorAll("[data-alert-close]").forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const box = btn.closest("[data-alert]");
            if (!box) return;
            box.style.transition = "opacity .2s ease";
            box.style.opacity = "0";
            setTimeout(() => box.remove(), 200);
        });
    });

    /* =========================================================
       Auto-hilangkan alert setelah 6 detik
    ========================================================= */
    document.querySelectorAll("[data-alert]").forEach(function (box) {
        setTimeout(function () {
            box.style.transition = "opacity .3s ease";
            box.style.opacity = "0";
            setTimeout(() => box.remove(), 300);
        }, 6000);
    });

    /* =========================================================
       Loading state saat submit
    ========================================================= */
    const form     = document.querySelector("form");
    const btnLogin = document.getElementById("btnLogin");

    if (form && btnLogin) {
        form.addEventListener("submit", function () {
            btnLogin.disabled = true;
            btnLogin.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>MEMPROSES...';
        });
    }

});
</script>

</body>
</html>