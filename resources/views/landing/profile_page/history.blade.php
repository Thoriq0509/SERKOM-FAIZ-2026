@extends('landing.layout.home')

@section('title', 'Sejarah - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.profile.css') }}">
@endpush

@section('content')

    {{-- Gambar Header --}}
    <section class="sejarah-hero">
        @if ($schoolProfile && $schoolProfile->foto)
            <img src="{{ asset('storage/' . $schoolProfile->foto) }}"
                 alt="Sejarah {{ $schoolProfile->nama_sekolah }}"
                 class="sejarah-hero-img">
        @else
            <img src="{{ asset('assets/landing/img-coba/fotosekolah.jpg') }}"
                 alt="Sejarah SMA Taruna Nusantara"
                 class="sejarah-hero-img">
        @endif
        <div class="sejarah-hero-overlay"></div>
        <div class="sejarah-hero-title">
            <h1>Sejarah</h1>
        </div>
    </section>

    {{-- Teks Sejarah --}}
    <section class="sejarah-body">
        <div class="container">
            <div class="sejarah-body-content" data-aos="fade-up">

                @if ($schoolProfile && $schoolProfile->deskripsi)
                    {!! nl2br(e($schoolProfile->deskripsi)) !!}
                @else
                    <p class="text-muted">Belum ada data sejarah.</p>
                @endif

            </div>
        </div>
    </section>

@endsection