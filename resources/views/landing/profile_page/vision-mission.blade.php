@extends('landing.layout.home')

@section('title', 'Visi & Misi - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.profile.css') }}">
@endpush

@section('content')

    {{-- Gambar Header --}}
    <section class="sejarah-hero">
        @if ($schoolProfile && $schoolProfile->foto)
            <img src="{{ asset('storage/' . $schoolProfile->foto) }}"
                 alt="Visi Misi {{ $schoolProfile->nama_sekolah }}"
                 class="sejarah-hero-img">
        @else
            <img src="{{ asset('assets/landing/img-coba/fotosekolah.jpg') }}"
                 alt="Visi Misi SMA Taruna Nusantara"
                 class="sejarah-hero-img">
        @endif
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

                @if ($schoolProfile && $schoolProfile->visi)
                    <p>{{ $schoolProfile->visi }}</p>
                @else
                    <p class="text-muted">Belum ada data visi.</p>
                @endif

                {{-- Misi --}}
                <h2 class="vm-heading">Misi</h2>

                <div class="vm-list">
                    @if ($schoolProfile && $schoolProfile->misi)
                        {!! nl2br(e($schoolProfile->misi)) !!}
                    @else
                        <p class="text-muted">Belum ada data misi.</p>
                    @endif
                </div>

            </div>
        </div>
    </section>

@endsection