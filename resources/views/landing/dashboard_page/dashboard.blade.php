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

                            {{-- Foto Kepsek --}}
                            <div class="col-md-4">
                                <div class="sambutan-photo-wrap">
                                    @if ($schoolProfile && $schoolProfile->foto_kepsek)
                                        <img src="{{ asset('storage/' . $schoolProfile->foto_kepsek) }}"
                                             alt="Foto Kepala Sekolah"
                                             class="sambutan-photo">
                                    @else
                                        <img src="{{ asset('assets/landing/img-coba/kepalasekolah.jpg') }}"
                                             alt="Foto Kepala Sekolah"
                                             class="sambutan-photo">
                                    @endif
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
                                        {!! nl2br(e($schoolProfile->sambutan_kepsek ?? 'Selamat datang di website resmi sekolah.')) !!}
                                    </div>

                                    <div class="sambutan-author">
                                        <h5>{{ $schoolProfile->kepala_sekolah ?? 'Kepala Sekolah' }}</h5>
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

            {{-- KIRI: Gambar Gedung --}}
            <div class="col-lg-6 split-left-img" data-aos="fade-right">
                @if ($schoolProfile && $schoolProfile->foto)
                    <img src="{{ asset('storage/' . $schoolProfile->foto) }}"
                         alt="Gedung {{ $schoolProfile->nama_sekolah }}"
                         class="split-img">
                @else
                    <img src="{{ asset('assets/landing/img-coba/fotosekolah.jpg') }}"
                         alt="Gedung Sekolah"
                         class="split-img">
                @endif
            </div>

            {{-- KANAN: Navy + Teks --}}
            <div class="col-lg-6 split-right-content">
                <div class="split-content-inner" data-aos="fade-left">

                    <span class="split-label">Tentang Kami</span>

                    <h2 class="split-heading">
                        {{ $schoolProfile->nama_sekolah ?? 'SMA Taruna Nusantara' }}
                    </h2>

                    <div class="split-divider"></div>

                    {{-- Deskripsi STATIS --}}
                    <p class="split-text">
                        Sekolah menengah atas berasrama penuh (<em>boarding school</em>)
                        berstandar nasional dengan sistem semi-militer yang terletak
                        di Mertoyudan, Magelang, Jawa Tengah. Didirikan untuk
                        membentuk kader pemimpin bangsa.
                    </p>

                    {{-- Info DINAMIS --}}
                    <ul class="split-info">
                        <li>
                            <span>NPSN</span>
                            <strong>{{ $schoolProfile->npsn ?? '—' }}</strong>
                        </li>
                        <li>
                            <span>Tahun Berdiri</span>
                            <strong>{{ $schoolProfile->tahun_berdiri ?? '—' }}</strong>
                        </li>
                        <li>
                            <span>Lokasi</span>
                            <strong>{{ $schoolProfile->alamat ?? 'Magelang, Jawa Tengah' }}</strong>
                        </li>
                    </ul>

                    <a href="{{ route('landing.profile') }}" class="split-btn">
                        Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                    </a>

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

                @forelse ($news as $index => $item)
                    <div class="col-md-6 col-lg-4"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($index % 3) * 100 }}">

                        <article class="news-card">

                            <div class="news-thumb">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         alt="{{ $item->judul }}"
                                         class="news-thumb-img">
                                @else
                                    <div class="news-thumb-empty">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="news-body">
                                <div class="news-date">
                                    <i class="far fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                </div>

                                <h5 class="news-title">{{ $item->judul }}</h5>

                                <p class="news-excerpt">
                                    {{ Str::limit(strip_tags($item->isi), 120) }}
                                </p>

                                <a href="{{ url('/news/' . $item->id) }}" class="news-link">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>

                        </article>
                    </div>

                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada berita.</p>
                    </div>
                @endforelse

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

                @forelse ($galleries as $index => $item)
                    <div class="col-md-6 col-lg-4"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($index % 3) * 100 }}">

                        <div class="gallery-card">

                            <div class="gallery-thumb">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         alt="{{ $item->judul }}"
                                         class="gallery-img">
                                @else
                                    <div class="gallery-thumb-empty">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif

                                <span class="gallery-badge {{ strtolower($item->kategori) }}">
                                    {{ $item->kategori }}
                                </span>
                            </div>

                            <div class="gallery-body">
                                <h5 class="gallery-title">{{ $item->judul }}</h5>
                                <div class="gallery-date">
                                    <i class="far fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                </div>
                            </div>

                        </div>
                    </div>

                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada galeri.</p>
                    </div>
                @endforelse

            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('landing.gallery') }}" class="profil-btn">
                    Lihat Semua Galeri <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

        </div>
    </section>

@endsection