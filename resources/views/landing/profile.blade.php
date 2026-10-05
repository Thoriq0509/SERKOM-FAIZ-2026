@extends('landing.layout.home')

@section('title', 'Profil Sekolah - SMA Taruna Nusantara')

@section('content')

    {{-- Header --}}
    <section class="section-block pt-5">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Tentang Kami</span>
                <h2 class="section-title">Profil Sekolah</h2>
                <p class="section-desc">
                    Informasi umum mengenai SMA Taruna Nusantara.
                </p>
            </div>
        </div>
    </section>

    {{-- Info Sekolah --}}
    <section class="section-block pt-0">
        <div class="container">
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

    {{-- Visi & Misi --}}
    <section class="section-block section-alt">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Arah & Tujuan</span>
                <h2 class="section-title">Visi &amp; Misi</h2>
            </div>

            <div class="row g-4">

                <div class="col-lg-6" data-aos="fade-right">
                    <div class="visi-card">
                        <div class="visi-head">
                            <i class="fas fa-bullseye"></i>
                            <span>Visi</span>
                        </div>
                        <p>
                            Membangun lembaga pendidikan yang menghasilkan kader pemimpin
                            berkualitas dengan ciri kenusantaraan dan daya saing tinggi.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="visi-card">
                        <div class="visi-head">
                            <i class="fas fa-list-check"></i>
                            <span>Misi</span>
                        </div>
                        <p>
                            Menyiapkan kader pemimpin yang bertakwa, berkarakter,
                            setia kepada NKRI berdasarkan Pancasila dan UUD 1945,
                            berwawasan kebangsaan, serta memiliki keunggulan akademik,
                            kepribadian, jasmani, dan IPTEK.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Sejarah --}}
    <section class="section-block">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Perjalanan Kami</span>
                <h2 class="section-title">Sejarah Singkat</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="fade-up">
                    <div class="sejarah-card">
                        <p>
                            SMA Taruna Nusantara Magelang adalah sekolah menengah atas
                            berasrama penuh (<em>boarding school</em>) berstandar nasional
                            dengan sistem semi-militer yang terletak di Mertoyudan,
                            Magelang, Jawa Tengah.
                        </p>
                        <p>
                            Didirikan pada tahun <strong>1990</strong>, sekolah ini
                            mengemban amanah untuk membentuk kader pemimpin bangsa
                            yang tangguh, berdisiplin, dan cinta tanah air — dengan
                            semangat <strong>kenusantaraan</strong> yang menjadi ciri khasnya.
                        </p>
                        <p>
                            Hingga kini, SMA Taruna Nusantara terus berkomitmen
                            menghasilkan lulusan yang unggul di bidang akademik,
                            kepribadian, jasmani, dan wawasan kebangsaan.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection