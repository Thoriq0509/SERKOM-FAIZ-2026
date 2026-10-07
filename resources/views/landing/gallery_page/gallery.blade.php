@extends('landing.layout.home')

@section('title', 'Galeri - SMA Taruna Nusantara')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/landing/css/landing.gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/glightbox-master/dist/css/glightbox.min.css') }}">
@endpush

@section('content')

    {{-- Hero Header --}}
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content" data-aos="fade-up">
                <span class="page-hero-label">Dokumentasi</span>
                <h1 class="page-hero-title">Galeri Sekolah</h1>
                <p class="page-hero-desc">
                    Kumpulan foto dan video kegiatan SMA Taruna Nusantara.
                </p>
            </div>
        </div>
    </section>

    {{-- Galeri --}}
    <section class="section-block">
        <div class="container">

            {{-- Filter Kategori --}}
            <div class="gallery-filter" data-aos="fade-up">
                <button type="button" class="filter-btn active" data-filter="all">Semua</button>
                <button type="button" class="filter-btn" data-filter="Foto">Foto</button>
                <button type="button" class="filter-btn" data-filter="Video">Video</button>
            </div>

            {{-- Grid Galeri --}}
            <div class="gallery-grid" id="galleryGrid">

                @forelse ($galleries as $index => $item)
                    @php
                        $isVideo    = $item->kategori === 'Video';
                        $hasYoutube = $isVideo && !empty($item->link_video);
                        $hasFoto    = !$isVideo && !empty($item->gambar);

                        // URL target GLightbox
                        if ($hasYoutube) {
                            $href = $item->link_video;
                        } elseif ($hasFoto) {
                            $href = asset('storage/' . $item->gambar);
                        } else {
                            $href = '#';
                        }

                        // Sanitasi untuk atribut data-glightbox
                        $safeTitle = str_replace(['"', "'"], '', $item->judul ?? '');
                        $safeDesc  = str_replace(['"', "'", "\n", "\r"], ' ', $item->keterangan ?? '');
                        $glightboxAttr = 'title: ' . $safeTitle . '; description: ' . $safeDesc;
                    @endphp

                    <div class="gallery-item"
                         data-kategori="{{ $item->kategori }}"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($index % 4) * 100 }}">

                        <a href="{{ $href }}"
                           class="glightbox gallery-link"
                           data-gallery="gallery-1"
                           data-glightbox="{{ $glightboxAttr }}"
                           @if (!$hasYoutube && !$hasFoto) aria-disabled="true" @endif>

                            <div class="gallery-thumb">

                                {{-- ===== Media Preview ===== --}}
                                @if ($hasYoutube)
                                    {{-- Video YouTube --}}
                                    @if (!empty($item->gambar))
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                             alt="{{ $item->judul }}"
                                             class="gallery-img">
                                    @else
                                        <div class="gallery-thumb-empty youtube">
                                            <i class="fab fa-youtube"></i>
                                        </div>
                                    @endif

                                    <div class="gallery-play-overlay">
                                        <i class="fas fa-play"></i>
                                    </div>

                                @elseif ($hasFoto)
                                    {{-- Foto --}}
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         alt="{{ $item->judul }}"
                                         class="gallery-img">

                                @else
                                    {{-- Tidak ada media --}}
                                    <div class="gallery-thumb-empty">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif

                                {{-- ===== Overlay Info ===== --}}
                                <div class="gallery-overlay">

                                    <span class="gallery-badge {{ $isVideo ? 'video' : '' }}">
                                        @if ($isVideo)
                                            <i class="fas fa-play"></i> Video
                                        @else
                                            <i class="fas fa-camera"></i> Foto
                                        @endif
                                    </span>

                                    <div class="gallery-info">
                                        <h5 class="gallery-title">{{ $item->judul }}</h5>
                                        <div class="gallery-date">
                                            <i class="far fa-calendar"></i>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </a>
                    </div>

                @empty
                    <div class="gallery-empty">
                        <i class="fas fa-images"></i>
                        <p>Belum ada data galeri.</p>
                    </div>
                @endforelse

            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('assets/landing/glightbox-master/dist/js/glightbox.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const galleryGrid = document.getElementById('galleryGrid');
            const filterBtns  = document.querySelectorAll('.filter-btn');
            const items       = galleryGrid ? galleryGrid.querySelectorAll('.gallery-item') : [];

            // ===== Init GLightbox =====
            function initLightbox() {
                return GLightbox({
                    selector: '.glightbox',
                    touchNavigation: true,
                    loop: true,
                    zoomable: true,
                });
            }

            let lightbox = initLightbox();

            // ===== Filter Kategori =====
            filterBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {

                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const filter = this.dataset.filter;

                    items.forEach(function (item) {
                        const cocok = (filter === 'all' || item.dataset.kategori === filter);
                        item.classList.toggle('is-hidden', !cocok);
                    });

                    // Reinit lightbox supaya navigasi prev/next
                    // hanya mengikuti item yang kelihatan
                    lightbox.destroy();
                    lightbox = initLightbox();
                });
            });

        });
    </script>
@endpush