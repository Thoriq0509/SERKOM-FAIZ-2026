@extends('layouts.template')

@section('content')

<style>
    /* ================================
       DASHBOARD
    ================================ */

    .dashboard-profile {
        background-color: #273b69;
        border-radius: 20px;
        color: #ffffff;
        padding: 35px 30px;
        box-shadow: 0 10px 25px rgba(39, 59, 105, 0.15);
        position: relative;
        overflow: hidden;
    }

    .dashboard-profile::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.04);
        right: -60px;
        top: -70px;
    }

    .dashboard-profile::after {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.03);
        right: 80px;
        bottom: -60px;
    }

    .dashboard-profile-content {
        position: relative;
        z-index: 2;
    }

    .dashboard-profile h2 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .dashboard-profile p {
        margin-bottom: 0;
        line-height: 1.7;
    }

    .dashboard-profile-button {
        background-color: #ffffff;
        color: #273b69;
        border: none;
        border-radius: 50px;
        padding: 11px 20px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .dashboard-profile-button:hover {
        background-color: #f1f5f9;
        color: #273b69;
        transform: translateY(-2px);
    }

    /* ================================
       STAT CARD
    ================================ */

    .stat-box {
        border-radius: 18px;
        padding: 25px 20px;
        color: #ffffff;
        text-align: center;
        min-height: 185px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
        transition: all 0.25s ease;
    }

    .stat-box:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.15);
        margin-bottom: 12px;
        font-size: 1.4rem;
    }

    .stat-box h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 4px;
        font-family: 'Poppins', sans-serif;
    }

    .stat-box p {
        font-size: 0.9rem;
        font-weight: 600;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.7px;
    }

    .box-blue {
        background-color: #2563eb;
    }

    .box-red {
        background-color: #dc2626;
    }

    .box-yellow {
        background-color: #eab308;
        color: #1e293b;
    }

    .box-green {
        background-color: #16a34a;
    }

    .box-purple {
        background-color: #7c3aed;
    }

    .box-orange {
        background-color: #ea580c;
    }

    /* ================================
       TABLE CARD
    ================================ */

    .table-card {
        background-color: #ffffff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .table-card .card-header {
        background-color: #273b69;
        color: #ffffff;
        padding: 18px 22px;
        border: none;
        font-family: 'Poppins', sans-serif;
    }

    /* ================================
       RESPONSIVE
    ================================ */

    @media (max-width: 767.98px) {

        .dashboard-profile {
            padding: 25px 20px;
        }

        .dashboard-profile h2 {
            font-size: 1.5rem;
        }

        .stat-box {
            min-height: 160px;
        }

        .stat-box h3 {
            font-size: 2.2rem;
        }

        .table-card .card-header {
            padding: 15px;
        }
    }
</style>


