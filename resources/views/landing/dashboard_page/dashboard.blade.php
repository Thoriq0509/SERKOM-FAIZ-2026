@extends('landing.layout.home')

@section('title', 'Beranda - SMA Taruna Nusantara')

@section('content')

    {{-- Carousel --}}
    <section class="hero-carousel">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img src="{{ asset('assets/landing/img-coba/fotosekolah.jpg') }}"
                         alt="Slide 1"
                         class="carousel-img">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption-custom">
                        <span class="carousel-label">Selamat Datang</span>
                        <h2 class="carousel-title">SMA Taruna Nusantara</h2>
                        <p class="carousel-desc">
                            Membangun generasi unggul, berkarakter, dan berprestasi
                            dengan semangat kenusantaraan.
                        </p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('assets/landing/img-coba/carousel1.png') }}"
                         alt="Slide 2"
                         class="carousel-img">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption-custom">
                        <span class="carousel-label">Pendidikan</span>
                        <h2 class="carousel-title">Sekolah Berasrama Penuh</h2>
                        <p class="carousel-desc">
                            Sistem pendidikan semi-militer dengan standar nasional
                            untuk membentuk kader pemimpin bangsa.
                        </p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('assets/landing/img-coba/carousel2.png') }}"
                         alt="Slide 3"
                         class="carousel-img">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption-custom">
                        <span class="carousel-label">Prestasi</span>
                        <h2 class="carousel-title">Mencetak Generasi Berprestasi</h2>
                        <p class="carousel-desc">
                            Raih prestasi akademik dan non-akademik di tingkat
                            nasional maupun internasional.
                        </p>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button"
                    data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button"
                    data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Berikutnya</span>
            </button>

        </div>
    </section>

    {{-- Sambutan Kepala Sekolah --}}
    <section class="section-block">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Sambutan</span>
                <h2 class="section-title">Sambutan Kepala Sekolah</h2>
                <p class="section-desc">Komitmen kami untuk pendidikan generasi bangsa.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="sambutan-card" data-aos="fade-up">

                        <div class="row g-0 align-items-center">

                            <div class="col-md-4">
                                <div class="sambutan-photo-wrap">
                                    <img src="{{ asset('assets/landing/img-coba/kepalasekolah.jpg') }}"
                                         alt="Foto Kepala Sekolah"
                                         class="sambutan-photo">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="sambutan-body">

                                    <span class="sambutan-label">Komitmen Kami untuk Pendidikan</span>

                                    <h3 class="sambutan-heading">
                                        Membangun Generasi Unggul &amp; Berkarakter
                                    </h3>

                                    <div class="sambutan-divider"></div>

                                    <div class="sambutan-text">
                                        <p>
                                            Assalamualaikum warahmatullahi wabarakatuh. Selamat datang
                                            di website resmi SMA Taruna Nusantara — sekolah yang
                                            menjunjung tinggi disiplin, ketegasan, dan semangat
                                            kenusantaraan dalam membentuk generasi muda yang berilmu,
                                            berkarakter, dan cinta tanah air.
                                        </p>
                                        <p class="mb-0">
                                            Wassalamualaikum warahmatullahi wabarakatuh.
                                        </p>
                                    </div>

                                    <div class="sambutan-author">
                                        <h5>Mayjen TNI Muhammad Imam Gogor Agnie Aditya</h5>
                                        <span>Kepala Sekolah</span>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Profil Sekolah — Split --}}
    <section class="section-split-profil">
        <div class="row g-0 align-items-stretch">

            {{-- Kiri: Navy + Teks --}}
            <div class="col-lg-6 split-left">
                <div class="split-left-inner" data-aos="fade-right">

                    <span class="split-label">Tentang Kami</span>

                    <h2 class="split-heading">SMA Taruna Nusantara</h2>

                    <div class="split-divider"></div>

                    <p class="split-text">
                        Sekolah menengah atas berasrama penuh (<em>boarding school</em>)
                        berstandar nasional dengan sistem semi-militer yang terletak
                        di Mertoyudan, Magelang, Jawa Tengah. Didirikan pada tahun 1990
                        untuk membentuk kader pemimpin bangsa.
                    </p>

                    <ul class="split-info">
                        <li>
                            <span>NPSN</span>
                            <strong>20307641</strong>
                        </li>
                        <li>
                            <span>Tahun Berdiri</span>
                            <strong>1990</strong>
                        </li>
                        <li>
                            <span>Lokasi</span>
                            <strong>Magelang, Jawa Tengah</strong>
                        </li>
                    </ul>

                    <a href="{{ route('landing.profile') }}" class="split-btn">
                        Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                    </a>

                </div>
            </div>

            {{-- Kanan: Gambar Gedung --}}
            <div class="col-lg-6 split-right" data-aos="fade-left">
                <img src="{{ asset('assets/landing/img-coba/fotosekolah.jpg') }}"
                     alt="Gedung SMA Taruna Nusantara"
                     class="split-img">
            </div>

        </div>
    </section>

    {{-- Berita Terbaru --}}
    <section class="section-block">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Informasi Terkini</span>
                <h2 class="section-title">Berita Terbaru</h2>
                <p class="section-desc">Ikuti kabar dan kegiatan terbaru dari sekolah kami.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <article class="news-card">
                        <div class="news-thumb">
                            <div class="news-thumb-empty"><i class="fas fa-newspaper"></i></div>
                        </div>
                        <div class="news-body">
                            <div class="news-date">
                                <i class="far fa-calendar"></i> 17 Agustus 2025
                            </div>
                            <h5 class="news-title">Upacara Peringatan HUT Kemerdekaan RI ke-80</h5>
                            <p class="news-excerpt">
                                Seluruh taruna dan taruni mengikuti upacara peringatan
                                HUT Kemerdekaan RI ke-80 dengan khidmat...
                            </p>
                            <a href="{{ route('landing.news') }}" class="news-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <article class="news-card">
                        <div class="news-thumb">
                            <div class="news-thumb-empty"><i class="fas fa-newspaper"></i></div>
                        </div>
                        <div class="news-body">
                            <div class="news-date">
                                <i class="far fa-calendar"></i> 5 September 2025
                            </div>
                            <h5 class="news-title">Taruna Raih Medali Emas Olimpiade Sains Nasional 2025</h5>
                            <p class="news-excerpt">
                                Membanggakan! Salah satu taruna terbaik berhasil meraih
                                medali emas pada ajang OSN 2025...
                            </p>
                            <a href="{{ route('landing.news') }}" class="news-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <article class="news-card">
                        <div class="news-thumb">
                            <div class="news-thumb-empty"><i class="fas fa-newspaper"></i></div>
                        </div>
                        <div class="news-body">
                            <div class="news-date">
                                <i class="far fa-calendar"></i> 12 September 2025
                            </div>
                            <h5 class="news-title">Kunjungan Studi Banding dari SMA Negeri 1 Yogyakarta</h5>
                            <p class="news-excerpt">
                                SMA Taruna Nusantara menerima kunjungan studi banding
                                dari SMA Negeri 1 Yogyakarta...
                            </p>
                            <a href="{{ route('landing.news') }}" class="news-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>

            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('landing.news') }}" class="profil-btn">
                    Lihat Semua Berita <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

        </div>
    </section>

    {{-- Galeri Terbaru --}}
    <section class="section-block section-alt">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Dokumentasi</span>
                <h2 class="section-title">Galeri Terbaru</h2>
                <p class="section-desc">Kumpulan foto dan video kegiatan sekolah.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="gallery-card">
                        <div class="gallery-thumb">
                            <div class="gallery-thumb-empty"><i class="fas fa-image"></i></div>
                            <span class="gallery-badge">Foto</span>
                        </div>
                        <div class="gallery-body">
                            <h5 class="gallery-title">Upacara HUT RI ke-80</h5>
                            <div class="gallery-date">
                                <i class="far fa-calendar"></i> 17 Agustus 2025
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="gallery-card">
                        <div class="gallery-thumb">
                            <div class="gallery-thumb-empty"><i class="fas fa-video"></i></div>
                            <span class="gallery-badge video">Video</span>
                        </div>
                        <div class="gallery-body">
                            <h5 class="gallery-title">Profil SMA Taruna Nusantara</h5>
                            <div class="gallery-date">
                                <i class="far fa-calendar"></i> 1 Juli 2025
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="gallery-card">
                        <div class="gallery-thumb">
                            <div class="gallery-thumb-empty"><i class="fas fa-image"></i></div>
                            <span class="gallery-badge">Foto</span>
                        </div>
                        <div class="gallery-body">
                            <h5 class="gallery-title">Latihan Paskibra</h5>
                            <div class="gallery-date">
                                <i class="far fa-calendar"></i> 10 Agustus 2025
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="gallery-card">
                        <div class="gallery-thumb">
                            <div class="gallery-thumb-empty"><i class="fas fa-image"></i></div>
                            <span class="gallery-badge">Foto</span>
                        </div>
                        <div class="gallery-body">
                            <h5 class="gallery-title">Kunjungan Studi Banding</h5>
                            <div class="gallery-date">
                                <i class="far fa-calendar"></i> 12 September 2025
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="gallery-card">
                        <div class="gallery-thumb">
                            <div class="gallery-thumb-empty"><i class="fas fa-video"></i></div>
                            <span class="gallery-badge video">Video</span>
                        </div>
                        <div class="gallery-body">
                            <h5 class="gallery-title">Liputan HUT RI ke-80</h5>
                            <div class="gallery-date">
                                <i class="far fa-calendar"></i> 17 Agustus 2025
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="gallery-card">
                        <div class="gallery-thumb">
                            <div class="gallery-thumb-empty"><i class="fas fa-image"></i></div>
                            <span class="gallery-badge">Foto</span>
                        </div>
                        <div class="gallery-body">
                            <h5 class="gallery-title">Lomba Cerdas Cermat</h5>
                            <div class="gallery-date">
                                <i class="far fa-calendar"></i> 25 September 2025
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('landing.gallery') }}" class="profil-btn">
                    Lihat Semua Galeri <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

        </div>
    </section>

@endsection