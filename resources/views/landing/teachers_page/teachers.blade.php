@extends('landing.layout.home')

@section('title', 'Guru - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.teachers.css') }}">
@endpush

@section('content')

    {{-- Hero Header --}}
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content" data-aos="fade-up">
                <span class="page-hero-label">Tenaga Pendidik</span>
                <h1 class="page-hero-title">Guru &amp; Pembina</h1>
                <p class="page-hero-desc">
                    Para pendidik yang berdedikasi membentuk kader pemimpin bangsa.
                </p>
            </div>
        </div>
    </section>

    {{-- Grid Guru --}}
    <section class="section-block">
        <div class="container">

            <div class="section-header" data-aos="fade-up">
                <span class="section-label">Daftar Guru</span>
                <h2 class="section-title">Tenaga Pengajar</h2>
                <p class="section-desc">Guru-guru yang mengabdi di SMA Taruna Nusantara.</p>
            </div>

            @php
                $teachers = [
                    ['nama' => 'Drs. H. Ahmad Suryadi, M.Pd.',   'mapel' => 'Matematika'],
                    ['nama' => 'Kolonel Inf. Bambang Prasetyo',  'mapel' => 'PKn'],
                    ['nama' => 'Dra. Siti Nurhaliza, M.Pd.',     'mapel' => 'Bahasa Indonesia'],
                    ['nama' => 'Ir. Joko Widodo, M.T.',          'mapel' => 'Fisika'],
                    ['nama' => 'Drs. Muhammad Yusuf, M.Ag.',     'mapel' => 'Pendidikan Agama Islam'],
                    ['nama' => 'Rina Kartika Sari, S.Pd.',       'mapel' => 'Matematika'],
                    ['nama' => 'Andi Prasetyo, S.Kom.',          'mapel' => 'Informatika'],
                    ['nama' => 'Dewi Lestari, S.Pd., M.Pd.',     'mapel' => 'Bahasa Inggris'],
                    ['nama' => 'Letkol Kav. Hendra Wijaya, S.E.','mapel' => 'Sejarah'],
                    ['nama' => 'Maya Anggraini, S.Pd.',          'mapel' => 'Biologi'],
                    ['nama' => 'Drs. Bambang Sutejo, M.Pd.',     'mapel' => 'Kimia'],
                    ['nama' => 'Sri Wahyuni, S.Pd.',             'mapel' => 'Matematika'],
                ];
            @endphp

            <div class="row g-4">

                @foreach ($teachers as $index => $teacher)
                    <div class="col-6 col-md-4 col-lg-3"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($index % 4) * 100 }}">

                        <a href="{{ url('/teachers/' . $index) }}"
                           class="teacher-card-link">

                            <div class="teacher-card">

                                <div class="teacher-photo-wrap">
                                    <div class="teacher-photo-empty">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                </div>

                                <div class="teacher-body">
                                    <h5 class="teacher-name">{{ $teacher['nama'] }}</h5>
                                    <div class="teacher-mapel">{{ $teacher['mapel'] }}</div>
                                </div>

                            </div>

                        </a>
                    </div>
                @endforeach

            </div>

        </div>
    </section>

@endsection