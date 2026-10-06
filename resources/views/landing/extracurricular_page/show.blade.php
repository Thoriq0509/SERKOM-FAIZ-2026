@extends('landing.layout.home')

@section('title', $extracurricular['nama'] . ' - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.extracurricular.css') }}">
@endpush

@section('content')

    {{-- Hero Header --}}
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content" data-aos="fade-up">
                <span class="page-hero-label">Ekstrakurikuler</span>
                <h1 class="page-hero-title">Detail Ekskul</h1>
                <p class="page-hero-desc">
                    Informasi lengkap kegiatan ekstrakurikuler SMA Taruna Nusantara.
                </p>
            </div>
        </div>
    </section>

    {{-- Detail Ekstrakurikuler --}}
    <section class="section-block">
        <div class="container">

            <div class="row g-5 align-items-start justify-content-center">

                {{-- Foto --}}
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="eskul-detail-photo-wrap">
                        <div class="eskul-detail-photo-empty">
                            <i class="fas fa-people-group"></i>
                        </div>
                    </div>
                </div>

                {{-- Info --}}
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="eskul-detail-content">

                        <span class="eskul-detail-label">Ekstrakurikuler</span>

                        <h2 class="eskul-detail-name">{{ $extracurricular['nama'] }}</h2>

                        <div class="eskul-detail-divider"></div>

                        <ul class="eskul-detail-info">
                            <li>
                                <span>Pembina</span>
                                <strong>{{ $extracurricular['pembina'] ?? '—' }}</strong>
                            </li>
                            <li>
                                <span>Jadwal Latihan</span>
                                <strong>{{ $extracurricular['jadwal'] ?? '—' }}</strong>
                            </li>
                        </ul>

                        @if (!empty($extracurricular['deskripsi']))
                            <p class="eskul-detail-desc">
                                {{ $extracurricular['deskripsi'] }}
                            </p>
                        @endif

                        <a href="{{ route('landing.extracurricular') }}" class="eskul-detail-btn">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection