<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Sekolah</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome & Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f1f5f9;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(39, 59, 105, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
        }

        .login-left {
            background-color: #273b69;
            color: #ffffff;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .login-left i {
            font-size: 4rem;
            color: #60a5fa;
            margin-bottom: 20px;
        }

        .login-left h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .login-right {
            padding: 50px 40px;
        }

        .form-control {
            padding: 12px 20px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            transition: all 0.3s;
        }

        /* Perbaikan fokus border agar menyatu dengan icon mata */
        .input-group:focus-within .form-control,
        .input-group:focus-within .input-group-text {
            border-color: #273b69;
            background-color: #ffffff;
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 3px rgba(39, 59, 105, 0.1);
            border-radius: 10px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #273b69;
        }

        .btn-login {
            background-color: #273b69;
            color: #ffffff;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #1a2849;
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* Cursor pointer untuk icon mata */
        #togglePassword {
            cursor: pointer;
        }

        /* Responsif untuk HP */
        @media (max-width: 767.98px) {
            .login-left {
                padding: 40px 20px;
            }
            .login-right {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container px-4">
        <div class="row justify-content-center">
            <div class="col-12">
                
                <div class="login-card row g-0 mx-auto">
                    <!-- Sisi Kiri (Branding) -->
                    <div class="col-md-5 login-left d-none d-md-flex">
                        <i class="fas fa-school"></i>
                        <h2>Sistem Informasi Sekolah</h2>
                        <p class="text-light opacity-75 mb-0">Kelola data akademik, guru, dan siswa dengan lebih mudah dan efisien.</p>
                    </div>

                    <!-- Sisi Kanan (Form Login) -->
                    <div class="col-md-7 login-right">
                        <div class="d-md-none text-center mb-4">
                            <i class="fas fa-school text-primary" style="font-size: 3rem; color: #273b69 !important;"></i>
                            <h3 class="fw-bold mt-2" style="font-family: 'Poppins', sans-serif;">Login Portal</h3>
                        </div>
                        
                        <h4 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Selamat Datang Kembali!</h4>
                        <p class="text-muted mb-4">Silakan login menggunakan username dan password Anda.</p>

                        <!-- Alert Jika Login Gagal -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('login.proses') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary small">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" name="username" class="form-control border-start-0 ps-0" placeholder="Masukkan username..." required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-secondary small">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                    
                                    <!-- Input Password (ditambahkan ID dan dihapus border-end nya) -->
                                    <input type="password" name="password" id="passwordField" class="form-control border-start-0 border-end-0 ps-0" placeholder="Masukkan password..." required>
                                    
                                    <!-- Icon Mata Toggle -->
                                    <span class="input-group-text bg-light border-start-0" id="togglePassword">
                                        <i class="fas fa-eye text-muted" id="eyeIcon"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-login btn-block">
                                    <i class="fas fa-sign-in-alt me-2"></i> MASUK KE DASHBOARD
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script untuk Toggle Password -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#passwordField');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Ubah tipe input antara password dan text
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            
            // Ubah icon mata (terbuka/tertutup)
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>