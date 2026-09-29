@extends('layouts.template')

@section('content')

@php
    $isEdit = $student->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($student->id)
        : null;
@endphp

<style>
    /* =========================
       CARD FORM
    ========================== */
    .form-card {
        background-color: #ffffff;
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* =========================
       HEADER CARD
    ========================== */
    .form-card .card-header {
        background-color: #273b69;
        color: #ffffff;
        padding: 18px 25px;
        border-bottom: none;
    }

    /* =========================
       INPUT
    ========================== */
    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 11px 14px;
        border: 1px solid #dce2ea;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #273b69;
        box-shadow: 0 0 0 0.2rem rgba(39, 59, 105, 0.1);
    }

    /* =========================
       LABEL
    ========================== */
    .form-label {
        color: #334155;
        margin-bottom: 8px;
    }

    /* =========================
       INFO BOX
    ========================== */
    .info-box {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 15px;
    }

    /* =========================
       BUTTON
    ========================== */
    .btn-save {
        background-color: #273b69;
        border: none;
        color: #ffffff;
    }

    .btn-save:hover {
        background-color: #1f3158;
        color: #ffffff;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 576px) {
        .form-card .card-header {
            padding: 16px 18px;
        }

        .form-card .card-body {
            padding: 18px !important;
        }

        .action-buttons {
            flex-direction: column-reverse;
        }

        .action-buttons .btn,
        .action-buttons a {
            width: 100%;
        }
    }
</style>


<div class="container-fluid p-0">

    <!-- =========================
         HEADER HALAMAN
    ========================== -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h2
                class="fw-bold text-dark mb-1"
                style="font-family: 'Poppins', sans-serif;"
            >
                {{ $isEdit ? 'Edit Data Siswa' : 'Tambah Data Siswa' }}
            </h2>

            <p class="text-muted mb-0">
                {{ $isEdit
                    ? 'Perbarui informasi data peserta didik.'
                    : 'Tambahkan data peserta didik baru.'
                }}
            </p>
        </div>

        <a
            href="{{ route('admin.siswa') }}"
            class="btn btn-secondary px-4 py-2 shadow-sm"
        >
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>

    </div>


    <!-- =========================
         VALIDATION ERROR
    ========================== -->
    @if ($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm border-0"
            role="alert"
        >
            <div class="d-flex align-items-start">

                <i class="fas fa-exclamation-triangle me-3 mt-1"></i>

                <div>
                    <strong>Gagal menyimpan data.</strong>

                    <p class="mb-2 mt-1">
                        Periksa kembali data yang kamu masukkan.
                    </p>

                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"
            ></button>
        </div>

    @endif


    <!-- =========================
         FORM UTAMA
    ========================== -->
    <div class="card form-card mb-5">

        <!-- HEADER CARD -->
        <div class="card-header">

            <div class="d-flex align-items-center">

                <i class="fas fa-user-graduate me-3 fs-5"></i>

                <div>
                    <h5 class="mb-1 fw-bold">
                        {{ $isEdit ? 'Form Edit Siswa' : 'Form Tambah Siswa' }}
                    </h5>

                    <small class="opacity-75">
                        Lengkapi data siswa dengan benar.
                    </small>
                </div>

            </div>

        </div>


        <!-- BODY CARD -->
        <div class="card-body p-4 p-md-5">

            <form
                action="{{ $isEdit
                    ? route('admin.siswa.update', $encryptedId)
                    : route('admin.siswa.store')
                }}"
                method="POST"
            >

                @csrf

                @if ($isEdit)
                    @method('PUT')
                @endif


                <!-- =========================
                     INFORMASI SISWA
                ========================== -->
                <div class="mb-4">

                    <h6
                        class="fw-bold mb-3"
                        style="color: #273b69;"
                    >
                        <i class="fas fa-id-card me-2"></i>
                        Informasi Siswa
                    </h6>

                    <div class="info-box mb-4">

                        <small class="text-muted">
                            Pastikan NISN, nama, jenis kelamin, dan tahun masuk
                            sudah sesuai dengan data siswa.
                        </small>

                    </div>


                    <div class="row">

                        <!-- NISN -->
                        <div class="col-md-6 mb-4">

                            <label
                                for="nisn"
                                class="form-label fw-semibold"
                            >
                                NISN
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="nisn"
                                name="nisn"
                                class="form-control @error('nisn') is-invalid @enderror"
                                value="{{ old('nisn', $student->nisn) }}"
                                maxlength="10"
                                inputmode="numeric"
                                placeholder="Masukkan NISN"
                                required
                            >

                            @error('nisn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted d-block mt-2">
                                Maksimal 10 karakter.
                            </small>

                        </div>


                        <!-- Nama Siswa -->
                        <div class="col-md-6 mb-4">

                            <label
                                for="nama_siswa"
                                class="form-label fw-semibold"
                            >
                                Nama Siswa
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="nama_siswa"
                                name="nama_siswa"
                                class="form-control @error('nama_siswa') is-invalid @enderror"
                                value="{{ old('nama_siswa', $student->nama_siswa) }}"
                                maxlength="40"
                                placeholder="Masukkan nama lengkap siswa"
                                required
                            >

                            @error('nama_siswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted d-block mt-2">
                                Maksimal 40 karakter.
                            </small>

                        </div>


                        <!-- Jenis Kelamin -->
                        <div class="col-md-6 mb-4">

                            <label
                                for="jenis_kelamin"
                                class="form-label fw-semibold"
                            >
                                Jenis Kelamin
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    Pilih Jenis Kelamin
                                </option>

                                <option
                                    value="Laki-Laki"
                                    {{ old('jenis_kelamin', $student->jenis_kelamin) === 'Laki-Laki' ? 'selected' : '' }}
                                >
                                    Laki-Laki
                                </option>

                                <option
                                    value="Perempuan"
                                    {{ old('jenis_kelamin', $student->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}
                                >
                                    Perempuan
                                </option>

                            </select>

                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- Tahun Masuk -->
                        <div class="col-md-6 mb-4">

                            <label
                                for="tahun_masuk"
                                class="form-label fw-semibold"
                            >
                                Tahun Masuk
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                id="tahun_masuk"
                                name="tahun_masuk"
                                class="form-control @error('tahun_masuk') is-invalid @enderror"
                                value="{{ old('tahun_masuk', $student->tahun_masuk) }}"
                                min="1900"
                                max="{{ date('Y') }}"
                                placeholder="Contoh: {{ date('Y') }}"
                                required
                            >

                            @error('tahun_masuk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted d-block mt-2">
                                Masukkan tahun dalam format 4 digit.
                            </small>

                        </div>

                    </div>

                </div>


                <!-- =========================
                     TOMBOL AKSI
                ========================== -->
                <div class="border-top pt-4 mt-2">

                    <div class="d-flex justify-content-end gap-2 flex-wrap action-buttons">

                        <a
                            href="{{ route('admin.siswa') }}"
                            class="btn btn-secondary px-4 py-2"
                        >
                            <i class="fas fa-times me-2"></i>
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-save px-4 py-2 shadow-sm"
                        >
                            <i class="fas fa-save me-2"></i>

                            {{ $isEdit
                                ? 'Simpan Perubahan'
                                : 'Simpan Data'
                            }}
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection