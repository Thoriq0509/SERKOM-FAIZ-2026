@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/extracurricular.css') }}">
@endpush

@section('breadcrumb')
    <li><a href="{{ route('admin.extracurricular.index') }}">Kelola Ekstrakurikuler</a></li>
    <li>Detail Ekstrakurikuler</li>
@endsection

@section('content')

@php
    $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($extracurricular->id);
@endphp

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Detail Ekstrakurikuler</h2>
            <p class="page-subtitle">Informasi lengkap kegiatan ekstrakurikuler.</p>
        </div>

        <a href="{{ route('admin.extracurricular.index') }}" class="btn btn-back">
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
            @if ($extracurricular->gambar)
                <img src="{{ asset('storage/' . $extracurricular->gambar) }}"
                     alt="{{ $extracurricular->nama_ekskul }}"
                     class="hero-photo">
            @else
                <div class="hero-photo-placeholder">
                    <i class="fas fa-people-group"></i>
                </div>
            @endif

            <div class="hero-info">
                <h4 class="hero-name">{{ $extracurricular->nama_ekskul }}</h4>
                <div class="hero-badges">

                    {{-- ============ PEMBINA — DIREVISI ============ --}}
                    @if ($extracurricular->pembina)
                        <span class="badge-info">
                            <i class="fas fa-user-tie"></i>
                            Pembina: {{ $extracurricular->pembina->nama_guru }}
                        </span>
                    @else
                        <span class="badge-info empty">
                            <i class="fas fa-user-tie"></i>Pembina belum diisi
                        </span>
                    @endif
                    {{-- ============================================ --}}

                    @if ($extracurricular->jadwal_latihan)
                        <span class="badge-info">
                            <i class="far fa-clock"></i>{{ $extracurricular->jadwal_latihan }}
                        </span>
                    @else
                        <span class="badge-info empty">
                            <i class="far fa-clock"></i>Jadwal belum diisi
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body-clean">

            <!-- Gambar -->
            @if ($extracurricular->gambar)
                <div class="ekskul-image-wrap">
                    <img src="{{ asset('storage/' . $extracurricular->gambar) }}"
                         alt="{{ $extracurricular->nama_ekskul }}">
                </div>
            @else
                <div class="ekskul-image-empty">
                    <i class="fas fa-image"></i>
                    <span>Belum ada gambar untuk ekstrakurikuler ini.</span>
                </div>
            @endif

            <!-- Deskripsi -->
            <div class="section-title">
                <i class="fas fa-align-left"></i>Deskripsi
            </div>
            <hr class="section-divider">

            @if ($extracurricular->deskripsi)
                <div class="ekskul-desc">{{ $extracurricular->deskripsi }}</div>
            @else
                <div class="ekskul-desc empty">Belum ada deskripsi untuk ekstrakurikuler ini.</div>
            @endif

            <!-- Informasi data -->
            <div class="section-title">
                <i class="fas fa-database"></i>Informasi Data
            </div>
            <hr class="section-divider">

                <div class="detail-item">
                    <div class="detail-label">Nama Ekstrakurikuler</div>
                    <div class="detail-value">{{ $extracurricular->nama_ekskul }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Pembina</div>
                    <div class="detail-value">
                        @if ($extracurricular->pembina)
                            {{ $extracurricular->pembina->nama_guru }}
                            @if ($extracurricular->pembina->nip)
                                <br><small class="text-muted">NIP: {{ $extracurricular->pembina->nip }}</small>
                            @endif
                        @else
                            <span class="empty-value">Belum diisi</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Jadwal Latihan</div>
                    <div class="detail-value">
                        @if ($extracurricular->jadwal_latihan)
                            {{ $extracurricular->jadwal_latihan }}
                        @else
                            <span class="empty-value">Belum diisi</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Ditambahkan</div>
                    <div class="detail-value">
                        {{ $extracurricular->created_at
                            ? $extracurricular->created_at->translatedFormat('d F Y, H:i')
                            : '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Terakhir Diperbarui</div>
                    <div class="detail-value">
                        {{ $extracurricular->updated_at
                            ? $extracurricular->updated_at->translatedFormat('d F Y, H:i')
                            : '-' }}
                    </div>
                </div>
            </div>

            <!-- Action bar -->
            <div class="action-bar">
                <a href="{{ route('admin.extracurricular.index') }}" class="btn btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>

                <a href="{{ route('admin.extracurricular.edit', $encryptedId) }}" class="btn btn-primary-full">
                    <i class="fas fa-edit me-2"></i>Edit Data
                </a>

                <form action="{{ route('admin.extracurricular.destroy', $encryptedId) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler {{ $extracurricular->nama_ekskul }}? Data yang sudah dihapus tidak dapat dikembalikan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-soft">
                        <i class="fas fa-trash-alt me-2"></i>Hapus Data
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