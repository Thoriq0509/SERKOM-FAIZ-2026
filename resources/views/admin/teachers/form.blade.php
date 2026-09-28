@php
    $isEdit = isset($teacher) && $teacher->exists;
    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encrypt($teacher->id)
        : null;
@endphp

@extends('layouts.template')

@section('content')

<style>
    /* ================================
       FORM CARD
    ================================ */

    .form-card {
        background-color: #ffffff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .form-card-header {
        background-color: #273b69;
        color: #ffffff;
        padding: 20px 24px;
    }

    .form-card-header h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        margin: 0;
    }

    .form-card-body {
        padding: 30px;
    }

    .form-label {
        color: #334155;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        padding: 11px 14px;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #273b69;
        box-shadow: 0 0 0 3px rgba(39, 59, 105, 0.10);
    }

    textarea.form-control {
        resize: vertical;
    }

    /* ================================
       FOTO
    ================================ */

    .current-photo-wrapper {
        margin-top: 15px;
    }

    .current-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        padding: 3px;
        background-color: #ffffff;
    }

    .photo-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        background-color: #f1f5f9;
        border: 2px dashed #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 2rem;
    }

    .preview-wrapper {
        display: none;
        margin-top: 15px;
    }

    .preview-photo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #273b69;
        padding: 3px;
        background-color: #ffffff;
    }

    /* ================================
       BUTTON
    ================================ */

    .btn-main {
        background-color: #273b69;
        border: none;
        color: #ffffff;
        border-radius: 10px;
        padding: 10px 20px;
        transition: all 0.2s ease;
    }

    .btn-main:hover {
        background-color: #1f3159;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .btn-back {
        border-radius: 10px;
        padding: 10px 20px;
    }

    /* ================================
       DANGER ZONE
    ================================ */

    .danger-card {
        background-color: #ffffff;
        border: 1px solid #fecaca;
        border-radius: 16px;
        overflow: hidden;
    }

    .danger-header {
        background-color: #fef2f2;
        color: #b91c1c;
        padding: 18px 24px;
        border-bottom: 1px solid #fecaca;
    }

    .danger-header h6 {
        margin: 0;
        font-weight: 700;
    }

    .danger-body {
        padding: 24px;
    }

    /* ================================
       RESPONSIVE
    ================================ */

    @media (max-width: 767.98px) {

        .form-card-body {
            padding: 20px 15px;
        }

        .form-card-header {
            padding: 18px 15px;
        }

        .danger-body {
            padding: 20px 15px;
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
         ALERT ERROR
    ================================ -->

    @if($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show border-0 shadow-sm"
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
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ================================
         ALERT SUCCESS
    ================================ -->

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm"
            role="alert">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ================================
         FORM GURU
    ================================ -->

    <div class="form-card mb-4">

        <!-- Header -->

        <div class="form-card-header">

            <h5>

                <i class="fas {{ $isEdit ? 'fa-edit' : 'fa-user-plus' }} me-2"></i>

                {{ $isEdit
                    ? 'Form Edit Data Guru'
                    : 'Form Tambah Data Guru'
                }}

            </h5>

        </div>


        <!-- Body -->

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
                            class="form-label fw-semibold">

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
                            class="form-label fw-semibold">

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
                        class="form-label fw-semibold">

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
                        class="form-label fw-semibold">

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


                    <!-- Foto Saat Ini -->

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


                    <!-- Preview Foto Baru -->

                    <div
                        id="previewWrapper"
                        class="preview-wrapper">

                        <span class="d-block small text-muted mb-2">
                            Preview foto baru:
                        </span>

                        <img
                            id="previewPhoto"
                            src=""
                            alt="Preview"
                            class="preview-photo">

                    </div>

                </div>


                <!-- ================================
                     BUTTON SIMPAN
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
         DELETE
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
     FOTO PREVIEW SCRIPT
================================ -->

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const fotoInput = document.getElementById('foto');
        const previewWrapper = document.getElementById('previewWrapper');
        const previewPhoto = document.getElementById('previewPhoto');

        if (fotoInput) {

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

        }

    });
</script>

@endsection