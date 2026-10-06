@extends('landing.layout.home')

@section('title', 'Beranda - SMA Taruna Nusantara')

@section('content')

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

                            {{-- Foto Kepsek --}}
                            <div class="col-md-4">
                                <div class="sambutan-photo-wrap">
                                    <img src="{{ asset('assets/landing/img-coba/kepalasekolah.jpg') }}"
                                         alt="Foto Kepala Sekolah"
                                         class="sambutan-photo">
                                </div>
                            </div>

                            {{-- Teks Sambutan --}}
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

    {{-- Profil Sekolah --}}
    <section class="section-block section-alt">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Tentang Kami</span>
                <h2 class="section-title">Profil Sekolah</h2>
                <p class="section-desc">Sekilas tentang SMA Taruna Nusantara.</p>
            </div>

            <div class="row g-5 align-items-center">

                {{-- Gambar Gedung --}}
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="gedung-wrap">
                        <img src="{{ asset('assets/landing/img-coba/gedung.jpg') }}"
                             alt="Gedung Sekolah"
                             class="gedung-img">
                    </div>
                </div>

                {{-- Info Profil --}}
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="profil-content">

                        <span class="profil-label">SMA Taruna Nusantara</span>

                        <h3 class="profil-heading">
                            Sekolah Berasrama dengan Semangat Kenusantaraan
                        </h3>

                        <div class="profil-divider"></div>

                        <p class="profil-text">
                            SMA Taruna Nusantara Magelang adalah sekolah menengah atas
                            berasrama penuh (<em>boarding school</em>) berstandar nasional
                            dengan sistem semi-militer yang terletak di Mertoyudan,
                            Magelang, Jawa Tengah.
                        </p>

                        {{-- Info List --}}
                        <ul class="profil-info">
                            <li>
                                <i class="fas fa-school"></i>
                                <div>
                                    <span>Nama Sekolah</span>
                                    <strong>SMA Taruna Nusantara</strong>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-id-card"></i>
                                <div>
                                    <span>NPSN</span>
                                    <strong>20307641</strong>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-calendar"></i>
                                <div>
                                    <span>Tahun Berdiri</span>
                                    <strong>1990</strong>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-location-dot"></i>
                                <div>
                                    <span>Alamat</span>
                                    <strong>Mertoyudan, Magelang, Jawa Tengah</strong>
                                </div>
                            </li>
                        </ul>

                        <a href="{{ route('landing.profile') }}" class="profil-btn">
                            Lihat Profil Lengkap <i class="fas fa-arrow-right ms-1"></i>
                        </a>

                    </div>
                </div>

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

                {{-- Berita 1 --}}
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
                            <a href="#" class="news-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>

                {{-- Berita 2 --}}
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
                            <a href="#" class="news-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>

                {{-- Berita 3 --}}
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
                            <a href="#" class="news-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>

            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('landing.news') }}" class="profil-btn">
                    Lihat Semua Berita <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

        </div>
    </section>

@endsection