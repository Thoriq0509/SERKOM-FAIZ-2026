<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Login - Sistem Manajemen Sekolah</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/smatn.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/login.css') }}">
</head>

<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-body">

            <!-- Logo -->
            <div class="school-logo">
                <img src="{{ asset('assets/admin/img/smatn.png') }}" alt="Logo Sekolah">
            </div>

            <!-- Judul -->
            <div class="school-title">Sistem Manajemen</div>
            <div class="school-title">SMA TARUNA NUSANTARA</div>
            <div class="school-subtitle">Silakan login untuk melanjutkan</div>

            <!-- Alert error login -->
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

            <!-- Alert validasi -->
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

            <!-- Form login -->
            <form action="{{ route('login.proses') }}" method="POST">
                @csrf

                <!-- Username -->
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
                </div>

                <!-- Password -->
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
                        <span class="input-group-text" id="togglePassword" title="Tampilkan password">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-right-to-bracket me-2"></i>MASUK KE DASHBOARD
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                &copy; {{ date('Y') }} Sistem Manajemen Sekolah
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Toggle password
    const togglePassword = document.getElementById("togglePassword");
    const passwordField  = document.getElementById("passwordField");
    const eyeIcon        = document.getElementById("eyeIcon");

    if (togglePassword && passwordField && eyeIcon) {
        togglePassword.addEventListener("click", function () {
            const isPassword = passwordField.getAttribute("type") === "password";

            passwordField.setAttribute("type", isPassword ? "text" : "password");
            eyeIcon.classList.toggle("fa-eye", !isPassword);
            eyeIcon.classList.toggle("fa-eye-slash", isPassword);
            togglePassword.setAttribute("title", isPassword ? "Sembunyikan password" : "Tampilkan password");
        });
    }

    // Tutup alert manual
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

});
</script>

</body>
</html>