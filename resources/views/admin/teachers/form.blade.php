@extends('layouts.template')

@php
    $isEdit = isset($teacher) && $teacher->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($teacher->getKey())
        : null;
@endphp

@section('content')

<style>
    /* ================================
       FORM CARD
    ================================ */

    .form-card {
        background-color: #ffffff;
        border: 1px solid #d8e0e8;
        border-radius: 6px;
        overflow: hidden;
    }

    .form-card-header {
        background-color: #172a4d;
        color: #ffffff;
        padding: 18px 24px;
        border-bottom: 1px solid #10203c;
    }

    .form-card-header h5 {
        margin: 0;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .form-card-body {
        padding: 28px;
    }

    .form-label {
        margin-bottom: 7px;
        color: #334155;
        font-size: 0.84rem;
        font-weight: 600;
    }

    .form-control {
        min-height: 44px;
        padding: 10px 13px;
        border: 1px solid #d8e0e8;
        border-radius: 5px;
        color: #334155;
        font-size: 0.85rem;
    }

    .form-control:focus {
        border-color: #273b69;
        box-shadow: 0 0 0 2px rgba(39, 59, 105, 0.10);
    }

    textarea.form-control {
        resize: vertical;
    }

    /* ================================
       FOTO
    ================================ */

    .current-photo-wrapper {
        margin-top: 14px;
    }

    .current-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        padding: 3px;
        background-color: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 5px;
    }

    .preview-wrapper {
        display: none;
        margin-top: 14px;
    }

    .preview-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        padding: 3px;
        background-color: #ffffff;
        border: 2px solid #273b69;
        border-radius: 5px;
    }

    /* ================================
       BUTTON
    ================================ */

    .btn-main {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 42px;
        padding: 9px 18px;
        background-color: #273b69;
        border: 1px solid #273b69;
        border-radius: 5px;
        color: #ffffff;
        font-size: 0.84rem;
        font-weight: 600;
    }

    .btn-main:hover {
        background-color: #1f3159;
        border-color: #1f3159;
        color: #ffffff;
    }

    .btn-back {
        min-height: 42px;
        padding: 9px 18px;
        border-radius: 5px;
        font-size: 0.84rem;
        font-weight: 600;
    }

    /* ================================
       DANGER ZONE
    ================================ */

    .danger-card {
        background-color: #ffffff;
        border: 1px solid #e2bcbc;
        border-radius: 6px;
        overflow: hidden;
    }

    .danger-header {
        padding: 15px 20px;
        background-color: #f8eeee;
        border-bottom: 1px solid #e2bcbc;
        color: #8b1e1e;
    }

    .danger-header h6 {
        margin: 0;
        font-size: 0.87rem;
        font-weight: 700;
    }

    .danger-body {
        padding: 20px;
    }

    /* ================================
       RESPONSIVE
    ================================ */

    @media (max-width: 767.98px) {

        .form-card-body {
            padding: 20px 15px;
        }

        .form-card-header {
            padding: 16px 15px;
        }

        .danger-body {
            padding: 18px 15px;
        }

        .action-wrapper {
            flex-direction: column-reverse;
        }

        .action-wrapper a,
        .action-wrapper button {
            width: 100%;
        }

    }
</style>


