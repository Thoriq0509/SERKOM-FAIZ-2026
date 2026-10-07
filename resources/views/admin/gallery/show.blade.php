@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/gallery.css') }}">
@endpush

@section('breadcrumb')
    <li><a href="{{ route('admin.gallery.index') }}">Kelola Galeri</a></li>
    <li>Detail Media</li>
@endsection

@section('content')

@php
    $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($gallery->id);
    $isVideo     = $gallery->kategori === 'Video';
    $hasYoutube  = $isVideo && !empty($gallery->link_video);
    $hasLokal    = !empty($gallery->gambar);
@endphp

<div class="container-fluid p-0">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Detail Media Galeri</h2>
            <p class="page-subtitle">Informasi lengkap media galeri sekolah.</p>
        </div>

        <a href="{{ route('admin.gallery.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-text">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Alert error --}}
    @if (session('error'))
        <div class="alert alert-danger alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-exclamation-circle"></i>
            <span class="alert-text">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Card detail --}}
    <div class="card-clean mb-5">

        {{-- Hero header --}}
        <div class="hero-head">
            <div class="hero-info">
                <h4 class="hero-title">{{ $gallery->judul }}</h4>
                <div class="hero-badges">
                    @if ($gallery->kategori === 'Foto')
                        <span class="badge-cat photo">
                            <i class="fas fa-camera"></i>Foto
                        </span>
                    @elseif ($gallery->kategori === 'Video')
                        <span class="badge-cat video">
                            <i class="fas fa-video"></i>Video
                        </span>
                    @else
                        <span class="badge-info">{{ $gallery->kategori ?: 'Lainnya' }}</span>
                    @endif

                    <span class="badge-info">
                        <i class="far fa-calendar"></i>
                        {{ $gallery->tanggal
                            ? $gallery->tanggal->translatedFormat('d F Y')
                            : '-'
                        }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="card-body-clean">

            {{-- Media --}}
            @if ($hasYoutube)
                {{-- Prioritas 1: YouTube --}}
                <div class="media-view">
                    @if ($gallery->gambar)
                        {{-- Ada thumbnail gambar --}}
                        <div class="youtube-embed-wrap">
                            <a href="{{ $gallery->link_video }}" target="_blank" rel="noopener" class="youtube-embed-link">
                                <img src="{{ asset('storage/' . $gallery->gambar) }}"
                                     alt="{{ $gallery->judul }}">
                                <div class="youtube-play-btn">
                                    <i class="fab fa-youtube"></i>
                                </div>
                            </a>
                        </div>
                    @else
                        {{-- Tanpa thumbnail --}}
                        <div class="youtube-no-thumb">
                            <i class="fab fa-youtube"></i>
                            <p class="mb-2">Video YouTube</p>
                            <a href="{{ $gallery->link_video }}" target="_blank" rel="noopener" class="btn btn-danger-soft">
                                <i class="fab fa-youtube me-2"></i>Buka di YouTube
                            </a>
                        </div>
                    @endif
                </div>

            @elseif ($hasLokal && $isVideo)
                {{-- Prioritas 2: Video lokal --}}
                <div class="media-view">
                    <video controls class="media-video">
                        <source src="{{ asset('storage/' . $gallery->gambar) }}">
                        Browser Anda tidak mendukung tag video.
                    </video>
                </div>

            @elseif ($hasLokal && !$isVideo)
                {{-- Prioritas 3: Foto --}}
                <div class="media-view">
                    <img src="{{ asset('storage/' . $gallery->gambar) }}"
                         alt="{{ $gallery->judul }}">
                </div>

            @else
                {{-- Tidak ada media --}}
                <div class="media-empty">
                    <i class="fas fa-image"></i>
                    <span>Belum ada file media untuk galeri ini.</span>
                </div>
            @endif

            {{-- Keterangan --}}
            <div class="section-title">
                <i class="fas fa-align-left"></i>Keterangan
            </div>
            <hr class="section-divider">

            @if ($gallery->keterangan)
                <div class="gallery-desc">{{ $gallery->keterangan }}</div>
            @else
                <div class="gallery-desc empty">Belum ada keterangan untuk media ini.</div>
            @endif

            {{-- Informasi data --}}
            <div class="section-title">
                <i class="fas fa-database"></i>Informasi Data
            </div>
            <hr class="section-divider">

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Judul</div>
                    <div class="detail-value">{{ $gallery->judul }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Kategori</div>
                    <div class="detail-value">
                        {{ $gallery->kategori ?: 'Lainnya' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Sumber Media</div>
                    <div class="detail-value">
                        @if ($hasYoutube)
                            <span class="badge-source youtube">
                                <i class="fab fa-youtube"></i>YouTube
                            </span>
                        @elseif ($hasLokal && $isVideo)
                            <span class="badge-source video">
                                <i class="fas fa-video"></i>Video Lokal
                            </span>
                        @elseif ($hasLokal && !$isVideo)
                            <span class="badge-source photo">
                                <i class="fas fa-camera"></i>Foto Lokal
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tanggal</div>
                    <div class="detail-value">
                        {{ $gallery->tanggal
                            ? $gallery->tanggal->translatedFormat('d F Y')
                            : '-'
                        }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Ditambahkan</div>
                    <div class="detail-value">
                        {{ $gallery->created_at
                            ? $gallery->created_at->translatedFormat('d F Y, H:i')
                            : '-'
                        }}
                    </div>
                </div>

                <div class="detail-item" style="grid-column: 1 / -1;">
                    <div class="detail-label">Terakhir Diperbarui</div>
                    <div class="detail-value">
                        {{ $gallery->updated_at
                            ? $gallery->updated_at->translatedFormat('d F Y, H:i')
                            : '-'
                        }}
                    </div>
                </div>

                @if ($hasYoutube)
                    <div class="detail-item" style="grid-column: 1 / -1;">
                        <div class="detail-label">Link YouTube</div>
                        <div class="detail-value">
                            <a href="{{ $gallery->link_video }}" target="_blank" rel="noopener" class="link-preview">
                                <i class="fab fa-youtube"></i>
                                <span>{{ $gallery->link_video }}</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Action bar --}}
            <div class="action-bar">
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>

                <a href="{{ route('admin.gallery.edit', $encryptedId) }}" class="btn btn-primary-full">
                    <i class="fas fa-edit me-2"></i>Edit Media
                </a>

                <form action="{{ route('admin.gallery.destroy', $encryptedId) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus media galeri {{ $gallery->judul }}? Data yang sudah dihapus tidak dapat dikembalikan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-soft">
                        <i class="fas fa-trash-alt me-2"></i>Hapus Media
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection