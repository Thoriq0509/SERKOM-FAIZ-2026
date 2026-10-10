@extends('landing.layout.home')

@section('title', 'Profil Sekolah - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.profile.css') }}">
@endpush

@section('content')

    {{-- Gambar Header --}}
    <section class="sejarah-hero">
        @if ($schoolProfile && $schoolProfile->foto)
            <img src="{{ asset('storage/' . $schoolProfile->foto) }}"
                 alt="Profil {{ $schoolProfile->nama_sekolah }}"
                 class="sejarah-hero-img">
        @else
            <img src="{{ asset('assets/landing/img-coba/fotosekolah.jpg') }}"
                 alt="Profil SMA Taruna Nusantara"
                 class="sejarah-hero-img">
        @endif
        <div class="sejarah-hero-overlay"></div>
        <div class="sejarah-hero-title">
            <h1>Profil Sekolah</h1>
        </div>
    </section>

    {{-- Info Sekolah --}}
    <section class="section-block">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Informasi Umum</span>
                <h2 class="section-title">Data Sekolah</h2>
                <p class="section-desc">Identitas dan kontak resmi sekolah.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-school"></i></div>
                        <div class="info-label">Nama Sekolah</div>
                        <div class="info-value">{{ $schoolProfile->nama_sekolah ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-id-card"></i></div>
                        <div class="info-label">NPSN</div>
                        <div class="info-value">{{ $schoolProfile->npsn ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-calendar"></i></div>
                        <div class="info-label">Tahun Berdiri</div>
                        <div class="info-value">{{ $schoolProfile->tahun_berdiri ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-user-tie"></i></div>
                        <div class="info-label">Kepala Sekolah</div>
                        <div class="info-value">{{ $schoolProfile->kepala_sekolah ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-phone"></i></div>
                        <div class="info-label">Telepon</div>
                        <div class="info-value">{{ $schoolProfile->kontak ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $schoolProfile->email ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-12" data-aos="fade-up">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-location-dot"></i></div>
                        <div class="info-label">Alamat</div>
                        <div class="info-value">{{ $schoolProfile->alamat ?? '—' }}</div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- Media Sosial --}}
    @if (!empty($schoolProfile?->facebook) || !empty($schoolProfile?->instagram) || !empty($schoolProfile?->whatsapp))
        <section class="section-block section-alt">
            <div class="container">

                <div class="section-header" data-aos="fade-up">
                    <span class="section-label">Terhubung dengan Kami</span>
                    <h2 class="section-title">Media Sosial</h2>
                    <p class="section-desc">Ikuti informasi terbaru sekolah melalui kanal resmi berikut.</p>
                </div>

                <div class="row g-4 justify-content-center">

                    @if (!empty($schoolProfile->facebook))
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                            <a href="{{ $schoolProfile->facebook }}"
                               target="_blank"
                               rel="noopener"
                               class="social-card facebook">
                                <div class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                                <div class="social-info">
                                    <div class="social-label">Facebook</div>
                                    <div class="social-value">Kunjungi Halaman</div>
                                </div>
                                <div class="social-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    @endif

                    @if (!empty($schoolProfile->instagram))
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ $schoolProfile->instagram }}"
                               target="_blank"
                               rel="noopener"
                               class="social-card instagram">
                                <div class="social-icon">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <div class="social-info">
                                    <div class="social-label">Instagram</div>
                                    <div class="social-value">Ikuti Akun</div>
                                </div>
                                <div class="social-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    @endif

                    @if (!empty($schoolProfile->whatsapp))
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $schoolProfile->whatsapp) }}"
                               target="_blank"
                               rel="noopener"
                               class="social-card whatsapp">
                                <div class="social-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <div class="social-info">
                                    <div class="social-label">WhatsApp</div>
                                    <div class="social-value">Hubungi Kami</div>
                                </div>
                                <div class="social-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    @endif

                </div>

            </div>
        </section>
    @endif

@endsection