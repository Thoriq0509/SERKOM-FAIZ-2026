@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/teachers.css') }}">
@endpush

@section('breadcrumb')
    <li><a href="{{ route('admin.guru') }}">Data Guru</a></li>
    <li>Detail Guru</li>
@endsection

@section('content')

@php
    $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($teacher->id);
@endphp

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Detail Guru</h2>
            <p class="page-subtitle">Informasi lengkap tenaga pendidik.</p>
        </div>

        <a href="{{ route('admin.guru') }}" class="btn btn-back">
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
            @if ($teacher->foto)
                <img src="{{ asset('storage/' . $teacher->foto) }}"
                     alt="Foto {{ $teacher->nama_guru }}"
                     class="hero-photo">
            @else
                <div class="hero-photo-placeholder">
                    <i class="fas fa-user-tie"></i>
                </div>
            @endif

            <div class="hero-info">
                <h4 class="hero-name">{{ $teacher->nama_guru }}</h4>
                <div class="hero-badges">
                    @if ($teacher->mapel)
                        <span class="badge-mapel">
                            <i class="fas fa-book-open"></i>{{ $teacher->mapel }}
                        </span>
                    @else
                        <span class="badge-mapel empty">
                            <i class="fas fa-book-open"></i>Mata pelajaran belum diisi
                        </span>
                    @endif

                    @if ($teacher->nip)
                        <span class="badge-mapel">
                            <i class="fas fa-id-badge"></i>NIP: {{ $teacher->nip }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body-clean">

            <!-- Data guru -->
            <div class="section-title">
                <i class="fas fa-id-card"></i>Data Guru
            </div>
            <hr class="section-divider">

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Nama Guru</div>
                    <div class="detail-value">{{ $teacher->nama_guru }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">NIP</div>
                    <div class="detail-value mono">
                        @if ($teacher->nip)
                            {{ $teacher->nip }}
                        @else
                            <span class="empty-value">NIP belum diisi</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Mata Pelajaran</div>
                    <div class="detail-value">
                        @if ($teacher->mapel)
                            {{ $teacher->mapel }}
                        @else
                            <span class="empty-value">Mata pelajaran belum diisi</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Foto Guru</div>
                    <div class="detail-value">
                        @if ($teacher->foto)
                            <span class="status-pill ok">
                                <i class="fas fa-check-circle"></i>Sudah tersedia
                            </span>
                        @else
                            <span class="status-pill no">
                                <i class="fas fa-circle-minus"></i>Belum ada foto
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informasi data -->
            <div class="section-title">
                <i class="fas fa-database"></i>Informasi Data
            </div>
            <hr class="section-divider">

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Tanggal Ditambahkan</div>
                    <div class="detail-value">
                        {{ $teacher->created_at
                            ? $teacher->created_at->translatedFormat('d F Y, H:i')
                            : '-' }}
                    </div>
                </div>

                <div class="detail-item" style="grid-column: 1 / -1;">
                    <div class="detail-label">Terakhir Diperbarui</div>
                    <div class="detail-value">
                        {{ $teacher->updated_at
                            ? $teacher->updated_at->translatedFormat('d F Y, H:i')
                            : '-' }}
                    </div>
                </div>
            </div>

            <!-- Action bar -->
            <div class="action-bar">
                <a href="{{ route('admin.guru') }}" class="btn btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>

                <a href="{{ route('admin.guru.edit', $encryptedId) }}" class="btn btn-primary-full">
                    <i class="fas fa-edit me-2"></i>Edit Data
                </a>

                <form action="{{ route('admin.guru.destroy', $encryptedId) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $teacher->nama_guru }}? Data yang sudah dihapus tidak dapat dikembalikan.');">
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