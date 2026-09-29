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
                Profil Sekolah
            </h2>

            <p class="text-muted mb-0">
                Informasi lengkap mengenai profil sekolah.
            </p>

        </div>

        <a
            href="{{ route('admin.school_profile.edit') }}"
            class="btn px-4 py-2 shadow-sm text-white"
            style="background-color: #273b69; border: none;"
        >
            <i class="fas fa-edit me-2"></i>
            Edit Profil
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
                aria-label="Close"
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
                aria-label="Close"
            ></button>

        </div>

    @endif


    <!-- ================= CARD PROFIL SEKOLAH ================= -->
    <div
        class="card border-0 shadow-sm overflow-hidden"
        style="border-radius: 16px;"
    >

        <div class="card-body p-0">

            <div class="row g-0">

                <!-- ================= BAGIAN KIRI ================= -->
                <div
                    class="col-lg-4 text-center text-white p-4 p-md-5 d-flex flex-column justify-content-center align-items-center"
                    style="background-color: #273b69;"
                >

                    <!-- Logo Sekolah -->
                    @if ($schoolProfile && $schoolProfile->logo)

                        <img
                            src="{{ asset('storage/' . $schoolProfile->logo) }}"
                            alt="Logo {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}"
                            class="rounded-circle bg-white p-2 shadow mb-4"
                            style="
                                width: 130px;
                                height: 130px;
                                object-fit: contain;
                            "
                        >

                    @else

                        <div
                            class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center shadow mb-4"
                            style="
                                width: 130px;
                                height: 130px;
                                font-size: 3.2rem;
                            "
                        >
                            <i class="fas fa-school"></i>
                        </div>

                    @endif


                    <!-- Nama Sekolah -->
                    <h4 class="fw-bold mb-2">

                        {{ $schoolProfile->nama_sekolah ?? 'Nama Sekolah Belum Diatur' }}

                    </h4>


                    <!-- NPSN -->
                    <p class="mb-1 opacity-75">

                        <i class="fas fa-id-card me-1"></i>

                        NPSN:
                        {{ $schoolProfile->npsn ?? '-' }}

                    </p>


                    <!-- Tahun Berdiri -->
                    <p class="mb-0 opacity-75">

                        <i class="fas fa-calendar-alt me-1"></i>

                        Berdiri:
                        {{ $schoolProfile->tahun_berdiri ?? '-' }}

                    </p>

                </div>


                <!-- ================= BAGIAN KANAN ================= -->
                <div class="col-lg-8 p-4 p-md-5">


                    <!-- ================= INFORMASI DETAIL ================= -->
                    <div class="mb-4">

                        <h5
                            class="fw-bold text-secondary border-bottom pb-3 mb-4"
                        >
                            <i class="fas fa-info-circle me-2"></i>

                            Informasi Detail
                        </h5>


                        <!-- Kepala Sekolah -->
                        <div class="row g-2 mb-3">

                            <div class="col-md-4 text-muted fw-semibold">
                                Kepala Sekolah
                            </div>

                            <div class="col-md-8 text-dark">

                                {{ $schoolProfile->kepala_sekolah ?? '-' }}

                            </div>

                        </div>


                        <!-- Tahun Berdiri -->
                        <div class="row g-2 mb-3">

                            <div class="col-md-4 text-muted fw-semibold">
                                Tahun Berdiri
                            </div>

                            <div class="col-md-8 text-dark">

                                {{ $schoolProfile->tahun_berdiri ?? '-' }}

                            </div>

                        </div>


                        <!-- NPSN -->
                        <div class="row g-2 mb-3">

                            <div class="col-md-4 text-muted fw-semibold">
                                NPSN
                            </div>

                            <div class="col-md-8 text-dark">

                                {{ $schoolProfile->npsn ?? '-' }}

                            </div>

                        </div>


                        <!-- Kontak -->
                        <div class="row g-2 mb-3">

                            <div class="col-md-4 text-muted fw-semibold">
                                Kontak / Telepon
                            </div>

                            <div class="col-md-8 text-dark">

                                {{ $schoolProfile->kontak ?? '-' }}

                            </div>

                        </div>


                        <!-- Alamat -->
                        <div class="row g-2 mb-3">

                            <div class="col-md-4 text-muted fw-semibold">
                                Alamat Lengkap
                            </div>

                            <div class="col-md-8 text-dark">

                                {{ $schoolProfile->alamat ?? '-' }}

                            </div>

                        </div>

                    </div>


                    <!-- ================= VISI & MISI ================= -->
                    <div class="mb-4">

                        <h5
                            class="fw-bold text-secondary border-bottom pb-3 mb-3"
                        >

                            <i class="fas fa-bullseye me-2"></i>

                            Visi & Misi

                        </h5>

                        <div
                            class="text-dark"
                            style="
                                line-height: 1.8;
                                white-space: pre-line;
                            "
                        >

                            {{ $schoolProfile->visi_misi ?? 'Belum ada data visi dan misi.' }}

                        </div>

                    </div>


                    <!-- ================= DESKRIPSI ================= -->
                    <div class="mb-4">

                        <h5
                            class="fw-bold text-secondary border-bottom pb-3 mb-3"
                        >

                            <i class="fas fa-book-open me-2"></i>

                            Sejarah / Deskripsi

                        </h5>

                        <p
                            class="text-dark mb-0"
                            style="line-height: 1.8;"
                        >

                            {{ $schoolProfile->deskripsi ?? 'Belum ada deskripsi sekolah.' }}

                        </p>

                    </div>


                    <!-- ================= FOTO GEDUNG ================= -->
                    @if ($schoolProfile && $schoolProfile->foto)

                        <div class="mt-4">

                            <h5
                                class="fw-bold text-secondary border-bottom pb-3 mb-3"
                            >

                                <i class="fas fa-image me-2"></i>

                                Foto Gedung Utama

                            </h5>


                            <div class="overflow-hidden rounded-3 shadow-sm">

                                <img
                                    src="{{ asset('storage/' . $schoolProfile->foto) }}"
                                    alt="Foto Gedung {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}"
                                    class="img-fluid w-100"
                                    style="
                                        max-height: 350px;
                                        object-fit: cover;
                                    "
                                >

                            </div>

                        </div>

                    @else

                        <div class="mt-4">

                            <div
                                class="d-flex align-items-center justify-content-center bg-light border rounded-3 text-muted"
                                style="height: 220px;"
                            >

                                <div class="text-center">

                                    <i class="fas fa-image fa-2x mb-2"></i>

                                    <div>
                                        Belum ada foto gedung sekolah.
                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection