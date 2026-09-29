@extends('layouts.template')

@section('content')

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
       PROFILE CARD
    ========================== */
    .dashboard-profile {
        background: #fff;
        border: 1px solid var(--c-border);
        border-left: 4px solid var(--c-primary);
        border-radius: 10px;
        padding: 26px 28px;
        box-shadow: 0 1px 2px rgba(15,23,42,.04);
    }

    .dashboard-profile h2 {
        font-family: 'Poppins', sans-serif;
        font-size: 1.35rem;
        font-weight: 600;
        color: var(--c-primary-d);
        margin-bottom: 8px;
    }

    .dashboard-profile p {
        color: var(--c-text-soft);
        font-size: .875rem;
        line-height: 1.6;
        margin: 0;
    }

    .npsn-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: var(--c-soft);
        border: 1px solid var(--c-border);
        color: var(--c-text);
        font-size: .78rem;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 20px;
        margin-top: 12px;
    }

    .btn-edit-profile {
        background-color: var(--c-primary);
        border: 1px solid var(--c-primary);
        color: #fff;
        font-size: .875rem;
        font-weight: 500;
        padding: 9px 22px;
        border-radius: 8px;
        transition: all .15s ease;
    }

    .btn-edit-profile:hover {
        background-color: var(--c-primary-d);
        border-color: var(--c-primary-d);
        color: #fff;
    }

    /* =========================
       STAT BOX
    ========================== */
    .stat-box {
        position: relative;
        background: #fff;
        border: 1px solid var(--c-border);
        border-radius: 10px;
        padding: 22px 15px;
        text-align: center;
        min-height: 130px;
        box-shadow: 0 1px 2px rgba(15,23,42,.04);
        transition: transform .15s ease, box-shadow .15s ease;
    }

    .stat-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(15,23,42,.08);
    }

    .stat-box::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        border-radius: 10px 10px 0 0;
    }

    .stat-box .stat-icon {
        font-size: 1.4rem;
        margin-bottom: 6px;
        display: block;
    }

    .stat-box h3 {
        margin: 8px 0 4px;
        font-size: 1.9rem;
        font-weight: 700;
        color: var(--c-primary-d);
        line-height: 1;
    }

    .stat-box p {
        margin: 0;
        color: var(--c-text-soft);
        font-size: .72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    /* Warna aksen per stat */
    .stat-users::before   { background: #334155; }
    .stat-users .stat-icon   { color: #334155; }

    .stat-teachers::before { background: #2f6b5f; }
    .stat-teachers .stat-icon { color: #2f6b5f; }

    .stat-students::before { background: #8a6d1d; }
    .stat-students .stat-icon { color: #8a6d1d; }

    .stat-ekskul::before   { background: #527047; }
    .stat-ekskul .stat-icon   { color: #527047; }

    .stat-news::before     { background: #75434d; }
    .stat-news .stat-icon     { color: #75434d; }

    .stat-gallery::before  { background: #49677f; }
    .stat-gallery .stat-icon  { color: #49677f; }

    /* =========================
       CARD UMUM
    ========================== */
    .card-clean {
        background-color: #fff;
        border: 1px solid var(--c-border);
        border-radius: 10px;
        box-shadow: 0 1px 2px rgba(15,23,42,.04);
        overflow: hidden;
    }

    .card-clean .card-head {
        padding: 14px 22px;
        border-bottom: 1px solid var(--c-border);
        background-color: #fff;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-clean .card-head h6 {
        margin: 0;
        font-size: .92rem;
        font-weight: 600;
        color: var(--c-primary-d);
    }

    .card-clean .card-head i {
        color: var(--c-primary);
        font-size: .9rem;
    }

    /* =========================
       QUICK ACCESS
    ========================== */
    .quick-access-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        min-height: 90px;
        padding: 14px 10px;
        background: #fff;
        border: 1px solid var(--c-border);
        border-radius: 8px;
        color: var(--c-text);
        font-size: .82rem;
        font-weight: 500;
        text-decoration: none;
        text-align: center;
        transition: all .15s ease;
    }

    .quick-access-item i {
        font-size: 1.3rem;
        color: var(--c-primary);
        transition: color .15s ease;
    }

    .quick-access-item:hover {
        background: var(--c-bg);
        border-color: #cbd5e1;
        color: var(--c-primary-d);
        transform: translateY(-2px);
    }

    .quick-access-item:hover i {
        color: var(--c-primary-d);
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 767.98px) {
        .dashboard-profile {
            padding: 20px 18px;
        }

        .dashboard-profile h2 {
            font-size: 1.15rem;
        }

        .btn-edit-profile {
            width: 100%;
        }

        .stat-box {
            min-height: 115px;
            padding: 18px 12px;
        }

        .stat-box h3 {
            font-size: 1.6rem;
        }
    }
</style>

<div class="container-fluid p-0">

    {{-- PROFILE HEADER --}}
    <div class="dashboard-profile mb-4">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <h2>{{ $profilSekolah->nama_sekolah ?? 'Nama Sekolah' }}</h2>

                <p>
                    Selamat datang di halaman dashboard admin.
                    Pantau data sekolah, pengelola, guru, siswa,
                    ekstrakurikuler, berita, dan galeri dari satu tempat.
                </p>

                @if ($profilSekolah && $profilSekolah->npsn)
                    <div class="npsn-badge">
                        <i class="fas fa-id-card"></i>NPSN: {{ $profilSekolah->npsn }}
                    </div>
                @endif
            </div>

            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('admin.school_profile.edit') }}" class="btn btn-edit-profile">
                    <i class="fas fa-edit me-2"></i>Edit Profil
                </a>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-box stat-users">
                <i class="fas fa-user-gear stat-icon"></i>
                <h3>{{ $totalPengelola }}</h3>
                <p>Pengelola</p>
            </div>
        </div>

        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-box stat-teachers">
                <i class="fas fa-chalkboard stat-icon"></i>
                <h3>{{ $totalGuru }}</h3>
                <p>Guru</p>
            </div>
        </div>

        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-box stat-students">
                <i class="fas fa-user-graduate stat-icon"></i>
                <h3>{{ $totalSiswa }}</h3>
                <p>Siswa</p>
            </div>
        </div>

        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-box stat-ekskul">
                <i class="fas fa-people-group stat-icon"></i>
                <h3>{{ $totalEkstrakurikuler }}</h3>
                <p>Ekskul</p>
            </div>
        </div>

        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-box stat-news">
                <i class="fas fa-newspaper stat-icon"></i>
                <h3>{{ $totalBerita }}</h3>
                <p>News</p>
            </div>
        </div>

        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-box stat-gallery">
                <i class="fas fa-images stat-icon"></i>
                <h3>{{ $totalGaleri }}</h3>
                <p>Galeri</p>
            </div>
        </div>

    </div>

    {{-- AKSES CEPAT --}}
    <div class="card-clean mb-5">

        <div class="card-head">
            <i class="fas fa-bolt"></i>
            <h6>Akses Cepat</h6>
        </div>

        <div class="card-body p-3">
            <div class="row g-3">

                <div class="col-6 col-md-4 col-xl-2">
                    <a href="{{ route('admin.school_profile') }}" class="quick-access-item">
                        <i class="fas fa-school"></i>
                        <span>Profil Sekolah</span>
                    </a>
                </div>

                <div class="col-6 col-md-4 col-xl-2">
                    <a href="{{ route('admin.users.index') }}" class="quick-access-item">
                        <i class="fas fa-user-gear"></i>
                        <span>Pengelola</span>
                    </a>
                </div>

                {{-- ✅ NEWS --}}
                <div class="col-6 col-md-4 col-xl-2">
                    <a href="{{ route('admin.news.index') }}" class="quick-access-item">
                        <i class="fas fa-newspaper"></i>
                        <span>News</span>
                    </a>
                </div>

                {{-- ✅ EXTRACURRICULAR --}}
                <div class="col-6 col-md-4 col-xl-2">
                    <a href="{{ route('admin.extracurricular.index') }}" class="quick-access-item">
                        <i class="fas fa-people-group"></i>
                        <span>Ekstrakurikuler</span>
                    </a>
                </div>

                <div class="col-6 col-md-4 col-xl-2">
                    <a href="{{ route('admin.guru') }}" class="quick-access-item">
                        <i class="fas fa-chalkboard"></i>
                        <span>Guru</span>
                    </a>
                </div>

                <div class="col-6 col-md-4 col-xl-2">
                    <a href="{{ route('admin.siswa') }}" class="quick-access-item">
                        <i class="fas fa-user-graduate"></i>
                        <span>Siswa</span>
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection