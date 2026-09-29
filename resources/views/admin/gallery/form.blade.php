@extends('layouts.template')

@section('content')

@php
    $isEdit = isset($gallery) && $gallery->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($gallery->id)
        : null;
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
        padding: 14px 18px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .alert-soft .alert-body { flex: 1; }

    .alert-soft ul {
        margin: 6px 0 0;
        padding-left: 18px;
        font-size: .82rem;
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
        padding: 2px 6px;
        cursor: pointer;
        border-radius: 4px;
        transition: opacity .15s ease, background .15s ease;
        line-height: 1;
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

    .card-clean .card-head {
        padding: 16px 22px;
        border-bottom: 1px solid var(--c-border);
        background-color: #fff;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-clean .card-head .head-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background-color: var(--c-soft);
        color: var(--c-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .card-clean .card-head h6 {
        margin: 0;
        font-size: .95rem;
        font-weight: 600;
        color: var(--c-primary-d);
    }

    .card-clean .card-head small {
        color: var(--c-text-soft);
        font-size: .78rem;
    }

    .card-clean .card-body {
        padding: 28px 22px;
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
       INFO BOX
    ========================== */
    .info-box {
        background-color: var(--c-bg);
        border: 1px solid var(--c-border);
        border-left: 3px solid var(--c-primary);
        border-radius: 6px;
        padding: 12px 16px;
        font-size: .82rem;
        color: var(--c-text-soft);
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 24px;
    }

    .info-box i {
        color: var(--c-primary);
        font-size: .9rem;
        margin-top: 1px;
        flex-shrink: 0;
    }

    /* =========================
       FORM LABEL & INPUT
    ========================== */
    .form-label {
        color: var(--c-text);
        font-size: .85rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-label .req { color: #dc2626; margin-left: 2px; }
    .form-label .opt {
        color: var(--c-text-soft);
        font-weight: 400;
        font-size: .78rem;
    }

    .form-control,
    .form-select {
        min-height: 43px;
        padding: 10px 14px;
        font-size: .875rem;
        color: var(--c-text);
        background-color: #fff;
        border: 1px solid var(--c-border);
        border-radius: 6px;
        box-shadow: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .form-control::placeholder { color: #94a3b8; }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--c-primary);
        box-shadow: 0 0 0 .15rem rgba(51,65,85,.10);
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc2626;
        background-image: none;
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        box-shadow: 0 0 0 .15rem rgba(220,38,38,.12);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .invalid-feedback {
        font-size: .78rem;
        color: #dc2626;
        margin-top: 6px;
    }

    .form-hint {
        color: var(--c-text-soft);
        font-size: .75rem;
        margin-top: 6px;
        display: block;
    }

    /* =========================
       IMAGE PREVIEW
    ========================== */
    .photo-preview-box {
        width: 240px;
        height: 150px;
        padding: 4px;
        background-color: #fff;
        border: 1px solid var(--c-border);
        border-radius: 8px;
        object-fit: cover;
        display: block;
    }

    .photo-preview-box.new {
        border: 2px solid var(--c-primary);
    }

    .photo-label {
        display: block;
        font-size: .75rem;
        color: var(--c-text-soft);
        margin-bottom: 8px;
        font-weight: 500;
    }

    .photo-wrapper { margin-top: 16px; }
    .preview-wrapper { display: none; margin-top: 16px; }

    /* =========================
       ACTION BAR
    ========================== */
    .action-bar {
        border-top: 1px solid var(--c-border);
        padding-top: 20px;
        margin-top: 10px;
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
        padding: 9px 22px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-cancel:hover {
        background-color: var(--c-bg);
        border-color: #cbd5e1;
        color: var(--c-primary-d);
    }

    .btn-save {
        background-color: var(--c-primary);
        border: 1px solid var(--c-primary);
        color: #fff;
        font-size: .875rem;
        font-weight: 500;
        padding: 9px 22px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-save:hover {
        background-color: var(--c-primary-d);
        border-color: var(--c-primary-d);
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 576px) {
        .card-clean .card-body { padding: 20px 16px; }
        .card-clean .card-head { padding: 14px 16px; }

        .action-bar {
            flex-direction: column-reverse;
        }

        .action-bar .btn,
        .action-bar a {
            width: 100%;
            text-align: center;
        }

        .photo-preview-box {
            width: 100%;
            max-width: 240px;
            height: auto;
        }
    }
</style>

<div class="container-fluid p-0">

    {{-- PAGE HEADER --}}
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

    {{-- VALIDATION ERROR ALERT --}}
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

    {{-- FORM CARD --}}
    <div class="card-clean mb-5">

        <div class="card-head">
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

                {{-- SECTION: INFORMASI MEDIA --}}
                <div class="section-title">
                    <i class="fas fa-circle-info"></i>Informasi Media
                </div>
                <hr class="section-divider">

                {{-- INFO BOX --}}
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

                {{-- SECTION: KETERANGAN --}}
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

                {{-- SECTION: GAMBAR --}}
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

                    {{-- Gambar saat ini --}}
                    @if ($isEdit && $gallery->gambar)
                        <div class="photo-wrapper">
                            <span class="photo-label">Gambar saat ini:</span>
                            <img src="{{ asset('storage/' . $gallery->gambar) }}"
                                 alt="{{ $gallery->judul }}"
                                 class="photo-preview-box">
                        </div>
                    @endif

                    {{-- Preview gambar baru --}}
                    <div id="previewWrapper" class="preview-wrapper">
                        <span class="photo-label">Preview gambar baru:</span>
                        <img id="previewPhoto"
                             src=""
                             alt="Preview gambar"
                             class="photo-preview-box new">
                    </div>
                </div>

                {{-- ACTION BAR --}}
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

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ============ IMAGE PREVIEW ============ */
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

    /* ============ FALLBACK CLOSE ALERT ============ */
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