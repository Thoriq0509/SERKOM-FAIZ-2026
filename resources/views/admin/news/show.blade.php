@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/news.css') }}">
@endpush

@section('content')

@php
    $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($news->id);
@endphp

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Detail Berita</h2>
            <p class="page-subtitle">Informasi lengkap berita sekolah.</p>
        </div>

        <a href="{{ route('admin.news.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Alert sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-text">{{ session('success') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Alert error -->
    @if (session('error'))
        <div class="alert alert-danger alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-exclamation-circle"></i>
            <span class="alert-text">{{ session('error') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Card detail -->
    <div class="card-clean mb-5">

        <!-- Hero header -->
        <div class="hero-head">
            <div class="hero-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="hero-info">
                <h4 class="hero-title">{{ $news->judul }}</h4>
                <div class="hero-meta">
                    <span>{{ $news->tanggal ? $news->tanggal->translatedFormat('d F Y') : '-' }}</span>
                    <span class="dot"></span>
                    <span>Oleh: {{ $news->user->username ?? '-' }}</span>
                    <span class="dot"></span>
                    @if ($news->status === 'Publish')
                        <span class="badge-status publish">
                            <i class="fas fa-circle-check"></i>Publish
                        </span>
                    @else
                        <span class="badge-status draft">
                            <i class="fas fa-circle-dot"></i>Draft
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body-clean">

            <!-- Gambar -->
            @if ($news->gambar)
                <div class="news-image-wrap">
                    <img src="{{ asset('storage/' . $news->gambar) }}"
                         alt="{{ $news->judul }}">
                </div>
            @else
                <div class="news-image-empty">
                    <i class="fas fa-image"></i>
                    <span>Belum ada gambar untuk berita ini.</span>
                </div>
            @endif

            <!-- Isi berita -->
            <div class="section-title">
                <i class="fas fa-align-left"></i>Isi Berita
            </div>
            <hr class="section-divider">

            <div class="news-content">{{ $news->isi }}</div>

            <!-- Informasi data -->
            <div class="section-title">
                <i class="fas fa-database"></i>Informasi Data
            </div>
            <hr class="section-divider">

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">ID Berita</div>
                    <div class="detail-value mono">#{{ $news->id }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tanggal Publikasi</div>
                    <div class="detail-value">
                        {{ $news->tanggal ? $news->tanggal->translatedFormat('d F Y') : '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Dibuat Oleh</div>
                    <div class="detail-value">
                        {{ $news->user->username ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Terakhir Diperbarui</div>
                    <div class="detail-value">
                        {{ $news->updated_at
                            ? $news->updated_at->translatedFormat('d F Y, H:i')
                            : '-' }}
                    </div>
                </div>
            </div>

            <!-- Action bar -->
            <div class="action-bar">
                <a href="{{ route('admin.news.index') }}" class="btn btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>

                <a href="{{ route('admin.news.edit', $encryptedId) }}" class="btn btn-primary-full">
                    <i class="fas fa-edit me-2"></i>Edit Berita
                </a>

                <form action="{{ route('admin.news.destroy', $encryptedId) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini? Data yang sudah dihapus tidak dapat dikembalikan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-soft">
                        <i class="fas fa-trash-alt me-2"></i>Hapus Berita
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

<!-- Script tutup alert manual -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-alert-close]").forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const box = btn.closest("[data-alert]");
            if (!box) return;
            box.style.transition = "opacity .2s ease";
            box.style.opacity = "0";
            setTimeout(() => box.remove(), 200);
        });
    });
});
</script>

@endsection