@extends('layouts.template')

@section('content')

<div class="container-fluid px-0">

    <!-- ================= HEADER ================= -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h2
                class="fw-bold text-dark mb-1"
                style="font-family: 'Poppins', sans-serif;"
            >
                Edit Profil Sekolah
            </h2>

            <p class="text-muted mb-0">
                Perbarui informasi profil sekolah di bawah ini.
            </p>

        </div>

        <a
            href="{{ route('admin.school_profile') }}"
            class="btn btn-secondary px-4 py-2 shadow-sm"
        >
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>

    </div>


    <!-- ================= ALERT SUCCESS ================= -->
    @if (session('success'))

        <div
            class="alert alert-success alert-dismissible fade show shadow-sm border-0"
            role="alert"
        >

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"
            ></button>

        </div>

    @endif


    <!-- ================= ALERT ERROR ================= -->
    @if (session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm border-0"
            role="alert"
        >

            <i class="fas fa-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"
            ></button>

        </div>

    @endif


    <!-- ================= VALIDATION ERROR ================= -->
    @if ($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm border-0"
            role="alert"
        >

            <div class="d-flex align-items-start">

                <i class="fas fa-exclamation-triangle me-3 mt-1"></i>

                <div class="flex-grow-1">

                    <strong>Gagal menyimpan data.</strong>

                    <p class="mb-2 mt-1">
                        Periksa kembali data yang kamu masukkan.
                    </p>

                    <ul class="mb-0 ps-3">

                        @foreach ($errors->all() as $error)

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
                aria-label="Tutup"
            ></button>

        </div>

    @endif


    <!-- ================= FORM UTAMA ================= -->
    <form
        action="{{ route('admin.school_profile.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')


        <!-- ================= INFORMASI SEKOLAH ================= -->
        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius: 15px;"
        >

            <div
                class="card-header bg-white p-4"
                style="
                    border-radius: 15px 15px 0 0;
                    border-bottom: 2px solid #f1f5f9;
                "
            >

                <h5
                    class="fw-bold mb-0"
                    style="color: #273b69;"
                >

                    <i class="fas fa-school me-2"></i>

                    Informasi Sekolah

                </h5>

            </div>


            <div class="card-body p-4">

                <div class="row">


                    <!-- Nama Sekolah -->
                    <div class="col-md-6 mb-3">

                        <label
                            for="nama_sekolah"
                            class="form-label fw-semibold"
                        >

                            Nama Sekolah

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            id="nama_sekolah"
                            name="nama_sekolah"
                            class="form-control @error('nama_sekolah') is-invalid @enderror"
                            value="{{ old('nama_sekolah', $schoolProfile->nama_sekolah ?? '') }}"
                            maxlength="40"
                            required
                        >

                        @error('nama_sekolah')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- Kepala Sekolah -->
                    <div class="col-md-6 mb-3">

                        <label
                            for="kepala_sekolah"
                            class="form-label fw-semibold"
                        >

                            Kepala Sekolah

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            id="kepala_sekolah"
                            name="kepala_sekolah"
                            class="form-control @error('kepala_sekolah') is-invalid @enderror"
                            value="{{ old('kepala_sekolah', $schoolProfile->kepala_sekolah ?? '') }}"
                            maxlength="40"
                            required
                        >

                        @error('kepala_sekolah')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <div class="row">


                    <!-- NPSN -->
                    <div class="col-md-4 mb-3">

                        <label
                            for="npsn"
                            class="form-label fw-semibold"
                        >

                            NPSN

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            id="npsn"
                            name="npsn"
                            class="form-control @error('npsn') is-invalid @enderror"
                            value="{{ old('npsn', $schoolProfile->npsn ?? '') }}"
                            maxlength="10"
                            required
                        >

                        @error('npsn')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- Kontak -->
                    <div class="col-md-4 mb-3">

                        <label
                            for="kontak"
                            class="form-label fw-semibold"
                        >

                            Kontak / Telepon

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            id="kontak"
                            name="kontak"
                            class="form-control @error('kontak') is-invalid @enderror"
                            value="{{ old('kontak', $schoolProfile->kontak ?? '') }}"
                            maxlength="15"
                            required
                        >

                        @error('kontak')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- Tahun Berdiri -->
                    <div class="col-md-4 mb-3">

                        <label
                            for="tahun_berdiri"
                            class="form-label fw-semibold"
                        >

                            Tahun Berdiri

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="number"
                            id="tahun_berdiri"
                            name="tahun_berdiri"
                            class="form-control @error('tahun_berdiri') is-invalid @enderror"
                            value="{{ old('tahun_berdiri', $schoolProfile->tahun_berdiri ?? '') }}"
                            min="1900"
                            max="{{ date('Y') }}"
                            required
                        >

                        @error('tahun_berdiri')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>


        <!-- ================= MEDIA SEKOLAH ================= -->
        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius: 15px;"
        >

            <div
                class="card-header bg-white p-4"
                style="
                    border-radius: 15px 15px 0 0;
                    border-bottom: 2px solid #f1f5f9;
                "
            >

                <h5
                    class="fw-bold mb-0"
                    style="color: #273b69;"
                >

                    <i class="fas fa-images me-2"></i>

                    Media Sekolah

                </h5>

            </div>


            <div class="card-body p-4">

                <div class="row">


                    <!-- LOGO -->
                    <div class="col-md-6 mb-4">

                        <label
                            for="logo"
                            class="form-label fw-semibold"
                        >

                            Logo Sekolah

                        </label>

                        <input
                            type="file"
                            id="logo"
                            name="logo"
                            class="form-control @error('logo') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png"
                        >

                        <small class="text-muted d-block mt-2">
                            Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                        </small>

                        @error('logo')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                        @enderror


                        @if (!empty($schoolProfile->logo))

                            <div class="mt-3">

                                <p class="small text-muted mb-2">
                                    Logo saat ini:
                                </p>

                                <div
                                    class="d-inline-flex align-items-center justify-content-center bg-light border rounded-3 p-2"
                                >

                                    <img
                                        src="{{ asset('storage/' . $schoolProfile->logo) }}"
                                        alt="Logo {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}"
                                        style="
                                            width: 120px;
                                            height: 120px;
                                            object-fit: contain;
                                        "
                                    >

                                </div>

                            </div>

                        @else

                            <div class="mt-3">

                                <div
                                    class="d-flex align-items-center justify-content-center bg-light border rounded-3 text-muted"
                                    style="
                                        width: 120px;
                                        height: 120px;
                                    "
                                >

                                    <div class="text-center">

                                        <i class="fas fa-image fa-2x mb-2"></i>

                                        <div class="small">
                                            Belum ada logo
                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif

                    </div>


                    <!-- FOTO GEDUNG -->
                    <div class="col-md-6 mb-4">

                        <label
                            for="foto"
                            class="form-label fw-semibold"
                        >

                            Foto Gedung / Foto Utama

                        </label>

                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            class="form-control @error('foto') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png"
                        >

                        <small class="text-muted d-block mt-2">
                            Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                        </small>

                        @error('foto')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                        @enderror


                        @if (!empty($schoolProfile->foto))

                            <div class="mt-3">

                                <p class="small text-muted mb-2">
                                    Foto saat ini:
                                </p>

                                <div class="bg-light border rounded-3 p-2">

                                    <img
                                        src="{{ asset('storage/' . $schoolProfile->foto) }}"
                                        alt="Foto {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}"
                                        class="img-fluid rounded"
                                        style="
                                            width: 100%;
                                            max-height: 250px;
                                            object-fit: cover;
                                        "
                                    >

                                </div>

                            </div>

                        @else

                            <div class="mt-3">

                                <div
                                    class="d-flex align-items-center justify-content-center bg-light border rounded-3 text-muted"
                                    style="height: 180px;"
                                >

                                    <div class="text-center">

                                        <i class="fas fa-image fa-2x mb-2"></i>

                                        <div class="small">
                                            Belum ada foto gedung
                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        <!-- ================= VISI & MISI ================= -->
        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius: 15px;"
        >

            <div
                class="card-header bg-white p-4"
                style="
                    border-radius: 15px 15px 0 0;
                    border-bottom: 2px solid #f1f5f9;
                "
            >

                <h5
                    class="fw-bold mb-0"
                    style="color: #273b69;"
                >

                    <i class="fas fa-bullseye me-2"></i>

                    Visi & Misi

                </h5>

            </div>


            <div class="card-body p-4">

                <label
                    for="visi_misi"
                    class="form-label fw-semibold"
                >

                    Visi dan Misi

                    <span class="text-danger">*</span>

                </label>

                <textarea
                    id="visi_misi"
                    name="visi_misi"
                    class="form-control @error('visi_misi') is-invalid @enderror"
                    rows="8"
                    required
                >{{ old('visi_misi', $schoolProfile->visi_misi ?? '') }}</textarea>

                @error('visi_misi')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>


        <!-- ================= ALAMAT ================= -->
        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius: 15px;"
        >

            <div
                class="card-header bg-white p-4"
                style="
                    border-radius: 15px 15px 0 0;
                    border-bottom: 2px solid #f1f5f9;
                "
            >

                <h5
                    class="fw-bold mb-0"
                    style="color: #273b69;"
                >

                    <i class="fas fa-map-marker-alt me-2"></i>

                    Alamat Sekolah

                </h5>

            </div>


            <div class="card-body p-4">

                <label
                    for="alamat"
                    class="form-label fw-semibold"
                >

                    Alamat Lengkap

                    <span class="text-danger">*</span>

                </label>

                <textarea
                    id="alamat"
                    name="alamat"
                    class="form-control @error('alamat') is-invalid @enderror"
                    rows="4"
                    required
                >{{ old('alamat', $schoolProfile->alamat ?? '') }}</textarea>

                @error('alamat')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>


        <!-- ================= DESKRIPSI ================= -->
        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius: 15px;"
        >

            <div
                class="card-header bg-white p-4"
                style="
                    border-radius: 15px 15px 0 0;
                    border-bottom: 2px solid #f1f5f9;
                "
            >

                <h5
                    class="fw-bold mb-0"
                    style="color: #273b69;"
                >

                    <i class="fas fa-book-open me-2"></i>

                    Sejarah / Deskripsi

                </h5>

            </div>


            <div class="card-body p-4">

                <label
                    for="deskripsi"
                    class="form-label fw-semibold"
                >

                    Deskripsi / Sejarah Singkat

                </label>

                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                    rows="8"
                >{{ old('deskripsi', $schoolProfile->deskripsi ?? '') }}</textarea>

                @error('deskripsi')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>


        <!-- ================= TOMBOL AKSI ================= -->
        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius: 15px;"
        >

            <div class="card-body p-4">

                <div
                    class="d-flex justify-content-end align-items-center flex-wrap gap-2"
                >

                    <a
                        href="{{ route('admin.school_profile') }}"
                        class="btn btn-secondary px-4 py-2"
                    >

                        <i class="fas fa-times me-2"></i>

                        Batal

                    </a>


                    <button
                        type="submit"
                        class="btn text-white px-4 py-2 shadow-sm"
                        style="
                            background-color: #273b69;
                            border: none;
                        "
                    >

                        <i class="fas fa-save me-2"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </div>

    </form>


    <!-- ================= ZONA BAHAYA =================
    <div
        class="card border-0 shadow-sm mb-5"
        style="border-radius: 15px;"
    >

        <div class="card-body p-4">

            <div
                class="d-flex justify-content-between align-items-center flex-wrap gap-3"
            >

                <div>

                    <h5 class="fw-bold text-danger mb-2">

                        <i class="fas fa-exclamation-triangle me-2"></i>

                        Zona Bahaya

                    </h5>

                    <p class="text-muted mb-0 small">

                        Menghapus profil akan menghapus seluruh data
                        profil sekolah, termasuk logo dan foto yang tersimpan.

                    </p>

                </div>


                <form
                    action="{{ route('admin.school_profile.destroy') }}"
                    method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh data profil sekolah?')"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger px-4 py-2"
                    >

                        <i class="fas fa-trash-alt me-2"></i>

                        Hapus Profil

                    </button>

                </form>

            </div>

        </div>

    </div> -->

</div>

@endsection