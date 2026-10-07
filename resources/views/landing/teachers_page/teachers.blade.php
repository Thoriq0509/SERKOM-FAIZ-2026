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

            <div class="row g-4">

                @forelse ($teachers as $index => $teacher)
                    <div class="col-6 col-md-4 col-lg-3"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($index % 4) * 100 }}">

                        <a href="{{ route('landing.teachers.show', $teacher) }}"
                           class="teacher-card-link">

                            <div class="teacher-card">

                                <div class="teacher-photo-wrap">
                                    @if ($teacher->foto)
                                        <img src="{{ asset('storage/' . $teacher->foto) }}"
                                             alt="{{ $teacher->nama_guru }}"
                                             class="teacher-photo">
                                    @else
                                        <div class="teacher-photo-empty">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="teacher-body">
                                    <h5 class="teacher-name">{{ $teacher->nama_guru }}</h5>
                                    <div class="teacher-mapel">{{ $teacher->mapel ?? '-' }}</div>
                                </div>

                            </div>

                        </a>
                    </div>

                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada data guru.</p>
                    </div>
                @endforelse

            </div>

        </div>
    </section>

@endsection