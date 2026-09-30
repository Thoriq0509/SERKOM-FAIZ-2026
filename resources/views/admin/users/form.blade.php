@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/users.css') }}">
@endpush

@php
    $isEdit = isset($user) && $user !== null;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($user->id_user)
        : null;
@endphp

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">
                {{ $isEdit ? 'Edit Data Pengelola' : 'Tambah Data Pengelola' }}
            </h2>
            <p class="page-subtitle">
                {{ $isEdit
                    ? 'Perbarui informasi akun pengelola.'
                    : 'Tambahkan akun pengelola baru ke dalam sistem.'
                }}
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Alert validasi -->
    @if ($errors->any())
        <div class="alert-soft alert-danger mb-4" role="alert" data-alert>
            <i class="fas fa-exclamation-triangle"></i>
            <div class="alert-body">
                <strong>Gagal menyimpan data.</strong>
                <div class="mt-1">Periksa kembali data yang kamu masukkan.</div>
                <ul>
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

    <!-- Card form -->
    <div class="card-clean mb-5">

        <div class="card-head" style="justify-content: flex-start;">
            <div class="head-icon">
                <i class="fas {{ $isEdit ? 'fa-user-pen' : 'fa-user-plus' }}"></i>
            </div>
            <div>
                <h6>{{ $isEdit ? 'Form Edit Pengelola' : 'Form Tambah Pengelola' }}</h6>
                <small>Lengkapi data akun pengelola dengan benar.</small>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ $isEdit
                    ? route('admin.users.update', $encryptedId)
                    : route('admin.users.store')
                }}"
                method="POST">
                @csrf
                @if ($isEdit) @method('PUT') @endif

                <!-- Section: Informasi akun -->
                <div class="section-title">
                    <i class="fas fa-user-shield"></i>Informasi Akun
                </div>
                <hr class="section-divider">

                <!-- Info box -->
                <div class="info-box">
                    <i class="fas fa-circle-info"></i>
                    <span>
                        <strong>Username</strong> digunakan untuk login dan harus unik.
                        @if ($isEdit)
                            Kosongkan <strong>password</strong> jika tidak ingin mengubahnya.
                        @else
                            <strong>Password</strong> minimal 6 karakter.
                        @endif
                    </span>
                </div>

                <div class="row">

                    <!-- Username -->
                    <div class="col-md-6 mb-4">
                        <label for="username" class="form-label">
                            Username <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="username"
                               name="username"
                               class="form-control @error('username') is-invalid @enderror"
                               value="{{ old('username', $user->username ?? '') }}"
                               maxlength="30"
                               autocomplete="off"
                               placeholder="Masukkan username"
                               required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Maksimal 30 karakter, harus unik.</small>
                    </div>

                    <!-- Role -->
                    <div class="col-md-6 mb-4">
                        <label for="role" class="form-label">
                            Role <span class="req">*</span>
                        </label>
                        <select id="role"
                                name="role"
                                class="form-select @error('role') is-invalid @enderror"
                                required>
                            <option value="">Pilih Role</option>
                            <option value="Admin"
                                {{ old('role', $user->role ?? '') === 'Admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="Operator"
                                {{ old('role', $user->role ?? '') === 'Operator' ? 'selected' : '' }}>
                                Operator
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Admin punya akses penuh, Operator terbatas.</small>
                    </div>

                    <!-- Password -->
                    <div class="col-md-6 mb-4">
                        <label for="password" class="form-label">
                            Password
                            @if ($isEdit)
                                <span class="opt">(Opsional)</span>
                            @else
                                <span class="req">*</span>
                            @endif
                        </label>
                        <div class="input-group-clean">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="{{ $isEdit ? 'Kosongkan jika tidak diubah' : 'Masukkan password' }}"
                                   autocomplete="new-password"
                                   {{ $isEdit ? '' : 'required' }}>
                            <button type="button" class="toggle-pass" data-toggle-pass="password" aria-label="Tampilkan password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Minimal 6 karakter.</small>
                    </div>

                    <!-- Konfirmasi password -->
                    <div class="col-md-6 mb-4">
                        <label for="password_confirmation" class="form-label">
                            Konfirmasi Password
                            @if ($isEdit)
                                <span class="opt">(Opsional)</span>
                            @else
                                <span class="req">*</span>
                            @endif
                        </label>
                        <div class="input-group-clean">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password"
                                   autocomplete="new-password"
                                   {{ $isEdit ? '' : 'required' }}>
                            <button type="button" class="toggle-pass" data-toggle-pass="password_confirmation" aria-label="Tampilkan password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="form-hint">Harus sama dengan password di atas.</small>
                    </div>

                </div>

                <!-- Action bar -->
                <div class="action-bar">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save me-2"></i>
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data' }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- Script toggle password + tutup alert -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    // ==== Toggle password ====
    document.querySelectorAll("[data-toggle-pass]").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const targetId = btn.getAttribute("data-toggle-pass");
            const input    = document.getElementById(targetId);
            if (!input) return;

            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";

            const icon = btn.querySelector("i");
            if (icon) {
                icon.classList.toggle("fa-eye", !isPassword);
                icon.classList.toggle("fa-eye-slash", isPassword);
            }
        });
    });

    // ==== Tutup alert manual ====
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

@endsection