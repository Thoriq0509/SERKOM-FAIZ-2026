@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/news.css') }}">
@endpush

@php
    $isEdit = isset($news) && $news->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($news->id)
        : null;
@endphp

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">
                {{ $isEdit ? 'Edit Berita' : 'Tambah Berita' }}
            </h2>
            <p class="page-subtitle">
                {{ $isEdit
                    ? 'Perbarui informasi berita sekolah.'
                    : 'Tambahkan berita baru ke dalam sistem.'
                }}
            </p>
        </div>

        <a href="{{ route('admin.news.index') }}" class="btn btn-back">
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
                <i class="fas {{ $isEdit ? 'fa-pen-to-square' : 'fa-newspaper' }}"></i>
            </div>
            <div>
                <h6>{{ $isEdit ? 'Form Edit Berita' : 'Form Tambah Berita' }}</h6>
                <small>Lengkapi data berita dengan benar.</small>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ $isEdit
                    ? route('admin.news.update', $encryptedId)
                    : route('admin.news.store')
                }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($isEdit) @method('PUT') @endif

                <!-- Section: Informasi berita -->
                <div class="section-title">
                    <i class="fas fa-newspaper"></i>Informasi Berita
                </div>
                <hr class="section-divider">

                <!-- Info box -->
                <div class="info-box">
                    <i class="fas fa-circle-info"></i>
                    <span>
                        Isi data berita dengan lengkap.
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
                            Judul Berita <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="judul"
                               name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $news->judul ?? '') }}"
                               maxlength="50"
                               placeholder="Masukkan judul berita"
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Maksimal 50 karakter.</small>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-md-4 mb-4">
                        <label for="tanggal" class="form-label">
                            Tanggal Publikasi <span class="req">*</span>
                        </label>
                        <input type="date"
                               id="tanggal"
                               name="tanggal"
                               class="form-control @error('tanggal') is-invalid @enderror"
                               value="{{ old('tanggal', $news->tanggal ? $news->tanggal->format('Y-m-d') : date('Y-m-d')) }}"
                               required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-4 mb-4">
                        <label for="status" class="form-label">
                            Status <span class="req">*</span>
                        </label>
                        <select id="status"
                                name="status"
                                class="form-select @error('status') is-invalid @enderror"
                                required>
                            <option value="">Pilih Status</option>
                            <option value="Publish"
                                {{ old('status', $news->status ?? '') === 'Publish' ? 'selected' : '' }}>
                                Publish
                            </option>
                            <option value="Draft"
                                {{ old('status', $news->status ?? '') === 'Draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Publish = tampil, Draft = simpan sementara.</small>
                    </div>

                </div>

                <!-- Section: Isi berita -->
                <div class="section-title mt-2">
                    <i class="fas fa-align-left"></i>Isi Berita
                </div>
                <hr class="section-divider">

                <div class="mb-4">
                    <label for="isi" class="form-label">
                        Isi Berita <span class="req">*</span>
                    </label>
                    <textarea id="isi"
                              name="isi"
                              class="form-control @error('isi') is-invalid @enderror"
                              rows="8"
                              placeholder="Tulis isi berita di sini..."
                              required>{{ old('isi', $news->isi ?? '') }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Section: Gambar -->
                <div class="section-title mt-2">
                    <i class="fas fa-image"></i>Gambar Berita
                </div>
                <hr class="section-divider">

                <div class="mb-4">
                    <label for="gambar" class="form-label">
                        Gambar <span class="opt">(Opsional)</span>
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
                        Format JPG, JPEG, PNG, WEBP. Ukuran maksimal 2 MB.
                        @if ($isEdit)
                            Kosongkan jika tidak ingin mengganti gambar.
                        @endif
                    </small>

                    <!-- Gambar saat ini -->
                    @if ($isEdit && $news->gambar)
                        <div class="photo-wrapper">
                            <span class="photo-label">Gambar saat ini:</span>
                            <img src="{{ asset('storage/' . $news->gambar) }}"
                                 alt="{{ $news->judul }}"
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
                    <a href="{{ route('admin.news.index') }}" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save me-2"></i>
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Berita' }}
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