<div class="container-fluid p-0">

    <!-- ================================
         HEADER
    ================================ -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h2 class="fw-bold text-dark mb-1"
                style="font-family: 'Poppins', sans-serif;">

                {{ $isEdit ? 'Edit Data Guru' : 'Tambah Data Guru' }}

            </h2>

            <p class="text-muted mb-0">

                {{ $isEdit
                    ? 'Perbarui informasi tenaga pendidik.'
                    : 'Tambahkan tenaga pendidik baru ke dalam sistem.'
                }}

            </p>

        </div>


        <a
            href="{{ route('admin.guru') }}"
            class="btn btn-secondary btn-back">

            <i class="fas fa-arrow-left me-2"></i>
            Kembali

        </a>

    </div>


    <!-- ================================
         ALERT ERROR VALIDASI
    ================================ -->

    @if($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert">

            <div class="d-flex align-items-start">

                <i class="fas fa-exclamation-circle me-3 mt-1"></i>

                <div>

                    <strong>
                        Gagal menyimpan data.
                    </strong>

                    <ul class="mb-0 mt-2 ps-3">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup">
            </button>

        </div>

    @endif


    <!-- ================================
         ALERT SUCCESS
    ================================ -->

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup">
            </button>

        </div>

    @endif


    <!-- ================================
         FORM GURU
    ================================ -->

    <div class="form-card mb-4">

        <!-- HEADER FORM -->

        <div class="form-card-header">

            <h5>

                <i class="fas {{ $isEdit ? 'fa-edit' : 'fa-user-plus' }} me-2"></i>

                {{ $isEdit
                    ? 'Form Edit Data Guru'
                    : 'Form Tambah Data Guru'
                }}

            </h5>

        </div>


        <!-- BODY FORM -->

        <div class="form-card-body">

            <form
                action="{{ $isEdit
                    ? route('admin.guru.update', $encryptedId)
                    : route('admin.guru.store')
                }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                @if($isEdit)

                    @method('PUT')

                @endif


                <!-- ================================
                     DATA UTAMA
                ================================ -->

                <div class="row">

                    <!-- Nama Guru -->

                    <div class="col-md-6 mb-4">

                        <label
                            for="nama_guru"
                            class="form-label">

                            Nama Lengkap Guru
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            id="nama_guru"
                            name="nama_guru"
                            class="form-control @error('nama_guru') is-invalid @enderror"
                            value="{{ old('nama_guru', $teacher->nama_guru ?? '') }}"
                            maxlength="40"
                            placeholder="Contoh: Ahmad Fauzi, S.Kom."
                            required>

                        @error('nama_guru')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- NIP -->

                    <div class="col-md-6 mb-4">

                        <label
                            for="nip"
                            class="form-label">

                            NIP

                            <span class="text-muted fw-normal">
                                (Opsional)
                            </span>

                        </label>

                        <input
                            type="text"
                            id="nip"
                            name="nip"
                            class="form-control @error('nip') is-invalid @enderror"
                            value="{{ old('nip', $teacher->nip ?? '') }}"
                            maxlength="15"
                            placeholder="Masukkan NIP">

                        @error('nip')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <!-- ================================
                     MATA PELAJARAN
                ================================ -->

                <div class="mb-4">

                    <label
                        for="mapel"
                        class="form-label">

                        Mata Pelajaran

                        <span class="text-muted fw-normal">
                            (Opsional)
                        </span>

                    </label>

                    <input
                        type="text"
                        id="mapel"
                        name="mapel"
                        class="form-control @error('mapel') is-invalid @enderror"
                        value="{{ old('mapel', $teacher->mapel ?? '') }}"
                        maxlength="40"
                        placeholder="Contoh: Rekayasa Perangkat Lunak">

                    @error('mapel')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- ================================
                     FOTO GURU
                ================================ -->

                <div class="mb-4">

                    <label
                        for="foto"
                        class="form-label">

                        Foto Guru

                        <span class="text-muted fw-normal">
                            (Opsional)
                        </span>

                    </label>

                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png">

                    <small class="text-muted d-block mt-2">

                        Format JPG, JPEG, atau PNG.
                        Ukuran maksimal 2 MB.

                        @if($isEdit)

                            <br>

                            Kosongkan jika tidak ingin mengganti foto.

                        @endif

                    </small>


                    @error('foto')

                        <div class="text-danger small mt-2">
                            {{ $message }}
                        </div>

                    @enderror


                    <!-- FOTO SAAT INI -->

                    @if($isEdit && $teacher->foto)

                        <div class="current-photo-wrapper">

                            <span class="d-block small text-muted mb-2">
                                Foto saat ini:
                            </span>

                            <img
                                src="{{ asset('storage/' . $teacher->foto) }}"
                                alt="{{ $teacher->nama_guru }}"
                                class="current-photo">

                        </div>

                    @endif


                    <!-- PREVIEW FOTO BARU -->

                    <div
                        id="previewWrapper"
                        class="preview-wrapper">

                        <span class="d-block small text-muted mb-2">
                            Preview foto baru:
                        </span>

                        <img
                            id="previewPhoto"
                            src=""
                            alt="Preview foto"
                            class="preview-photo">

                    </div>

                </div>


                <!-- ================================
                     BUTTON
                ================================ -->

                <div class="border-top pt-4">

                    <div class="d-flex justify-content-end gap-2 action-wrapper">

                        <a
                            href="{{ route('admin.guru') }}"
                            class="btn btn-secondary btn-back">

                            <i class="fas fa-times me-2"></i>

                            Batal

                        </a>


                        <button
                            type="submit"
                            class="btn btn-main">

                            <i class="fas {{ $isEdit ? 'fa-save' : 'fa-plus' }} me-2"></i>

                            {{ $isEdit
                                ? 'Simpan Perubahan'
                                : 'Simpan Data Guru'
                            }}

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <!-- ================================
         ZONA BAHAYA
    ================================ -->

    @if($isEdit)

        <div class="danger-card mb-5">

            <div class="danger-header">

                <h6>

                    <i class="fas fa-exclamation-triangle me-2"></i>

                    Zona Bahaya

                </h6>

            </div>


            <div class="danger-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h6 class="fw-bold text-dark mb-1">
                            Hapus Data Guru
                        </h6>

                        <p class="text-muted mb-0 small">

                            Data guru
                            <strong>{{ $teacher->nama_guru }}</strong>
                            akan dihapus secara permanen.

                        </p>

                    </div>


                    <form
                        action="{{ route('admin.guru.destroy', $encryptedId) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $teacher->nama_guru }}? Data yang sudah dihapus tidak dapat dikembalikan.');">

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-outline-danger">

                            <i class="fas fa-trash-alt me-2"></i>

                            Hapus Data

                        </button>

                    </form>

                </div>

            </div>

        </div>

    @endif

</div>


<!-- ================================
     PREVIEW FOTO
================================ -->

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const fotoInput = document.getElementById('foto');
        const previewWrapper = document.getElementById('previewWrapper');
        const previewPhoto = document.getElementById('previewPhoto');

        if (!fotoInput) {
            return;
        }

        fotoInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {

                previewWrapper.style.display = 'none';
                previewPhoto.src = '';

                return;
            }

            if (!file.type.startsWith('image/')) {

                previewWrapper.style.display = 'none';
                previewPhoto.src = '';

                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                previewPhoto.src = e.target.result;
                previewWrapper.style.display = 'block';

            };

            reader.readAsDataURL(file);

        });

    });
</script>

@endsection