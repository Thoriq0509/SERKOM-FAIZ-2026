@extends('landing.layout.home')

@section('title', 'Berita - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.news.css') }}">
@endpush

@section('content')

    {{-- Hero Header --}}
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content" data-aos="fade-up">
                <span class="page-hero-label">Informasi Terkini</span>
                <h1 class="page-hero-title">Berita Sekolah</h1>
                <p class="page-hero-desc">
                    Kabar dan kegiatan terbaru dari SMA Taruna Nusantara.
                </p>
            </div>
        </div>
    </section>

    {{-- Grid Berita --}}
    <section class="section-block">
        <div class="container">

            @if ($news->count() > 0)

                <div class="row g-4">

                    @foreach ($news as $index => $item)
                        <div class="col-md-6 col-lg-4"
                             data-aos="fade-up"
                             data-aos-delay="{{ ($index % 3) * 100 }}">

                            <article class="news-card">

                                <div class="news-thumb">
                                    @if (!empty($item->gambar))
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                             alt="{{ $item->judul }}"
                                             class="news-thumb-img">
                                    @else
                                        <div class="news-thumb-empty">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="news-body">
                                    <div class="news-date">
                                        <i class="far fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                    </div>

                                    <h5 class="news-title">{{ $item->judul }}</h5>

                                    <p class="news-excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 120) }}
                                    </p>

                                    <a href="{{ route('landing.news.show', $item->slug) }}"
                                       class="news-link">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>

                            </article>

                        </div>
                    @endforeach

                </div>

                {{-- Pagination (kalau controller pakai paginate) --}}
                @if (method_exists($news, 'links'))
                    <div class="news-pagination mt-5 d-flex justify-content-center">
                        {{ $news->links() }}
                    </div>
                @endif

            @else

                {{-- Empty state --}}
                <div class="news-empty text-center py-5" data-aos="fade-up">
                    <i class="fas fa-newspaper"></i>
                    <h5 class="mt-3">Belum Ada Berita</h5>
                    <p class="text-muted">
                        Saat ini belum ada berita yang dipublikasikan.
                    </p>
                </div>

            @endif

        </div>
    </section>

@endsection