<div class="container-fluid p-0">

    <!-- ================================
         HEADER / PROFIL SEKOLAH
    ================================ -->
    <div class="dashboard-profile mb-4">

        <div class="dashboard-profile-content">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <h2>
                        {{ $profilSekolah->nama_sekolah ?? 'Nama Sekolah' }}
                    </h2>

                    <p class="text-white opacity-75">
                        Selamat datang di halaman dashboard admin.
                        Pantau data sekolah, pengelola, guru, siswa,
                        ekstrakurikuler, berita, dan galeri dari satu tempat.
                    </p>

                    @if($profilSekolah && $profilSekolah->npsn)

                        <div class="mt-3">

                            <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                <i class="fas fa-id-card me-1"></i>
                                NPSN: {{ $profilSekolah->npsn }}
                            </span>

                        </div>

                    @endif

                </div>


                <div class="col-lg-4 text-lg-end text-start mt-4 mt-lg-0">

                    <a
                        href="{{ route('admin.school_profile.edit') }}"
                        class="dashboard-profile-button"
                    >

                        <i class="fas fa-edit me-2"></i>
                        Edit Profil

                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- ================================
         STATISTIK DATA
    ================================ -->
    <div class="row g-4 mb-4">

        <!-- Pengelola -->
        <div class="col-12 col-sm-6 col-xl-2">

            <div class="stat-box box-blue">

                <div class="stat-icon">
                    <i class="fas fa-users-cog"></i>
                </div>

                <h3>
                    {{ $totalPengelola }}
                </h3>

                <p>
                    Pengelola
                </p>

            </div>

        </div>


        <!-- Guru -->
        <div class="col-12 col-sm-6 col-xl-2">

            <div class="stat-box box-red">

                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>

                <h3>
                    {{ $totalGuru }}
                </h3>

                <p>
                    Guru
                </p>

            </div>

        </div>


        <!-- Siswa -->
        <div class="col-12 col-sm-6 col-xl-2">

            <div class="stat-box box-yellow">

                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>

                <h3>
                    {{ $totalSiswa }}
                </h3>

                <p>
                    Siswa
                </p>

            </div>

        </div>


        <!-- Ekstrakurikuler -->
        <div class="col-12 col-sm-6 col-xl-2">

            <div class="stat-box box-green">

                <div class="stat-icon">
                    <i class="fas fa-basketball-ball"></i>
                </div>

                <h3>
                    {{ $totalEkstrakurikuler }}
                </h3>

                <p>
                    Ekskul
                </p>

            </div>

        </div>


        <!-- Berita -->
        <div class="col-12 col-sm-6 col-xl-2">

            <div class="stat-box box-purple">

                <div class="stat-icon">
                    <i class="fas fa-newspaper"></i>
                </div>

                <h3>
                    {{ $totalBerita }}
                </h3>

                <p>
                    Berita
                </p>

            </div>

        </div>


        <!-- Galeri -->
        <div class="col-12 col-sm-6 col-xl-2">

            <div class="stat-box box-orange">

                <div class="stat-icon">
                    <i class="fas fa-images"></i>
                </div>

                <h3>
                    {{ $totalGaleri }}
                </h3>

                <p>
                    Galeri
                </p>

            </div>

        </div>

    </div>


    <!-- ================================
         AKSES CEPAT
    ================================ -->
    <div class="card table-card mb-5">

        <div class="card-header">

            <i class="fas fa-bolt me-2"></i>
            Akses Cepat

        </div>


        <div class="card-body">

            <div class="row g-3">

                <!-- Profil -->
                <div class="col-12 col-md-4 col-xl-2">

                    <a
                        href="{{ route('admin.school_profile') }}"
                        class="btn btn-light border w-100 py-3"
                    >

                        <i
                            class="fas fa-school d-block mb-2"
                            style="font-size: 1.4rem; color: #273b69;"
                        ></i>

                        Profil Sekolah

                    </a>

                </div>


                <!-- Pengelola -->
                <div class="col-12 col-md-4 col-xl-2">

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="btn btn-light border w-100 py-3"
                    >

                        <i
                            class="fas fa-users-cog d-block mb-2"
                            style="font-size: 1.4rem; color: #273b69;"
                        ></i>

                        Pengelola

                    </a>

                </div>


                <!-- Berita -->
                <div class="col-12 col-md-4 col-xl-2">

                    <a
                        href="{{ route('admin.berita') }}"
                        class="btn btn-light border w-100 py-3"
                    >

                        <i
                            class="fas fa-newspaper d-block mb-2"
                            style="font-size: 1.4rem; color: #273b69;"
                        ></i>

                        Berita

                    </a>

                </div>


                <!-- Ekstrakurikuler -->
                <div class="col-12 col-md-4 col-xl-2">

                    <a
                        href="{{ route('admin.ekstrakulikuler') }}"
                        class="btn btn-light border w-100 py-3"
                    >

                        <i
                            class="fas fa-basketball-ball d-block mb-2"
                            style="font-size: 1.4rem; color: #273b69;"
                        ></i>

                        Ekskul

                    </a>

                </div>


                <!-- Guru -->
                <div class="col-12 col-md-4 col-xl-2">

                    <a
                        href="{{ route('admin.guru') }}"
                        class="btn btn-light border w-100 py-3"
                    >

                        <i
                            class="fas fa-chalkboard-teacher d-block mb-2"
                            style="font-size: 1.4rem; color: #273b69;"
                        ></i>

                        Guru

                    </a>

                </div>


                <!-- Siswa -->
                <div class="col-12 col-md-4 col-xl-2">

                    <a
                        href="{{ route('admin.siswa') }}"
                        class="btn btn-light border w-100 py-3"
                    >

                        <i
                            class="fas fa-user-graduate d-block mb-2"
                            style="font-size: 1.4rem; color: #273b69;"
                        ></i>

                        Siswa

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection