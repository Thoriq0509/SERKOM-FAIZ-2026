@extends('landing.layout.home')

@section('title', $news->judul . ' - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.news.css') }}">
@endpush

@section('content')

    {{-- Gambar Header --}}
    <section class="news-hero">
        @if (!empty($news->gambar))
            <img src="{{ asset('storage/' . $news->gambar) }}"
                 alt="{{ $news->judul }}"
                 class="news-hero-img">
        @else
            <img src="{{ asset('assets/landing/img-coba/fotosekolah.jpg') }}"
                 alt="{{ $news->judul }}"
                 class="news-hero-img">
        @endif
        <div class="news-hero-overlay"></div>
    </section>

    {{-- Isi Berita --}}
    <section class="news-body-section">
        <div class="container">
            <div class="news-body-content" data-aos="fade-up">

                {{-- Judul --}}
                <h1 class="news-body-title">{{ $news->judul }}</h1>

                {{-- Tanggal --}}
                <div class="news-body-date">
                    <i class="far fa-calendar"></i>
                    {{ \Carbon\Carbon::parse($news->tanggal)->translatedFormat('d F Y') }}
                </div>

                <div class="news-body-divider"></div>

                {{-- Isi --}}
                <div class="news-body-text">
                    {!! nl2br(e($news->isi)) !!}
                </div>

                {{-- Tombol Kembali --}}
                <div class="news-body-back">
                    <a href="{{ route('landing.news') }}" class="news-body-btn">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Berita
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection