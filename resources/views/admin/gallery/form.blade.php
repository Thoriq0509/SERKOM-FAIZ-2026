@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/gallery.css') }}">
@endpush

@section('breadcrumb')
    <li><a href="{{ route('admin.gallery.index') }}">Kelola Galeri</a></li>
    <li>{{ (isset($gallery) && $gallery->exists) ? 'Edit Media' : 'Tambah Media' }}</li>
@endsection

@php
    $isEdit = isset($gallery) && $gallery->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($gallery->id)
        : null;

    $kategoriLama = old('kategori', $gallery->kategori ?? '');
    $isFotoLama   = $kategoriLama === 'Foto';
    $isVideoLama  = $kategoriLama === 'Video';

    $hasFotoLama    = $isEdit && $gallery->gambar;
    $hasYoutubeLama = $isEdit && $gallery->link_video;
@endphp

@section('content')

<div class="container-fluid p-0">

    {{-- Header --}}
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

    {{-- Alert validasi --}}
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

    {{-- Card form --}}
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

                {{-- Section: Informasi media --}}
                <div class="section-title">
                    <i class="fas fa-circle-info"></i>Informasi Media
                </div>
                <hr class="section-divider">

                <div class="info-box">
                    <i class="fas fa-circle-info"></i>
                    <span>
                        Pilih kategori terlebih dahulu.
                        <strong>Foto</strong> → upload file gambar.
                        <strong>Video</strong> → isi link YouTube.
                    </span>
                </div>

                <div class="row">

                    {{-- Judul --}}
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

                    {{-- Kategori --}}
                    <div class="col-md-4 mb-4">
                        <label for="kategori" class="form-label">
                            Kategori <span class="req">*</span>
                        </label>
                        <select id="kategori"
                                name="kategori"
                                class="form-select @error('kategori') is-invalid @enderror"
                                required>
                            <option value="">Pilih Kategori</option>
                            <option value="Foto"  {{ $kategoriLama === 'Foto'  ? 'selected' : '' }}>Foto</option>
                            <option value="Video" {{ $kategoriLama === 'Video' ? 'selected' : '' }}>Video</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Jenis media galeri.</small>
                    </div>

                    {{-- Tanggal --}}
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

                {{-- Section: Keterangan --}}
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

                {{-- Section: Sumber Media --}}
                <div class="section-title mt-2">
                    <i class="fas fa-photo-video"></i>Sumber Media
                </div>
                <hr class="section-divider">

                {{-- Placeholder kalau kategori belum dipilih --}}
                <div id="mediaPlaceholder" class="info-box" style="display:none;">
                    <i class="fas fa-hand-pointer"></i>
                    <span>Silakan pilih <strong>Kategori</strong> terlebih dahulu untuk menampilkan input sumber media.</span>
                </div>

                {{-- Input FOTO (upload file) --}}
                <div id="inputFoto" class="mb-4" style="display:none;">
                    <label for="gambar" class="form-label">
                        Upload Foto <span class="req">*</span>
                    </label>
                    <input type="file"
                           id="gambar"
                           name="gambar"
                           class="form-control @error('gambar') is-invalid @enderror"
                           accept=".jpg,.jpeg,.png,.webp">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-hint">
                        Format: <strong>JPG, JPEG, PNG, WEBP</strong>.
                        Maksimal <strong>5 MB</strong>.
                        @if ($isEdit)
                            Kosongkan jika tidak ingin mengganti foto.
                        @endif
                    </small>

                    {{-- Foto saat ini --}}
                    @if ($hasFotoLama && $isFotoLama)
                        <div class="photo-wrapper">
                            <span class="photo-label">Foto saat ini:</span>
                            <img src="{{ asset('storage/' . $gallery->gambar) }}"
                                 alt="{{ $gallery->judul }}"
                                 class="photo-preview-box">
                        </div>
                    @endif

                    {{-- Preview foto baru --}}
                    <div id="previewWrapper" class="preview-wrapper" style="display:none;">
                        <span class="photo-label">Preview foto baru:</span>
                        <img id="previewPhoto" src="" alt="Preview" class="photo-preview-box new">
                    </div>
                </div>

                {{-- Input VIDEO (link YouTube) --}}
                <div id="inputVideo" class="mb-4" style="display:none;">
                    <label for="link_video" class="form-label">
                        Link YouTube <span class="req">*</span>
                    </label>
                    <input type="url"
                           id="link_video"
                           name="link_video"
                           class="form-control @error('link_video') is-invalid @enderror"
                           value="{{ old('link_video', $gallery->link_video ?? '') }}"
                           placeholder="Contoh: https://www.youtube.com/watch?v=xxxxx">
                    @error('link_video')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-hint">
                        Format: <strong>youtube.com/watch?v=</strong>, <strong>youtu.be/</strong>, atau <strong>youtube.com/shorts/</strong>.
                    </small>

                    {{-- Link YouTube saat ini --}}
                    @if ($hasYoutubeLama && $isVideoLama)
                        <div class="photo-wrapper">
                            <span class="photo-label">Link YouTube saat ini:</span>
                            <a href="{{ $gallery->link_video }}" target="_blank" rel="noopener" class="link-preview">
                                <i class="fab fa-youtube"></i>
                                <span>{{ $gallery->link_video }}</span>
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Action bar --}}
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

{{-- Script: toggle input sumber media + preview foto --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const kategoriSelect     = document.getElementById('kategori');
    const inputFoto          = document.getElementById('inputFoto');
    const inputVideo         = document.getElementById('inputVideo');
    const mediaPlaceholder   = document.getElementById('mediaPlaceholder');

    const fileInput          = document.getElementById('gambar');
    const previewWrapper     = document.getElementById('previewWrapper');
    const previewPhoto       = document.getElementById('previewPhoto');

    // ===== Toggle input sesuai kategori =====
    function toggleMediaInput() {
        const kategori = kategoriSelect.value;

        // reset semua
        inputFoto.style.display        = 'none';
        inputVideo.style.display       = 'none';
        mediaPlaceholder.style.display = 'none';

        // reset required + value biar gak konflik
        if (fileInput) fileInput.required = false;

        if (kategori === 'Foto') {
            inputFoto.style.display = 'block';
            if (fileInput && !{{ $isEdit ? 'true' : 'false' }}) {
                // wajib upload kalau tambah baru
                fileInput.required = true;
            }
        } else if (kategori === 'Video') {
            inputVideo.style.display = 'block';
        } else {
            mediaPlaceholder.style.display = 'flex';
        }
    }

    if (kategoriSelect) {
        kategoriSelect.addEventListener('change', toggleMediaInput);
        toggleMediaInput(); // jalankan saat load (untuk edit / old input)
    }

    // ===== Preview foto =====
    if (fileInput && previewWrapper && previewPhoto) {
        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            previewPhoto.src = '';

            if (!file) {
                previewWrapper.style.display = 'none';
                return;
            }

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewPhoto.src = e.target.result;
                    previewWrapper.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewWrapper.style.display = 'none';
            }
        });
    }

});
</script>

@endsection