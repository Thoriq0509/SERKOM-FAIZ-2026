@extends('layouts.template')

@section('content')

@php
    $isEdit = isset($user) && $user !== null;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($user->id_user)
        : null;
@endphp

<style>
    :root {
        --c-primary:   #334155;
        --c-primary-d: #1e293b;
        --c-soft:      #f1f5f9;
        --c-border:    #e2e8f0;
        --c-text:      #334155;
        --c-text-soft: #64748b;
        --c-bg:        #f8fafc;
    }

    /* =========================
       HEADER HALAMAN
    ========================== */
    .page-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.35rem;
        font-weight: 600;
        color: var(--c-primary-d);
        margin-bottom: 4px;
    }

    .page-subtitle {
        color: var(--c-text-soft);
        font-size: .875rem;
        margin: 0;
    }

    .btn-back {
        background-color: #fff;
        border: 1px solid var(--c-border);
        color: var(--c-text);
        font-size: .875rem;
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 8px;
        transition: all .15s ease;
    }

    .btn-back:hover {
        background-color: var(--c-bg);
        border-color: #cbd5e1;
        color: var(--c-primary-d);
    }

    /* =========================
       ALERT
    ========================== */
    .alert-soft {
        border: 1px solid;
        border-radius: 8px;
        font-size: .875rem;
        padding: 14px 18px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .alert-soft .alert-body { flex: 1; }

    .alert-soft ul {
        margin: 6px 0 0;
        padding-left: 18px;
        font-size: .82rem;
    }

    .alert-soft.alert-danger {
        background-color: #fef2f2;
        border-color: #fecaca;
        color: #991b1b;
    }

    .alert-soft .alert-close {
        background: transparent;
        border: none;
        color: inherit;
        font-size: .9rem;
        opacity: .6;
        padding: 2px 6px;
        cursor: pointer;
        border-radius: 4px;
        transition: opacity .15s ease, background .15s ease;
        line-height: 1;
    }

    .alert-soft .alert-close:hover {
        opacity: 1;
        background: rgba(0,0,0,.06);
    }

    /* =========================
       CARD
    ========================== */
    .card-clean {
        background-color: #fff;
        border: 1px solid var(--c-border);
        border-radius: 10px;
        box-shadow: 0 1px 2px rgba(15,23,42,.04);
        overflow: hidden;
    }

    .card-clean .card-head {
        padding: 16px 22px;
        border-bottom: 1px solid var(--c-border);
        background-color: #fff;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-clean .card-head .head-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background-color: var(--c-soft);
        color: var(--c-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .card-clean .card-head h6 {
        margin: 0;
        font-size: .95rem;
        font-weight: 600;
        color: var(--c-primary-d);
    }

    .card-clean .card-head small {
        color: var(--c-text-soft);
        font-size: .78rem;
    }

    .card-clean .card-body {
        padding: 28px 22px;
    }

    /* =========================
       SECTION TITLE
    ========================== */
    .section-title {
        font-size: .8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: var(--c-text-soft);
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: var(--c-primary);
        font-size: .85rem;
    }

    .section-divider {
        border: 0;
        border-top: 1px solid var(--c-border);
        margin: 4px 0 20px;
    }

    /* =========================
       INFO BOX
    ========================== */
    .info-box {
        background-color: var(--c-bg);
        border: 1px solid var(--c-border);
        border-left: 3px solid var(--c-primary);
        border-radius: 6px;
        padding: 12px 16px;
        font-size: .82rem;
        color: var(--c-text-soft);
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 24px;
    }

    .info-box i {
        color: var(--c-primary);
        font-size: .9rem;
        margin-top: 1px;
        flex-shrink: 0;
    }

    /* =========================
       FORM LABEL & INPUT
    ========================== */
    .form-label {
        color: var(--c-text);
        font-size: .85rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-label .req { color: #dc2626; margin-left: 2px; }
    .form-label .opt {
        color: var(--c-text-soft);
        font-weight: 400;
        font-size: .78rem;
    }

    .form-control,
    .form-select {
        min-height: 43px;
        padding: 10px 14px;
        font-size: .875rem;
        color: var(--c-text);
        background-color: #fff;
        border: 1px solid var(--c-border);
        border-radius: 6px;
        box-shadow: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .form-control::placeholder { color: #94a3b8; }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--c-primary);
        box-shadow: 0 0 0 .15rem rgba(51,65,85,.10);
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc2626;
        background-image: none;
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        box-shadow: 0 0 0 .15rem rgba(220,38,38,.12);
    }

    .invalid-feedback {
        font-size: .78rem;
        color: #dc2626;
        margin-top: 6px;
    }

    .form-hint {
        color: var(--c-text-soft);
        font-size: .75rem;
        margin-top: 6px;
        display: block;
    }

    /* =========================
       PASSWORD TOGGLE
    ========================== */
    .input-group-clean {
        position: relative;
    }

    .input-group-clean .form-control {
        padding-right: 44px;
    }

    .toggle-pass {
        position: absolute;
        top: 50%;
        right: 6px;
        transform: translateY(-50%);
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: var(--c-text-soft);
        cursor: pointer;
        border-radius: 6px;
        transition: background .15s ease, color .15s ease;
    }

    .toggle-pass:hover {
        background-color: var(--c-soft);
        color: var(--c-primary);
    }

    /* =========================
       ACTION BAR
    ========================== */
    .action-bar {
        border-top: 1px solid var(--c-border);
        padding-top: 20px;
        margin-top: 10px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-cancel {
        background-color: #fff;
        border: 1px solid var(--c-border);
        color: var(--c-text);
        font-size: .875rem;
        font-weight: 500;
        padding: 9px 22px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-cancel:hover {
        background-color: var(--c-bg);
        border-color: #cbd5e1;
        color: var(--c-primary-d);
    }

    .btn-save {
        background-color: var(--c-primary);
        border: 1px solid var(--c-primary);
        color: #fff;
        font-size: .875rem;
        font-weight: 500;
        padding: 9px 22px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-save:hover {
        background-color: var(--c-primary-d);
        border-color: var(--c-primary-d);
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 576px) {
        .card-clean .card-body { padding: 20px 16px; }
        .card-clean .card-head { padding: 14px 16px; }

        .action-bar {
            flex-direction: column-reverse;
        }

        .action-bar .btn,
        .action-bar a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container-fluid p-0">

    {{-- HEADER HALAMAN --}}
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

    {{-- ALERT ERROR VALIDASI --}}
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

    {{-- CARD FORM --}}
    <div class="card-clean mb-5">

        <div class="card-head">
            <div class="head-icon">
                <i class="fas {{ $isEdit ? 'fa-user-pen' : 'fa-user-plus' }}"></i>
            </div>
            <div>
                <h6>{{ $isEdit ? 'Form Edit Pengelola' : 'Form Tambah Pengelola' }}</h6>
                <small>Lengkapi data akun pengelola dengan benar.</small>
            </div>
        </div>

        <div class="card-body">

            {{-- ✅ ACTION FORM DIPERBAIKI --}}
            <form action="{{ $isEdit
                    ? route('admin.users.update', $encryptedId)
                    : route('admin.users.store')
                }}"
                method="POST">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                {{-- SECTION: AKUN --}}
                <div class="section-title">
                    <i class="fas fa-user-shield"></i>Informasi Akun
                </div>
                <hr class="section-divider">

                {{-- INFO BOX --}}
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

                    {{-- Username --}}
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

                    {{-- Role --}}
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

                    {{-- Password --}}
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

                    {{-- Konfirmasi Password --}}
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

                {{-- ACTION BAR --}}
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

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ============ TOGGLE PASSWORD ============ */
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

@endsection