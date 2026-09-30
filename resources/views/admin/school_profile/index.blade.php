@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/school-profile.css') }}">
@endpush

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Profil Sekolah</h2>
            <p class="page-subtitle">Informasi lengkap mengenai profil sekolah.</p>
        </div>

        <a href="{{ route('admin.school_profile.edit') }}" class="btn btn-primary-soft">
            <i class="fas fa-edit me-2"></i>Edit Profil
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

    <!-- Identitas sekolah -->
    <div class="card-clean mb-4">
        <div class="card-body">
            <div class="identity-section">

                <!-- Logo -->
                <div class="school-logo">
                    @if ($schoolProfile && $schoolProfile->logo)
                        <img src="{{ asset('storage/' . $schoolProfile->logo) }}"
                             alt="Logo {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}">
                    @else
                        <span class="logo-empty">Belum ada logo</span>
                    @endif
                </div>

                <!-- Identitas -->
                <div class="identity-info">
                    <h3 class="school-name">
                        {{ $schoolProfile->nama_sekolah ?? 'Nama Sekolah Belum Diatur' }}
                    </h3>

                    <div class="identity-grid">
                        <div class="identity-item">
                            <div class="label">NPSN</div>
                            <div class="value">{{ $schoolProfile->npsn ?? '-' }}</div>
                        </div>

                        <div class="identity-item">
                            <div class="label">Tahun Berdiri</div>
                            <div class="value">{{ $schoolProfile->tahun_berdiri ?? '-' }}</div>
                        </div>

                        <div class="identity-item">
                            <div class="label">Kepala Sekolah</div>
                            <div class="value">{{ $schoolProfile->kepala_sekolah ?? '-' }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Informasi sekolah -->
    <div class="card-clean mb-4">

        <div class="card-head">
            <h6><i class="fas fa-school me-2"></i>Informasi Sekolah</h6>
        </div>

        <div class="card-body">
            <div class="info-grid">

                <div class="info-item">
                    <div class="label">Kepala Sekolah</div>
                    <div class="value">{{ $schoolProfile->kepala_sekolah ?? '-' }}</div>
                </div>

                <div class="info-item">
                    <div class="label">Tahun Berdiri</div>
                    <div class="value">{{ $schoolProfile->tahun_berdiri ?? '-' }}</div>
                </div>

                <div class="info-item">
                    <div class="label">NPSN</div>
                    <div class="value">{{ $schoolProfile->npsn ?? '-' }}</div>
                </div>

                <div class="info-item">
                    <div class="label">Kontak / Telepon</div>
                    <div class="value">{{ $schoolProfile->kontak ?? '-' }}</div>
                </div>

                <div class="info-item full">
                    <div class="label">Alamat Lengkap</div>
                    <div class="value">{{ $schoolProfile->alamat ?? '-' }}</div>
                </div>

            </div>
        </div>
    </div>

    <!-- Visi misi & deskripsi -->
    <div class="row g-4 mb-4">

        <!-- Visi & misi -->
        <div class="col-lg-6">
            <div class="card-clean h-100">
                <div class="card-head">
                    <h6><i class="fas fa-bullseye me-2"></i>Visi & Misi</h6>
                </div>
                <div class="card-body">
                    <div class="text-content {{ $schoolProfile->visi_misi ? '' : 'empty' }}">
                        {{ $schoolProfile->visi_misi ?? 'Belum ada data visi dan misi.' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sejarah / deskripsi -->
        <div class="col-lg-6">
            <div class="card-clean h-100">
                <div class="card-head">
                    <h6><i class="fas fa-book-open me-2"></i>Sejarah / Deskripsi</h6>
                </div>
                <div class="card-body">
                    <div class="text-content {{ $schoolProfile->deskripsi ? '' : 'empty' }}">
                        {{ $schoolProfile->deskripsi ?? 'Belum ada deskripsi sekolah.' }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Foto gedung -->
    <div class="card-clean mb-4">

        <div class="card-head">
            <h6><i class="fas fa-building me-2"></i>Foto Gedung Utama</h6>
        </div>

        <div class="card-body p-0">
            @if ($schoolProfile && $schoolProfile->foto)
                <img src="{{ asset('storage/' . $schoolProfile->foto) }}"
                     alt="Foto Gedung {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}"
                     class="building-photo">
            @else
                <div class="building-empty">
                    Belum ada foto gedung sekolah.
                </div>
            @endif
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