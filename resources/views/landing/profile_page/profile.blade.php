@extends('landing.layout.home')

@section('title', 'Profil Sekolah - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.profile.css') }}">
@endpush

@section('content')

    {{-- Hero Header --}}
    <section class="profile-hero">
        <div class="container">
            <div class="profile-hero-content" data-aos="fade-up">
                <span class="profile-hero-label">Tentang Kami</span>
                <h1 class="profile-hero-title">Profil Sekolah</h1>
                <p class="profile-hero-desc">
                    Informasi umum mengenai SMA Taruna Nusantara — sekolah berasrama
                    penuh dengan semangat kenusantaraan.
                </p>
            </div>
        </div>
    </section>

    {{-- Info Sekolah --}}
    <section class="section-block">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Informasi Umum</span>
                <h2 class="section-title">Data Sekolah</h2>
                <p class="section-desc">Identitas dan kontak resmi SMA Taruna Nusantara.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-school"></i></div>
                        <div class="info-label">Nama Sekolah</div>
                        <div class="info-value">SMA Taruna Nusantara</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-id-card"></i></div>
                        <div class="info-label">NPSN</div>
                        <div class="info-value">20307641</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-calendar"></i></div>
                        <div class="info-label">Tahun Berdiri</div>
                        <div class="info-value">1990</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-user-tie"></i></div>
                        <div class="info-label">Kepala Sekolah</div>
                        <div class="info-value">Mayjen TNI Muhammad Imam Gogor Agnie Aditya</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-phone"></i></div>
                        <div class="info-label">Telepon</div>
                        <div class="info-value">(0293) 364195</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="info-label">Email</div>
                        <div class="info-value">info@smatn.sch.id</div>
                    </div>
                </div>

                <div class="col-12" data-aos="fade-up">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-location-dot"></i></div>
                        <div class="info-label">Alamat</div>
                        <div class="info-value">
                            Jl. Raya Magelang - Purworejo KM 5, Banyurojo, Kec. Mertoyudan,
                            Kabupaten Magelang, Jawa Tengah 56172
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection