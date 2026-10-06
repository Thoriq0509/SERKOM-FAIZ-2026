@extends('landing.layout.home')

@section('title', 'Visi & Misi - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.profile.css') }}">
@endpush

@section('content')

    {{-- Gambar Header --}}
    <section class="sejarah-hero">
        <img src="{{ asset('assets/landing/img-coba/fotosekolah.jpg') }}"
             alt="Visi Misi SMA Taruna Nusantara"
             class="sejarah-hero-img">
        <div class="sejarah-hero-overlay"></div>
        <div class="sejarah-hero-title">
            <h1>Visi &amp; Misi</h1>
        </div>
    </section>

    {{-- Isi Visi & Misi --}}
    <section class="sejarah-body">
        <div class="container">
            <div class="sejarah-body-content" data-aos="fade-up">

                {{-- Visi --}}
                <h2 class="vm-heading">Visi</h2>

                <p>
                    SMA Taruna Nusantara adalah Sekolah Menengah Atas Unggulan berciri
                    kenusantaraan, untuk membentuk pemimpin bangsa berkualitas dan
                    berkarakter yang berwawasan Kebangsaan, Kejuangan, Kebudayaan,
                    dengan bercirikan kenusantaraan serta memiliki daya saing Nasional
                    maupun Internasional dengan Pamong Pengajar Pengasuh dan Pamong
                    Administrasi berkualitas, dibangun dan disiapkan menjadi satu
                    kesatuan utuh dengan sarana dan prasarana serta fasilitas pendidikan
                    yang modern yang mampu mengembangkan siswa secara profesional
                    menjadi lulusan berkualitas tinggi yang siap berkompetisi di
                    tingkat nasional dan internasional.
                </p>

                {{-- Misi --}}
                <h2 class="vm-heading">Misi</h2>

                <div class="vm-list">
                    <p>1. Menyiapkan pemimpin bangsa yang beriman dan bertaqwa kepada Tuhan Yang Maha Esa.</p>
                    <p>2. Menyiapkan pemimpin bangsa yang berkarakter, berdisiplin, dan berjiwa kesatria.</p>
                    <p>3. Menyiapkan pemimpin bangsa yang cinta tanah air dan bangga sebagai bangsa Indonesia.</p>
                    <p>4. Menyiapkan pemimpin bangsa yang menguasai IPTEK dan mampu bersaing di era global.</p>
                    <p>5. Menyiapkan pemimpin bangsa yang memiliki keunggulan akademik, kepribadian, jasmani, dan wawasan kebangsaan.</p>
                </div>

            </div>
        </div>
    </section>

@endsection