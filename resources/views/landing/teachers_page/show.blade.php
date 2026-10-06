@extends('landing.layout.home')

@section('title', $teacher['nama'] . ' - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.teachers.css') }}">
@endpush

@section('content')

    {{-- Hero Header --}}
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content" data-aos="fade-up">
                <span class="page-hero-label">Profil Guru</span>
                <h1 class="page-hero-title">Detail Guru</h1>
                <p class="page-hero-desc">
                    Informasi lengkap tenaga pendidik SMA Taruna Nusantara.
                </p>
            </div>
        </div>
    </section>

    {{-- Detail Guru --}}
    <section class="section-block">
        <div class="container">

            <div class="row g-5 align-items-start justify-content-center">

                {{-- Foto --}}
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="teacher-detail-photo-wrap">
                        <div class="teacher-detail-photo-empty">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                </div>

                {{-- Info --}}
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="teacher-detail-content">

                        <span class="teacher-detail-label">Tenaga Pendidik</span>

                        <h2 class="teacher-detail-name">{{ $teacher['nama'] }}</h2>

                        <div class="teacher-detail-divider"></div>

                        <ul class="teacher-detail-info">
                            <li>
                                <span>NIP</span>
                                <strong>{{ $teacher['nip'] ?? '—' }}</strong>
                            </li>
                            <li>
                                <span>Mata Pelajaran</span>
                                <strong>{{ $teacher['mapel'] ?? '—' }}</strong>
                            </li>
                            <li>
                                <span>Email</span>
                                <strong>{{ $teacher['email'] ?? '—' }}</strong>
                            </li>
                        </ul>

                        <a href="{{ route('landing.teachers') }}" class="teacher-detail-btn">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection