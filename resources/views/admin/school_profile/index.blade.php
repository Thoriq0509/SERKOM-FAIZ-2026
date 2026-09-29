@extends('layouts.template')

@section('content')

<div class="container-fluid px-0">

<!-- Header -->
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Profil Sekolah</h2>
        <p class="text-muted mb-0">Informasi lengkap mengenai profil sekolah.</p>
    </div>

    <a href="{{ route('admin.school_profile.edit') }}" class="btn btn-primary px-4">
        Edit Profil
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

<!-- Identitas Sekolah -->
<div class="card border shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="row align-items-center">

            <!-- Logo -->
            <div class="col-md-2 text-center mb-3 mb-md-0">

                @if ($schoolProfile && $schoolProfile->logo)

                    <img
                        src="{{ asset('storage/' . $schoolProfile->logo) }}"
                        alt="Logo {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}"
                        class="img-fluid rounded border p-2 bg-white"
                        style="width: 130px; height: 130px; object-fit: contain;"
                    >

                @else

                    <div
                        class="bg-light border rounded d-flex align-items-center justify-content-center mx-auto"
                        style="width: 130px; height: 130px;"
                    >
                        <span class="text-muted small">Belum ada logo</span>
                    </div>

                @endif

            </div>

            <!-- Identitas -->
            <div class="col-md-10">

                <h3 class="fw-bold mb-3">
                    {{ $schoolProfile->nama_sekolah ?? 'Nama Sekolah Belum Diatur' }}
                </h3>

                <div class="row g-3">

                    <div class="col-sm-6 col-lg-4">
                        <div class="text-muted small">NPSN</div>
                        <div class="fw-semibold">
                            {{ $schoolProfile->npsn ?? '-' }}
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="text-muted small">Tahun Berdiri</div>
                        <div class="fw-semibold">
                            {{ $schoolProfile->tahun_berdiri ?? '-' }}
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="text-muted small">Kepala Sekolah</div>
                        <div class="fw-semibold">
                            {{ $schoolProfile->kepala_sekolah ?? '-' }}
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

<!-- Informasi Sekolah -->
<div class="card border shadow-sm mb-4">

    <div class="card-header bg-white border-bottom py-3">
        <h5 class="fw-bold mb-0">
            Informasi Sekolah
        </h5>
    </div>

    <div class="card-body">

        <div class="row g-4">

            <!-- Kepala Sekolah -->
            <div class="col-md-6">
                <div class="text-muted small mb-1">
                    Kepala Sekolah
                </div>

                <div class="fw-semibold">
                    {{ $schoolProfile->kepala_sekolah ?? '-' }}
                </div>
            </div>

            <!-- Tahun Berdiri -->
            <div class="col-md-6">
                <div class="text-muted small mb-1">
                    Tahun Berdiri
                </div>

                <div class="fw-semibold">
                    {{ $schoolProfile->tahun_berdiri ?? '-' }}
                </div>
            </div>

            <!-- NPSN -->
            <div class="col-md-6">
                <div class="text-muted small mb-1">
                    NPSN
                </div>

                <div class="fw-semibold">
                    {{ $schoolProfile->npsn ?? '-' }}
                </div>
            </div>

            <!-- Kontak -->
            <div class="col-md-6">
                <div class="text-muted small mb-1">
                    Kontak / Telepon
                </div>

                <div class="fw-semibold">
                    {{ $schoolProfile->kontak ?? '-' }}
                </div>
            </div>

            <!-- Alamat -->
            <div class="col-12">
                <div class="text-muted small mb-1">
                    Alamat Lengkap
                </div>

                <div class="fw-semibold">
                    {{ $schoolProfile->alamat ?? '-' }}
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Visi Misi & Deskripsi -->
<div class="row g-4 mb-4">

    <!-- Visi Misi -->
    <div class="col-lg-6">

        <div class="card border shadow-sm h-100">

            <div class="card-header bg-white border-bottom py-3">
                <h5 class="fw-bold mb-0">
                    Visi & Misi
                </h5>
            </div>

            <div class="card-body">

                <div
                    class="text-dark"
                    style="white-space: pre-line; line-height: 1.8;"
                >
                    {{ $schoolProfile->visi_misi ?? 'Belum ada data visi dan misi.' }}
                </div>

            </div>

        </div>

    </div>

    <!-- Sejarah / Deskripsi -->
    <div class="col-lg-6">

        <div class="card border shadow-sm h-100">

            <div class="card-header bg-white border-bottom py-3">
                <h5 class="fw-bold mb-0">
                    Sejarah / Deskripsi
                </h5>
            </div>

            <div class="card-body">

                <p class="text-dark mb-0" style="line-height: 1.8;">
                    {{ $schoolProfile->deskripsi ?? 'Belum ada deskripsi sekolah.' }}
                </p>

            </div>

        </div>

    </div>

</div>

<!-- Foto Gedung -->
<div class="card border shadow-sm mb-4">

    <div class="card-header bg-white border-bottom py-3">
        <h5 class="fw-bold mb-0">
            Foto Gedung Utama
        </h5>
    </div>

    <div class="card-body p-0">

        @if ($schoolProfile && $schoolProfile->foto)

            <img
                src="{{ asset('storage/' . $schoolProfile->foto) }}"
                alt="Foto Gedung {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}"
                class="img-fluid w-100"
                style="max-height: 400px; object-fit: cover;"
            >

        @else

            <div class="bg-light text-muted text-center py-5">
                <div>
                    Belum ada foto gedung sekolah.
                </div>
            </div>

        @endif

    </div>

</div>

</div>

@endsection
