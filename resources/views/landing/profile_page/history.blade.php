@extends('landing.layout.home')

@section('title', 'Sejarah - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.profile.css') }}">
@endpush

@section('content')

    {{-- Gambar Header --}}
    <section class="sejarah-hero">
        <img src="{{ asset('assets/landing/img-coba/fotosekolah.jpg') }}"
             alt="Sejarah SMA Taruna Nusantara"
             class="sejarah-hero-img">
        <div class="sejarah-hero-overlay"></div>
        <div class="sejarah-hero-title">
            <h1>Sejarah</h1>
        </div>
    </section>

    {{-- Teks Sejarah --}}
    <section class="sejarah-body">
        <div class="container">
            <div class="sejarah-body-content" data-aos="fade-up">

                <p>
                    Ide pembuatan sekolah ini dicetuskan oleh <strong>Menteri Pertahanan
                    dan Keamanan</strong> saat itu, <strong>Jenderal TNI LB Moerdani</strong>
                    pada tanggal 20 Mei 1985 di Pendopo Agung Taman Siswa Yogyakarta.
                    Jenderal TNI LB Moerdani mempunyai visi untuk membangun sekolah
                    yang mendidik manusia-manusia terbaik dari seluruh Indonesia dan
                    menghasilkan lulusan yang dapat melanjutkan cita-cita para Proklamator.
                </p>

                <p>
                    Untuk merealisasikan ide ini, maka dibuatlah MoU / nota kesepahaman
                    antara TNI dan Taman Siswa. Perguruan Taman Siswa dipilih karena
                    merupakan organisasi kependidikan pertama di Indonesia.
                </p>

                <p>
                    SMA Taruna Nusantara Magelang adalah sekolah menengah atas berasrama
                    penuh (<em>boarding school</em>) berstandar nasional dengan sistem
                    semi-militer yang terletak di Mertoyudan, Magelang, Jawa Tengah.
                    Didirikan pada tahun <strong>1990</strong>, sekolah ini mengemban
                    amanah untuk membentuk kader pemimpin bangsa yang tangguh,
                    berdisiplin, dan cinta tanah air — dengan semangat
                    <strong>kenusantaraan</strong> yang menjadi ciri khasnya.
                </p>

                <p>
                    Hingga kini, SMA Taruna Nusantara terus berkomitmen menghasilkan
                    lulusan yang unggul di bidang akademik, kepribadian, jasmani,
                    dan wawasan kebangsaan.
                </p>

            </div>
        </div>
    </section>

@endsection