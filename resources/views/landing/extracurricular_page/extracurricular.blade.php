@extends('landing.layout.home')

@section('title', 'Ekstrakurikuler - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.extracurricular.css') }}">
@endpush

@section('content')

    {{-- Hero Header --}}
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content" data-aos="fade-up">
                <span class="page-hero-label">Kegiatan Siswa</span>
                <h1 class="page-hero-title">Ekstrakurikuler</h1>
                <p class="page-hero-desc">
                    Wadah pengembangan bakat, minat, dan karakter taruna-taruni.
                </p>
            </div>
        </div>
    </section>

    {{-- Grid Ekstrakurikuler --}}
    <section class="section-block">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Daftar Ekskul</span>
                <h2 class="section-title">Pilihan Ekstrakurikuler</h2>
                <p class="section-desc">Berbagai kegiatan untuk mengembangkan potensi siswa.</p>
            </div>

            @php
                $extracurriculars = [
                    ['nama' => 'Karate',                      'pembina' => 'Letkol Kav. Hendra Wijaya, S.E.', 'jadwal' => 'Senin & Kamis, 15.00'],
                    ['nama' => 'Pencak Silat',                'pembina' => 'Rudi Hartono, S.Pd.',             'jadwal' => 'Selasa & Jumat, 15.00'],
                    ['nama' => 'Taekwondo',                   'pembina' => 'Kapten Inf. Andi Saputra',        'jadwal' => 'Rabu & Sabtu, 15.00'],
                    ['nama' => 'Sepak Bola',                  'pembina' => 'Rudi Hartono, S.Pd.',             'jadwal' => 'Senin & Rabu, 16.00'],
                    ['nama' => 'Bola Basket',                 'pembina' => 'Ir. Joko Widodo, M.T.',           'jadwal' => 'Selasa & Kamis, 16.00'],
                    ['nama' => 'Bola Voli',                   'pembina' => 'Ir. Hendra Gunawan',              'jadwal' => 'Rabu & Jumat, 16.00'],
                    ['nama' => 'Renang',                      'pembina' => 'Rudi Hartono, S.Pd.',             'jadwal' => 'Sabtu, 08.00'],
                    ['nama' => 'Bulu Tangkis',                'pembina' => 'Drs. H. Ahmad Suryadi, M.Pd.',    'jadwal' => 'Senin & Jumat, 15.30'],
                    ['nama' => 'Tenis Meja',                  'pembina' => 'Rina Kartika Sari, S.Pd.',        'jadwal' => 'Selasa & Kamis, 15.30'],
                    ['nama' => 'Panahan',                     'pembina' => 'Letkol Inf. Surya Pratama',       'jadwal' => 'Rabu & Sabtu, 15.00'],
                    ['nama' => 'Drumband',                    'pembina' => 'Maya Sari, S.Pd.',                'jadwal' => 'Selasa & Sabtu, 14.00'],
                    ['nama' => 'Seni Musik',                  'pembina' => 'Maya Sari, S.Pd.',                'jadwal' => 'Senin & Kamis, 16.00'],
                    ['nama' => 'Seni Tari',                   'pembina' => 'Dra. Siti Nurhaliza, M.Pd.',      'jadwal' => 'Rabu & Jumat, 16.00'],
                    ['nama' => 'KIR',                         'pembina' => 'Fitriani, S.Kom.',                'jadwal' => 'Selasa, 14.00'],
                    ['nama' => 'Kepemimpinan & Karakter',     'pembina' => 'Kolonel Inf. Bambang Prasetyo',   'jadwal' => 'Sabtu, 09.00'],
                    ['nama' => 'Wawasan Kebangsaan',          'pembina' => 'Letkol Kav. Hendra Wijaya, S.E.', 'jadwal' => 'Jumat, 14.00'],
                    ['nama' => 'Keterampilan Lapangan',       'pembina' => 'Kapten Inf. Andi Saputra',        'jadwal' => 'Minggu, 07.00'],
                    ['nama' => 'Paskibra',                    'pembina' => 'Letkol Inf. Surya Pratama',       'jadwal' => 'Senin, Rabu, Jumat, 15.00'],
                ];
            @endphp

            <div class="row g-4">

                @foreach ($extracurriculars as $index => $ekskul)
                    <div class="col-6 col-md-4 col-lg-3"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($index % 4) * 100 }}">

                        <a href="{{ url('/extracurricular/' . $index) }}"
                           class="eskul-card-link">

                            <div class="eskul-card">

                                <div class="eskul-photo-wrap">
                                    <div class="eskul-photo-empty">
                                        <i class="fas fa-people-group"></i>
                                    </div>
                                </div>

                                <div class="eskul-body">
                                    <h5 class="eskul-name">{{ $ekskul['nama'] }}</h5>

                                    <div class="eskul-pembina">
                                        <i class="fas fa-user-tie"></i>
                                        {{ $ekskul['pembina'] }}
                                    </div>

                                    <div class="eskul-jadwal">
                                        <i class="far fa-clock"></i>
                                        {{ $ekskul['jadwal'] }}
                                    </div>
                                </div>

                            </div>

                        </a>
                    </div>
                @endforeach

            </div>

        </div>
    </section>

@endsection