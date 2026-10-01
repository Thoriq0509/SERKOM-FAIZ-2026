@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dashboard.css') }}">
@endpush

@section('content')

<div class="container-fluid p-0">

    <!-- Profile header -->
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

    <!-- Statistik -->
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

    <!-- Akses cepat -->
    <div class="card-clean mb-5">

        <div class="card-head">
            <h6><i class="fas fa-bolt me-2"></i>Akses Cepat</h6>
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

                <div class="col-6 col-md-4 col-xl-2">
                    <a href="{{ route('admin.news.index') }}" class="quick-access-item">
                        <i class="fas fa-newspaper"></i>
                        <span>Berita</span>
                    </a>
                </div>

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

                {{-- Baris kedua --}}
                <div class="col-6 col-md-4 col-xl-2">
                    <a href="{{ route('admin.gallery.index') }}" class="quick-access-item">
                        <i class="fas fa-images"></i>
                        <span>Galeri</span>
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection