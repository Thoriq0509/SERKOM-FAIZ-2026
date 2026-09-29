<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Login - Sistem Manajemen Sekolah</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/logosuzuran.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css') }}">

    <style>
        * { box-sizing: border-box; }

        html, body { width: 100%; min-height: 100%; }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: #f8fafc;
            color: #212529;
            font-family: "Segoe UI", Arial, sans-serif;
            overflow-x: hidden;
            -webkit-text-size-adjust: 100%;
        }

        /* ===== WRAPPER ===== */
        .login-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
            background:
                radial-gradient(circle at top left, #eef2f7 0%, transparent 50%),
                radial-gradient(circle at bottom right, #e2e8f0 0%, transparent 50%),
                #f8fafc;
        }

        /* ===== CARD ===== */
        .login-card {
            width: 100%;
            max-width: 420px;
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(15,23,42,.08);
            overflow: hidden;
        }

        .login-body { padding: 38px 34px; }

        /* ===== LOGO & JUDUL ===== */
        .school-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .school-logo img {
            width: 76px;
            height: 76px;
            object-fit: contain;
        }

        .school-title {
            color: #1e293b;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: -.2px;
        }

        .school-subtitle {
            color: #64748b;
            text-align: center;
            font-size: .82rem;
            margin-bottom: 26px;
        }

        /* ===== ALERT ===== */
        .login-alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border: 1px solid #fecaca;
            background-color: #fef2f2;
            color: #991b1b;
            font-size: .82rem;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .login-alert i {
            color: #dc2626;
            font-size: .9rem;
            margin-top: 1px;
            flex-shrink: 0;
        }

        .login-alert .alert-body { flex: 1; }

        .login-alert .alert-close {
            background: transparent;
            border: none;
            color: inherit;
            font-size: .85rem;
            opacity: .6;
            padding: 2px 6px;
            cursor: pointer;
            border-radius: 4px;
            transition: opacity .15s ease, background .15s ease;
            line-height: 1;
            flex-shrink: 0;
        }

        .login-alert .alert-close:hover {
            opacity: 1;
            background: rgba(0,0,0,.06);
        }

        /* ===== FORM ===== */
        .form-label {
            color: #334155;
            font-size: .82rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            min-height: 44px;
            padding: 10px 14px;
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #212529;
            font-size: .875rem;
            box-shadow: none;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .form-control::placeholder { color: #94a3b8; }

        .form-control:focus {
            background-color: #fff;
            border-color: #334155;
            color: #212529;
            box-shadow: 0 0 0 .15rem rgba(51,65,85,.10);
        }

        /* ===== INPUT GROUP ===== */
        .input-group-text {
            min-width: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #64748b;
            border-radius: 6px;
        }

        .input-group .form-control,
        .input-group .form-control:focus {
            border-left: 0;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            background-color: #fff;
            border-color: #334155;
        }

        /* ===== TOGGLE PASSWORD ===== */
        #togglePassword {
            min-width: 46px;
            cursor: pointer;
            user-select: none;
        }

        #togglePassword:hover { background-color: #f1f5f9; }
        #togglePassword i { color: #64748b; }

        /* ===== BUTTON ===== */
        .btn-login {
            width: 100%;
            min-height: 46px;
            padding: 11px 15px;
            background-color: #334155;
            border: 1px solid #334155;
            border-radius: 6px;
            color: #fff;
            font-size: .875rem;
            font-weight: 600;
            letter-spacing: .3px;
            transition: background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
        }

        .btn-login:hover,
        .btn-login:focus {
            background-color: #1e293b;
            border-color: #1e293b;
            color: #fff;
        }

        .btn-login:focus {
            box-shadow: 0 0 0 .15rem rgba(51,65,85,.15);
        }

        .btn-login:active {
            background-color: #0f172a !important;
            border-color: #0f172a !important;
            color: #fff !important;
        }

        /* ===== FOOTER ===== */
        .login-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            color: #94a3b8;
            text-align: center;
            font-size: .72rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 575.98px) {
            .login-wrapper { padding: 20px 12px; }

            .login-card { max-width: 100%; }

            .login-body { padding: 28px 22px; }

            .school-logo { margin-bottom: 12px; }

            .school-logo img {
                width: 68px;
                height: 68px;
            }

            .school-title { font-size: 1.05rem; }

            .school-subtitle { margin-bottom: 22px; }
        }
    </style>
</head>

<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-body">

            {{-- LOGO --}}
            <div class="school-logo">
                <img src="{{ asset('assets/admin/img/logosuzuran.png') }}" alt="Logo Sekolah">
            </div>

            {{-- JUDUL --}}
            <div class="school-title">Sistem Manajemen Sekolah</div>
            <div class="school-subtitle">Silakan login untuk melanjutkan</div>

            {{-- ALERT ERROR LOGIN --}}
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

            {{-- ALERT VALIDATION ERROR --}}
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

            {{-- FORM LOGIN --}}
            <form action="{{ route('login.proses') }}" method="POST">
                @csrf

                {{-- USERNAME --}}
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

                {{-- PASSWORD --}}
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

                {{-- TOMBOL --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-right-to-bracket me-2"></i>MASUK KE DASHBOARD
                    </button>
                </div>
            </form>

            {{-- FOOTER --}}
            <div class="login-footer">
                &copy; {{ date('Y') }} Sistem Manajemen Sekolah
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ============ TOGGLE PASSWORD ============ */
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

    /* ============ FALLBACK CLOSE ALERT ============ */
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