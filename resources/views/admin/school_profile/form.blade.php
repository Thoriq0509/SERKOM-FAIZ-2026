@extends('layouts.template')

@section('content')

<div class="container-fluid px-0">

<!-- Header -->
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Edit Profil Sekolah</h2>
        <p class="text-muted mb-0">Perbarui informasi profil sekolah.</p>
    </div>

    <a href="{{ route('admin.school_profile') }}" class="btn btn-secondary px-4">
        Kembali
    </a>
</div>

<!-- Alert Success -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        {{ session('success') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Alert Error -->
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        {{ session('error') }}

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Validation Error -->
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <strong>Gagal menyimpan data.</strong>
        <p class="mb-2 mt-1">Periksa kembali data yang kamu masukkan.</p>

        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form
    action="{{ route('admin.school_profile.update') }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')

    <!-- Informasi Sekolah -->
    <div class="card border shadow-sm mb-4">

        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold mb-0">Informasi Sekolah</h5>
        </div>

        <div class="card-body p-4">

            <div class="row g-3">

                <!-- Nama Sekolah -->
                <div class="col-md-6">
                    <label for="nama_sekolah" class="form-label fw-semibold">
                        Nama Sekolah <span class="text-danger">*</span>
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
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kepala Sekolah -->
                <div class="col-md-6">
                    <label for="kepala_sekolah" class="form-label fw-semibold">
                        Kepala Sekolah <span class="text-danger">*</span>
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
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NPSN -->
                <div class="col-md-4">
                    <label for="npsn" class="form-label fw-semibold">
                        NPSN <span class="text-danger">*</span>
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
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kontak -->
                <div class="col-md-4">
                    <label for="kontak" class="form-label fw-semibold">
                        Kontak / Telepon <span class="text-danger">*</span>
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
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tahun Berdiri -->
                <div class="col-md-4">
                    <label for="tahun_berdiri" class="form-label fw-semibold">
                        Tahun Berdiri <span class="text-danger">*</span>
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
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="col-12">
                    <label for="alamat" class="form-label fw-semibold">
                        Alamat Lengkap <span class="text-danger">*</span>
                    </label>

                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="3"
                        class="form-control @error('alamat') is-invalid @enderror"
                        required
                    >{{ old('alamat', $schoolProfile->alamat ?? '') }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

        </div>
    </div>

    <!-- Media Sekolah -->
    <div class="card border shadow-sm mb-4">

        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold mb-0">Media Sekolah</h5>
        </div>

        <div class="card-body p-4">

            <div class="row g-4">

                <!-- Logo -->
                <div class="col-lg-4">

                    <label for="logo" class="form-label fw-semibold">
                        Logo Sekolah
                    </label>

                    <input
                        type="file"
                        id="logo"
                        name="logo"
                        class="form-control @error('logo') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png"
                    >

                    <div class="form-text">
                        JPG, JPEG, PNG. Maksimal 2 MB.
                    </div>

                    @error('logo')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    <div class="mt-3">

                        @if (!empty($schoolProfile->logo))

                            <p class="text-muted small mb-2">Logo saat ini:</p>

                            <div class="border rounded p-3 text-center bg-light">
                                <img
                                    src="{{ asset('storage/' . $schoolProfile->logo) }}"
                                    alt="Logo {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}"
                                    class="img-fluid"
                                    style="width: 140px; height: 140px; object-fit: contain;"
                                >
                            </div>

                        @else

                            <div class="border rounded bg-light text-muted text-center py-5">
                                <div class="small">Belum ada logo</div>
                            </div>

                        @endif

                    </div>

                </div>

                <!-- Foto Gedung -->
                <div class="col-lg-8">

                    <label for="foto" class="form-label fw-semibold">
                        Foto Gedung / Foto Utama
                    </label>

                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png"
                    >

                    <div class="form-text">
                        JPG, JPEG, PNG. Maksimal 2 MB.
                    </div>

                    @error('foto')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    <div class="mt-3">

                        @if (!empty($schoolProfile->foto))

                            <p class="text-muted small mb-2">Foto saat ini:</p>

                            <div class="border rounded p-2 bg-light">
                                <img
                                    src="{{ asset('storage/' . $schoolProfile->foto) }}"
                                    alt="Foto {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}"
                                    class="img-fluid rounded w-100"
                                    style="max-height: 260px; object-fit: cover;"
                                >
                            </div>

                        @else

                            <div class="border rounded bg-light text-muted text-center py-5">
                                <div class="small">Belum ada foto gedung</div>
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Visi & Misi -->
    <div class="card border shadow-sm mb-4">

        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold mb-0">Visi & Misi</h5>
        </div>

        <div class="card-body p-4">

            <label for="visi_misi" class="form-label fw-semibold">
                Visi dan Misi <span class="text-danger">*</span>
            </label>

            <textarea
                id="visi_misi"
                name="visi_misi"
                rows="8"
                class="form-control @error('visi_misi') is-invalid @enderror"
                required
            >{{ old('visi_misi', $schoolProfile->visi_misi ?? '') }}</textarea>

            @error('visi_misi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>
    </div>

    <!-- Sejarah / Deskripsi -->
    <div class="card border shadow-sm mb-4">

        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold mb-0">Sejarah / Deskripsi</h5>
        </div>

        <div class="card-body p-4">

            <label for="deskripsi" class="form-label fw-semibold">
                Deskripsi / Sejarah Singkat
            </label>

            <textarea
                id="deskripsi"
                name="deskripsi"
                rows="8"
                class="form-control @error('deskripsi') is-invalid @enderror"
            >{{ old('deskripsi', $schoolProfile->deskripsi ?? '') }}</textarea>

            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="card border shadow-sm mb-4">

        <div class="card-body p-4">

            <div class="d-flex justify-content-end flex-wrap gap-2">

                <a
                    href="{{ route('admin.school_profile') }}"
                    class="btn btn-secondary px-4"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary px-4"
                >
                    Simpan Perubahan
                </button>

            </div>

        </div>
    </div>

</form>

</div>

@endsection
