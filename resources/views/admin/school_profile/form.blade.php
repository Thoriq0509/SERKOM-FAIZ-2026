@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/school-profile.css') }}">
@endpush

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Edit Profil Sekolah</h2>
            <p class="page-subtitle">Perbarui informasi profil sekolah.</p>
        </div>

        <a href="{{ route('admin.school_profile') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Alert validasi -->
    @if ($errors->any())
        <div class="alert-soft alert-danger mb-4" role="alert" data-alert>
            <i class="fas fa-exclamation-triangle"></i>
            <div class="alert-body">
                <strong>Gagal menyimpan data.</strong>
                <div class="mt-1">Periksa kembali data yang kamu masukkan.</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Alert sukses -->
    @if (session('success'))
        <div class="alert-soft alert-success mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-body">{{ session('success') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.school_profile.update') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Section: Informasi sekolah -->
        <div class="card-clean mb-4">
            <div class="card-head">
                <h6><i class="fas fa-school me-2"></i>Informasi Sekolah</h6>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    <!-- Nama sekolah -->
                    <div class="col-md-6">
                        <label for="nama_sekolah" class="form-label">
                            Nama Sekolah <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="nama_sekolah"
                               name="nama_sekolah"
                               class="form-control @error('nama_sekolah') is-invalid @enderror"
                               value="{{ old('nama_sekolah', $schoolProfile->nama_sekolah ?? '') }}"
                               maxlength="40"
                               required>
                        @error('nama_sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kepala sekolah -->
                    <div class="col-md-6">
                        <label for="kepala_sekolah" class="form-label">
                            Kepala Sekolah <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="kepala_sekolah"
                               name="kepala_sekolah"
                               class="form-control @error('kepala_sekolah') is-invalid @enderror"
                               value="{{ old('kepala_sekolah', $schoolProfile->kepala_sekolah ?? '') }}"
                               maxlength="40"
                               required>
                        @error('kepala_sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- NPSN -->
                    <div class="col-md-4">
                        <label for="npsn" class="form-label">
                            NPSN <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="npsn"
                               name="npsn"
                               class="form-control @error('npsn') is-invalid @enderror"
                               value="{{ old('npsn', $schoolProfile->npsn ?? '') }}"
                               maxlength="10"
                               required>
                        @error('npsn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kontak -->
                    <div class="col-md-4">
                        <label for="kontak" class="form-label">
                            Kontak / Telepon <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="kontak"
                               name="kontak"
                               class="form-control @error('kontak') is-invalid @enderror"
                               value="{{ old('kontak', $schoolProfile->kontak ?? '') }}"
                               maxlength="15"
                               required>
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tahun berdiri -->
                    <div class="col-md-4">
                        <label for="tahun_berdiri" class="form-label">
                            Tahun Berdiri <span class="req">*</span>
                        </label>
                        <input type="number"
                               id="tahun_berdiri"
                               name="tahun_berdiri"
                               class="form-control @error('tahun_berdiri') is-invalid @enderror"
                               value="{{ old('tahun_berdiri', $schoolProfile->tahun_berdiri ?? '') }}"
                               min="1900"
                               max="{{ date('Y') }}"
                               required>
                        @error('tahun_berdiri')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="col-12">
                        <label for="alamat" class="form-label">
                            Alamat Lengkap <span class="req">*</span>
                        </label>
                        <textarea id="alamat"
                                  name="alamat"
                                  rows="3"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  required>{{ old('alamat', $schoolProfile->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <!-- Section: Media sekolah -->
        <div class="card-clean mb-4">
            <div class="card-head">
                <h6><i class="fas fa-image me-2"></i>Media Sekolah</h6>
            </div>

            <div class="card-body">
                <div class="row g-4">

                    <!-- Logo -->
                    <div class="col-lg-4">
                        <label for="logo" class="form-label">
                            Logo Sekolah <span class="opt">(Opsional)</span>
                        </label>
                        <input type="file"
                               id="logo"
                               name="logo"
                               class="form-control @error('logo') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png">
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">JPG, JPEG, PNG. Maksimal 2 MB.</small>

                        <!-- Logo saat ini -->
                        @if (!empty($schoolProfile->logo))
                            <div class="media-preview logo">
                                <span class="media-label">Logo saat ini:</span>
                                <img src="{{ asset('storage/' . $schoolProfile->logo) }}"
                                     alt="Logo {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}">
                            </div>
                        @else
                            <div class="media-empty">Belum ada logo</div>
                        @endif
                    </div>

                    <!-- Foto gedung -->
                    <div class="col-lg-8">
                        <label for="foto" class="form-label">
                            Foto Gedung / Foto Utama <span class="opt">(Opsional)</span>
                        </label>
                        <input type="file"
                               id="foto"
                               name="foto"
                               class="form-control @error('foto') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">JPG, JPEG, PNG. Maksimal 2 MB.</small>

                        <!-- Foto saat ini -->
                        @if (!empty($schoolProfile->foto))
                            <div class="media-preview photo">
                                <span class="media-label">Foto saat ini:</span>
                                <img src="{{ asset('storage/' . $schoolProfile->foto) }}"
                                     alt="Foto {{ $schoolProfile->nama_sekolah ?? 'Sekolah' }}">
                            </div>
                        @else
                            <div class="media-empty">Belum ada foto gedung</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- Section: Visi & misi -->
        <div class="card-clean mb-4">
            <div class="card-head">
                <h6><i class="fas fa-bullseye me-2"></i>Visi & Misi</h6>
            </div>

            <div class="card-body">
                <label for="visi_misi" class="form-label">
                    Visi dan Misi <span class="req">*</span>
                </label>
                <textarea id="visi_misi"
                          name="visi_misi"
                          rows="8"
                          class="form-control @error('visi_misi') is-invalid @enderror"
                          required>{{ old('visi_misi', $schoolProfile->visi_misi ?? '') }}</textarea>
                @error('visi_misi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Section: Sejarah / deskripsi -->
        <div class="card-clean mb-4">
            <div class="card-head">
                <h6><i class="fas fa-book-open me-2"></i>Sejarah / Deskripsi</h6>
            </div>

            <div class="card-body">
                <label for="deskripsi" class="form-label">
                    Deskripsi / Sejarah Singkat <span class="opt">(Opsional)</span>
                </label>
                <textarea id="deskripsi"
                          name="deskripsi"
                          rows="8"
                          class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $schoolProfile->deskripsi ?? '') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Action bar -->
        <div class="card-clean mb-4">
            <div class="card-body">
                <div class="action-bar">
                    <a href="{{ route('admin.school_profile') }}" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>

    </form>

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