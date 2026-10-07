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

            <div class="row g-4">

                @forelse ($extracurriculars as $index => $ekskul)
                    <div class="col-6 col-md-4 col-lg-3"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($index % 4) * 100 }}">

                        <a href="{{ route('landing.extracurricular.show', $ekskul) }}"
                           class="eskul-card-link">

                            <div class="eskul-card">

                                <div class="eskul-photo-wrap">
                                    @if ($ekskul->gambar)
                                        <img src="{{ asset('storage/' . $ekskul->gambar) }}"
                                             alt="{{ $ekskul->nama_ekskul }}"
                                             class="eskul-photo">
                                    @else
                                        <div class="eskul-photo-empty">
                                            <i class="fas fa-people-group"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="eskul-body">
                                    <h5 class="eskul-name">{{ $ekskul->nama_ekskul }}</h5>

                                    <div class="eskul-pembina">
                                        <i class="fas fa-user-tie"></i>
                                        {{ $ekskul->pembina->nama_guru ?? '-' }}
                                    </div>

                                    <div class="eskul-jadwal">
                                        <i class="far fa-clock"></i>
                                        {{ $ekskul->jadwal_latihan ?? '-' }}
                                    </div>
                                </div>

                            </div>

                        </a>
                    </div>

                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada data ekstrakurikuler.</p>
                    </div>
                @endforelse

            </div>

        </div>
    </section>

@endsection