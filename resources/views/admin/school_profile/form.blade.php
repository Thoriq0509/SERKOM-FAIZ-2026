@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/school-profile.css') }}">
@endpush

@section('breadcrumb')
    <li><a href="{{ route('admin.school_profile') }}">Profil Sekolah</a></li>
    <li>Edit Profil</li>
@endsection

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
        </div>
    @endif

    <!-- Alert sukses -->
    @if (session('success'))
        <div class="alert-soft alert-success mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-body">{{ session('success') }}</span>
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

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">
                            Email <span class="opt">(Opsional)</span>
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $schoolProfile->email ?? '') }}"
                               maxlength="100"
                               placeholder="Contoh: info@sekolah.sch.id">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Maksimal 100 karakter.</small>
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

        <!-- Section: Sosial Media -->
        <div class="card-clean mb-4">
            <div class="card-head">
                <h6><i class="fas fa-share-nodes me-2"></i>Sosial Media</h6>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    <!-- Facebook -->
                    <div class="col-md-4">
                        <label for="facebook" class="form-label">
                            Facebook <span class="opt">(Opsional)</span>
                        </label>
                        <input type="url"
                               id="facebook"
                               name="facebook"
                               class="form-control @error('facebook') is-invalid @enderror"
                               value="{{ old('facebook', $schoolProfile->facebook ?? '') }}"
                               maxlength="255"
                               placeholder="https://facebook.com/smatn">
                        @error('facebook')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Link halaman Facebook sekolah.</small>
                    </div>

                    <!-- Instagram -->
                    <div class="col-md-4">
                        <label for="instagram" class="form-label">
                            Instagram <span class="opt">(Opsional)</span>
                        </label>
                        <input type="url"
                               id="instagram"
                               name="instagram"
                               class="form-control @error('instagram') is-invalid @enderror"
                               value="{{ old('instagram', $schoolProfile->instagram ?? '') }}"
                               maxlength="255"
                               placeholder="https://instagram.com/smatn">
                        @error('instagram')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Link akun Instagram sekolah.</small>
                    </div>

                    <!-- WhatsApp -->
                    <div class="col-md-4">
                        <label for="whatsapp" class="form-label">
                            WhatsApp <span class="opt">(Opsional)</span>
                        </label>
                        <input type="text"
                               id="whatsapp"
                               name="whatsapp"
                               class="form-control @error('whatsapp') is-invalid @enderror"
                               value="{{ old('whatsapp', $schoolProfile->whatsapp ?? '') }}"
                               maxlength="20"
                               placeholder="628123456789">
                        @error('whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">
                            Format internasional tanpa <strong>+</strong> dan tanpa <strong>62</strong>.
                            Contoh: <strong>08123456789</strong>
                        </small>
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

                    <!-- Foto kepala sekolah -->
                    <div class="col-lg-4">
                        <label for="foto_kepsek" class="form-label">
                            Foto Kepala Sekolah <span class="opt">(Opsional)</span>
                        </label>
                        <input type="file"
                               id="foto_kepsek"
                               name="foto_kepsek"
                               class="form-control @error('foto_kepsek') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png">
                        @error('foto_kepsek')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">JPG, JPEG, PNG. Maksimal 2 MB.</small>

                        @if (!empty($schoolProfile->foto_kepsek))
                            <div class="media-preview kepsek">
                                <span class="media-label">Foto saat ini:</span>
                                <img src="{{ asset('storage/' . $schoolProfile->foto_kepsek) }}"
                                     alt="Foto Kepala Sekolah">
                            </div>
                        @else
                            <div class="media-empty">Belum ada foto</div>
                        @endif
                    </div>

                    <!-- Foto gedung -->
                    <div class="col-lg-4">
                        <label for="foto" class="form-label">
                            Foto Gedung <span class="opt">(Opsional)</span>
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

                        @if (!empty($schoolProfile->foto))
                            <div class="media-preview photo">
                                <span class="media-label">Foto saat ini:</span>
                                <img src="{{ asset('storage/' . $schoolProfile->foto) }}"
                                     alt="Foto Gedung">
                            </div>
                        @else
                            <div class="media-empty">Belum ada foto</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- Section: Visi & Misi -->
        <div class="card-clean mb-4">
            <div class="card-head">
                <h6><i class="fas fa-bullseye me-2"></i>Visi & Misi</h6>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    <!-- Visi -->
                    <div class="col-lg-6">
                        <label for="visi" class="form-label">
                            Visi <span class="req">*</span>
                        </label>
                        <textarea id="visi"
                                  name="visi"
                                  rows="8"
                                  class="form-control @error('visi') is-invalid @enderror"
                                  placeholder="Tulis visi sekolah di sini..."
                                  required>{{ old('visi', $schoolProfile->visi ?? '') }}</textarea>
                        @error('visi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Misi -->
                    <div class="col-lg-6">
                        <label for="misi" class="form-label">
                            Misi <span class="req">*</span>
                        </label>
                        <textarea id="misi"
                                  name="misi"
                                  rows="8"
                                  class="form-control @error('misi') is-invalid @enderror"
                                  placeholder="Tulis misi sekolah di sini..."
                                  required>{{ old('misi', $schoolProfile->misi ?? '') }}</textarea>
                        @error('misi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Boleh pakai enter antar poin misi.</small>
                    </div>

                </div>
            </div>
        </div>

        <!-- Section: Sambutan kepala sekolah -->
        <div class="card-clean mb-4">
            <div class="card-head">
                <h6><i class="fas fa-quote-left me-2"></i>Sambutan Kepala Sekolah</h6>
            </div>

            <div class="card-body">
                <label for="sambutan_kepsek" class="form-label">
                    Sambutan <span class="opt">(Opsional)</span>
                </label>
                <textarea id="sambutan_kepsek"
                          name="sambutan_kepsek"
                          rows="8"
                          class="form-control @error('sambutan_kepsek') is-invalid @enderror"
                          placeholder="Tulis sambutan kepala sekolah di sini...">{{ old('sambutan_kepsek', $schoolProfile->sambutan_kepsek ?? '') }}</textarea>
                @error('sambutan_kepsek')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-hint">Sambutan akan tampil di landing page.</small>
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

@endsection