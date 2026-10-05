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
@endphp

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Detail Media Galeri</h2>
            <p class="page-subtitle">Informasi lengkap media galeri sekolah.</p>
        </div>

        <a href="{{ route('admin.gallery.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Alert sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-text">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Alert error -->
    @if (session('error'))
        <div class="alert alert-danger alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-exclamation-circle"></i>
            <span class="alert-text">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Card detail -->
    <div class="card-clean mb-5">

        <!-- Hero header -->
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

        <!-- Body -->
        <div class="card-body-clean">

            <!-- Media -->
            @if ($gallery->gambar)
                <div class="media-view">
                    <img src="{{ asset('storage/' . $gallery->gambar) }}"
                         alt="{{ $gallery->judul }}">
                </div>
            @else
                <div class="media-empty">
                    <i class="fas fa-image"></i>
                    <span>Belum ada file media untuk galeri ini.</span>
                </div>
            @endif

            <!-- Keterangan -->
            <div class="section-title">
                <i class="fas fa-align-left"></i>Keterangan
            </div>
            <hr class="section-divider">

            @if ($gallery->keterangan)
                <div class="gallery-desc">{{ $gallery->keterangan }}</div>
            @else
                <div class="gallery-desc empty">Belum ada keterangan untuk media ini.</div>
            @endif

            <!-- Informasi data -->
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
            </div>

            <!-- Action bar -->
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