@extends('layouts.template')

@section('content')

@php
    $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($news->id);
@endphp

<style>
    :root {
        --c-primary:   #334155;
        --c-primary-d: #1e293b;
        --c-soft:      #f1f5f9;
        --c-border:    #e2e8f0;
        --c-text:      #334155;
        --c-text-soft: #64748b;
        --c-bg:        #f8fafc;
    }

    /* =========================
       PAGE HEADER
    ========================== */
    .page-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.35rem;
        font-weight: 600;
        color: var(--c-primary-d);
        margin-bottom: 4px;
    }

    .page-subtitle {
        color: var(--c-text-soft);
        font-size: .875rem;
        margin: 0;
    }

    .btn-back {
        background-color: #fff;
        border: 1px solid var(--c-border);
        color: var(--c-text);
        font-size: .875rem;
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 8px;
        transition: all .15s ease;
    }

    .btn-back:hover {
        background-color: var(--c-bg);
        border-color: #cbd5e1;
        color: var(--c-primary-d);
    }

    /* =========================
       ALERT
    ========================== */
    .alert-soft {
        border: 1px solid;
        border-radius: 8px;
        font-size: .875rem;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-soft .alert-text { flex: 1; }

    .alert-soft.alert-success {
        background-color: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }

    .alert-soft.alert-danger {
        background-color: #fef2f2;
        border-color: #fecaca;
        color: #991b1b;
    }

    .alert-soft .alert-close {
        background: transparent;
        border: none;
        color: inherit;
        font-size: .9rem;
        opacity: .6;
        padding: 4px 6px;
        line-height: 1;
        cursor: pointer;
        border-radius: 4px;
        transition: opacity .15s ease, background .15s ease;
    }

    .alert-soft .alert-close:hover {
        opacity: 1;
        background: rgba(0,0,0,.06);
    }

    /* =========================
       CARD
    ========================== */
    .card-clean {
        background-color: #fff;
        border: 1px solid var(--c-border);
        border-radius: 10px;
        box-shadow: 0 1px 2px rgba(15,23,42,.04);
        overflow: hidden;
    }

    /* =========================
       HERO HEADER
    ========================== */
    .hero-head {
        padding: 24px 26px;
        border-bottom: 1px solid var(--c-border);
        background-color: #fff;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .hero-icon {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        background-color: var(--c-soft);
        color: var(--c-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        flex-shrink: 0;
    }

    .hero-info { min-width: 0; flex: 1; }

    .hero-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--c-primary-d);
        margin: 0 0 6px;
        line-height: 1.4;
    }

    .hero-meta {
        font-size: .82rem;
        color: var(--c-text-soft);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
    }

    .hero-meta .dot {
        width: 3px;
        height: 3px;
        background-color: #cbd5e1;
        border-radius: 50%;
        display: inline-block;
    }

    /* =========================
       BADGE STATUS
    ========================== */
    .badge-status {
        font-size: .72rem;
        font-weight: 500;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-status.publish {
        background-color: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }

    .badge-status.draft {
        background-color: var(--c-soft);
        border-color: var(--c-border);
        color: var(--c-text-soft);
    }

    /* =========================
       BODY
    ========================== */
    .card-body-clean {
        padding: 28px 26px;
    }

    /* =========================
       SECTION TITLE
    ========================== */
    .section-title {
        font-size: .8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: var(--c-text-soft);
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: var(--c-primary);
        font-size: .85rem;
    }

    .section-divider {
        border: 0;
        border-top: 1px solid var(--c-border);
        margin: 4px 0 20px;
    }

    /* =========================
       NEWS IMAGE
    ========================== */
    .news-image-wrap {
        border: 1px solid var(--c-border);
        border-radius: 8px;
        overflow: hidden;
        background-color: var(--c-bg);
        margin-bottom: 24px;
    }

    .news-image-wrap img {
        width: 100%;
        height: auto;
        max-height: 420px;
        object-fit: cover;
        display: block;
    }

    .news-image-empty {
        padding: 60px 20px;
        text-align: center;
        color: var(--c-text-soft);
        background-color: var(--c-bg);
        border: 1px dashed var(--c-border);
        border-radius: 8px;
        margin-bottom: 24px;
    }

    .news-image-empty i {
        font-size: 2rem;
        color: #cbd5e1;
        margin-bottom: 10px;
        display: block;
    }

    .news-image-empty span {
        font-size: .85rem;
    }

    /* =========================
       NEWS CONTENT
    ========================== */
    .news-content {
        color: var(--c-text);
        font-size: .95rem;
        line-height: 1.75;
        white-space: pre-wrap;
        word-break: break-word;
        margin-bottom: 28px;
    }

    /* =========================
       DETAIL GRID
    ========================== */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 24px;
        border: 1px solid var(--c-border);
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 28px;
    }

    .detail-item {
        padding: 16px 20px;
        border-bottom: 1px solid var(--c-border);
    }

    .detail-item:nth-last-child(-n+2) {
        border-bottom: none;
    }

    .detail-item:nth-child(odd) {
        border-right: 1px solid var(--c-border);
    }

    .detail-label {
        color: var(--c-text-soft);
        font-size: .75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
        margin-bottom: 6px;
    }

    .detail-value {
        color: var(--c-primary-d);
        font-size: .92rem;
        font-weight: 600;
        word-break: break-word;
    }

    .detail-value.mono {
        font-family: 'Courier New', monospace;
        font-weight: 500;
        font-size: .86rem;
        color: var(--c-text);
    }

    /* =========================
       ACTION BAR
    ========================== */
    .action-bar {
        border-top: 1px solid var(--c-border);
        padding-top: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-cancel {
        background-color: #fff;
        border: 1px solid var(--c-border);
        color: var(--c-text);
        font-size: .875rem;
        font-weight: 500;
        padding: 9px 20px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-cancel:hover {
        background-color: var(--c-bg);
        border-color: #cbd5e1;
        color: var(--c-primary-d);
    }

    .btn-primary-soft {
        background-color: var(--c-primary);
        border: 1px solid var(--c-primary);
        color: #fff;
        font-size: .875rem;
        font-weight: 500;
        padding: 9px 20px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-primary-soft:hover {
        background-color: var(--c-primary-d);
        border-color: var(--c-primary-d);
        color: #fff;
    }

    .btn-danger-soft {
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        font-size: .875rem;
        font-weight: 500;
        padding: 9px 20px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-danger-soft:hover {
        background-color: #fee2e2;
        border-color: #fca5a5;
        color: #991b1b;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 767.98px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-item {
            border-right: none !important;
        }

        .detail-item:nth-last-child(-n+2) {
            border-bottom: 1px solid var(--c-border);
        }

        .detail-item:last-child {
            border-bottom: none;
        }
    }

    @media (max-width: 576px) {
        .hero-head {
            padding: 18px 16px;
            gap: 14px;
            align-items: flex-start;
        }

        .hero-icon {
            width: 52px;
            height: 52px;
            font-size: 1.3rem;
        }

        .hero-title { font-size: .98rem; }

        .card-body-clean { padding: 20px 16px; }

        .action-bar {
            flex-direction: column-reverse;
        }

        .action-bar .btn,
        .action-bar form {
            width: 100%;
        }

        .action-bar form button {
            width: 100%;
        }
    }
</style>

<div class="container-fluid p-0">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Detail Berita</h2>
            <p class="page-subtitle">Informasi lengkap berita sekolah.</p>
        </div>

        {{-- ✅ ROUTE DIPERBAIKI --}}
        <a href="{{ route('admin.news.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-text">{{ session('success') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-exclamation-circle"></i>
            <span class="alert-text">{{ session('error') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    {{-- DETAIL CARD --}}
    <div class="card-clean mb-5">

        {{-- HERO HEADER --}}
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

        {{-- BODY --}}
        <div class="card-body-clean">

            {{-- GAMBAR --}}
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

            {{-- ISI BERITA --}}
            <div class="section-title">
                <i class="fas fa-align-left"></i>Isi Berita
            </div>
            <hr class="section-divider">

            <div class="news-content">{{ $news->isi }}</div>

            {{-- INFORMASI DATA --}}
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

            {{-- ACTION BAR --}}
            <div class="action-bar">
                <a href="{{ route('admin.news.index') }}" class="btn btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>

                <a href="{{ route('admin.news.edit', $encryptedId) }}" class="btn btn-primary-soft">
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

{{-- FALLBACK CLOSE ALERT --}}
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