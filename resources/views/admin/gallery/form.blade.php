@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/gallery.css') }}">
@endpush

@php
    $isEdit = isset($gallery) && $gallery->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($gallery->id)
        : null;
@endphp

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">
                {{ $isEdit ? 'Edit Media Galeri' : 'Tambah Media Galeri' }}
            </h2>
            <p class="page-subtitle">
                {{ $isEdit
                    ? 'Perbarui informasi media galeri sekolah.'
                    : 'Tambahkan foto atau video baru ke galeri sekolah.'
                }}
            </p>
        </div>

        <a href="{{ route('admin.gallery.index') }}" class="btn btn-back">
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

    <!-- Card form -->
    <div class="card-clean mb-5">

        <div class="card-head" style="justify-content: flex-start;">
            <div class="head-icon">
                <i class="fas {{ $isEdit ? 'fa-pen-to-square' : 'fa-images' }}"></i>
            </div>
            <div>
                <h6>{{ $isEdit ? 'Form Edit Media' : 'Form Tambah Media' }}</h6>
                <small>Lengkapi data media galeri dengan benar.</small>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ $isEdit
                    ? route('admin.gallery.update', $encryptedId)
                    : route('admin.gallery.store')
                }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($isEdit) @method('PUT') @endif

                <!-- Section: Informasi media -->
                <div class="section-title">
                    <i class="fas fa-circle-info"></i>Informasi Media
                </div>
                <hr class="section-divider">

                <!-- Info box -->
                <div class="info-box">
                    <i class="fas fa-circle-info"></i>
                    <span>
                        Isi data media galeri dengan lengkap.
                        @if ($isEdit)
                            Kosongkan <strong>gambar</strong> jika tidak ingin menggantinya.
                        @else
                            Format gambar: <strong>JPG, JPEG, PNG, WEBP</strong>, maksimal 2 MB.
                        @endif
                    </span>
                </div>

                <div class="row">

                    <!-- Judul -->
                    <div class="col-md-8 mb-4">
                        <label for="judul" class="form-label">
                            Judul <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="judul"
                               name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $gallery->judul ?? '') }}"
                               maxlength="50"
                               placeholder="Contoh: Lomba 17 Agustus 2026"
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Maksimal 50 karakter.</small>
                    </div>

                    <!-- Kategori -->
                    <div class="col-md-4 mb-4">
                        <label for="kategori" class="form-label">
                            Kategori <span class="req">*</span>
                        </label>
                        <select id="kategori"
                                name="kategori"
                                class="form-select @error('kategori') is-invalid @enderror"
                                required>
                            <option value="">Pilih Kategori</option>
                            <option value="Foto"
                                {{ old('kategori', $gallery->kategori ?? '') === 'Foto' ? 'selected' : '' }}>
                                Foto
                            </option>
                            <option value="Video"
                                {{ old('kategori', $gallery->kategori ?? '') === 'Video' ? 'selected' : '' }}>
                                Video
                            </option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Jenis media galeri.</small>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-md-4 mb-4">
                        <label for="tanggal" class="form-label">
                            Tanggal <span class="req">*</span>
                        </label>
                        <input type="date"
                               id="tanggal"
                               name="tanggal"
                               class="form-control @error('tanggal') is-invalid @enderror"
                               value="{{ old('tanggal', $gallery->tanggal ? $gallery->tanggal->format('Y-m-d') : date('Y-m-d')) }}"
                               required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Tanggal kegiatan atau upload.</small>
                    </div>

                </div>

                <!-- Section: Keterangan -->
                <div class="section-title mt-2">
                    <i class="fas fa-align-left"></i>Keterangan
                </div>
                <hr class="section-divider">

                <div class="mb-4">
                    <label for="keterangan" class="form-label">
                        Keterangan <span class="opt">(Opsional)</span>
                    </label>
                    <textarea id="keterangan"
                              name="keterangan"
                              class="form-control @error('keterangan') is-invalid @enderror"
                              rows="4"
                              placeholder="Tulis keterangan atau deskripsi media di sini...">{{ old('keterangan', $gallery->keterangan ?? '') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Section: Gambar -->
                <div class="section-title mt-2">
                    <i class="fas fa-image"></i>File Media
                </div>
                <hr class="section-divider">

                <div class="mb-4">
                    <label for="gambar" class="form-label">
                        Gambar <span class="req">*</span>
                    </label>
                    <input type="file"
                           id="gambar"
                           name="gambar"
                           class="form-control @error('gambar') is-invalid @enderror"
                           accept=".jpg,.jpeg,.png,.webp"
                           {{ $isEdit ? '' : 'required' }}>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-hint">
                        Format JPG, JPEG, PNG, WEBP. Ukuran maksimal 2 MB.
                        @if ($isEdit)
                            Kosongkan jika tidak ingin mengganti gambar.
                        @endif
                    </small>

                    <!-- Gambar saat ini -->
                    @if ($isEdit && $gallery->gambar)
                        <div class="photo-wrapper">
                            <span class="photo-label">Gambar saat ini:</span>
                            <img src="{{ asset('storage/' . $gallery->gambar) }}"
                                 alt="{{ $gallery->judul }}"
                                 class="photo-preview-box">
                        </div>
                    @endif

                    <!-- Preview gambar baru -->
                    <div id="previewWrapper" class="preview-wrapper">
                        <span class="photo-label">Preview gambar baru:</span>
                        <img id="previewPhoto"
                             src=""
                             alt="Preview gambar"
                             class="photo-preview-box new">
                    </div>
                </div>

                <!-- Action bar -->
                <div class="action-bar">
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save me-2"></i>
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data' }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- Script preview gambar + tutup alert -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    // Preview gambar
    const fotoInput      = document.getElementById('gambar');
    const previewWrapper = document.getElementById('previewWrapper');
    const previewPhoto   = document.getElementById('previewPhoto');

    if (fotoInput && previewWrapper && previewPhoto) {
        fotoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file || !file.type.startsWith('image/')) {
                previewWrapper.style.display = 'none';
                previewPhoto.src = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                previewPhoto.src = e.target.result;
                previewWrapper.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    }

    // Tutup alert manual
    document.querySelectorAll('[data-alert-close]').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const box = btn.closest('[data-alert]');
            if (!box) return;
            box.style.transition = 'opacity .2s ease';
            box.style.opacity = '0';
            setTimeout(() => box.remove(), 200);
        });
    });

});
</script>

@endsection