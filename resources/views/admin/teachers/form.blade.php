@extends('layouts.template')

@php
    $isEdit = isset($teacher) && $teacher->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($teacher->getKey())
        : null;
@endphp

@section('content')

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
       HEADER HALAMAN
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

    .alert-soft.alert-success {
        background-color: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
        align-items: center;
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

    .form-control.is-invalid {
        border-color: #dc2626;
        background-image: none;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 .15rem rgba(220,38,38,.12);
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

    textarea.form-control { resize: vertical; }

    /* =========================
       FOTO PREVIEW
    ========================== */
    .photo-preview-box {
        width: 130px;
        height: 130px;
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
       BUTTON
    ========================== */
    .btn-main {
        background-color: var(--c-primary);
        border: 1px solid var(--c-primary);
        color: #fff;
        font-size: .875rem;
        font-weight: 500;
        padding: 9px 22px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-main:hover {
        background-color: var(--c-primary-d);
        border-color: var(--c-primary-d);
        color: #fff;
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

    /* =========================
       ZONA BAHAYA
    ========================== */
    .danger-card {
        background-color: #fff;
        border: 1px solid #fecaca;
        border-radius: 10px;
        overflow: hidden;
    }

    .danger-head {
        padding: 14px 22px;
        background-color: #fef2f2;
        border-bottom: 1px solid #fecaca;
        color: #991b1b;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: .9rem;
        font-weight: 600;
    }

    .danger-body {
        padding: 20px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
    }

    .danger-body h6 {
        font-weight: 600;
        color: var(--c-primary-d);
        margin-bottom: 4px;
        font-size: .9rem;
    }

    .danger-body p {
        margin: 0;
        font-size: .82rem;
        color: var(--c-text-soft);
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
    @media (max-width: 576px) {
        .card-clean .card-body { padding: 20px 16px; }
        .card-clean .card-head { padding: 14px 16px; }

        .danger-body {
            flex-direction: column;
            align-items: stretch;
        }

        .danger-body form button {
            width: 100%;
        }

        .action-bar {
            flex-direction: column-reverse;
        }

        .action-bar .btn,
        .action-bar a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container-fluid p-0">

    {{-- HEADER HALAMAN --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">
                {{ $isEdit ? 'Edit Data Guru' : 'Tambah Data Guru' }}
            </h2>
            <p class="page-subtitle">
                {{ $isEdit
                    ? 'Perbarui informasi tenaga pendidik.'
                    : 'Tambahkan tenaga pendidik baru ke dalam sistem.'
                }}
            </p>
        </div>

        <a href="{{ route('admin.guru') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- ALERT ERROR VALIDASI --}}
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

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert-soft alert-success mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-body">{{ session('success') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    {{-- CARD FORM --}}
    <div class="card-clean mb-4">

        <div class="card-head">
            <div class="head-icon">
                <i class="fas {{ $isEdit ? 'fa-edit' : 'fa-user-plus' }}"></i>
            </div>
            <div>
                <h6>{{ $isEdit ? 'Form Edit Data Guru' : 'Form Tambah Data Guru' }}</h6>
                <small>Lengkapi data tenaga pendidik dengan benar.</small>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ $isEdit
                    ? route('admin.guru.update', $encryptedId)
                    : route('admin.guru.store')
                }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($isEdit) @method('PUT') @endif

                {{-- SECTION: DATA UTAMA --}}
                <div class="section-title">
                    <i class="fas fa-id-badge"></i>Data Utama
                </div>
                <hr class="section-divider">

                <div class="row">

                    {{-- Nama Guru --}}
                    <div class="col-md-6 mb-4">
                        <label for="nama_guru" class="form-label">
                            Nama Lengkap Guru <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="nama_guru"
                               name="nama_guru"
                               class="form-control @error('nama_guru') is-invalid @enderror"
                               value="{{ old('nama_guru', $teacher->nama_guru ?? '') }}"
                               maxlength="40"
                               placeholder="Contoh: Ahmad Fauzi, S.Kom."
                               required>
                        @error('nama_guru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIP --}}
                    <div class="col-md-6 mb-4">
                        <label for="nip" class="form-label">
                            NIP <span class="opt">(Opsional)</span>
                        </label>
                        <input type="text"
                               id="nip"
                               name="nip"
                               class="form-control @error('nip') is-invalid @enderror"
                               value="{{ old('nip', $teacher->nip ?? '') }}"
                               maxlength="15"
                               placeholder="Masukkan NIP">
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- SECTION: MATA PELAJARAN --}}
                <div class="section-title">
                    <i class="fas fa-book"></i>Mata Pelajaran
                </div>
                <hr class="section-divider">

                <div class="mb-4">
                    <label for="mapel" class="form-label">
                        Mata Pelajaran <span class="opt">(Opsional)</span>
                    </label>
                    <input type="text"
                           id="mapel"
                           name="mapel"
                           class="form-control @error('mapel') is-invalid @enderror"
                           value="{{ old('mapel', $teacher->mapel ?? '') }}"
                           maxlength="40"
                           placeholder="Contoh: Rekayasa Perangkat Lunak">
                    @error('mapel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- SECTION: FOTO --}}
                <div class="section-title">
                    <i class="fas fa-image"></i>Foto Guru
                </div>
                <hr class="section-divider">

                <div class="mb-4">
                    <label for="foto" class="form-label">
                        Foto Guru <span class="opt">(Opsional)</span>
                    </label>
                    <input type="file"
                           id="foto"
                           name="foto"
                           class="form-control @error('foto') is-invalid @enderror"
                           accept=".jpg,.jpeg,.png">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-hint">
                        Format JPG, JPEG, atau PNG. Ukuran maksimal 2 MB.
                        @if ($isEdit)
                            Kosongkan jika tidak ingin mengganti foto.
                        @endif
                    </small>

                    {{-- Foto saat ini --}}
                    @if ($isEdit && $teacher->foto)
                        <div class="photo-wrapper">
                            <span class="photo-label">Foto saat ini:</span>
                            <img src="{{ asset('storage/' . $teacher->foto) }}"
                                 alt="{{ $teacher->nama_guru }}"
                                 class="photo-preview-box">
                        </div>
                    @endif

                    {{-- Preview foto baru --}}
                    <div id="previewWrapper" class="preview-wrapper">
                        <span class="photo-label">Preview foto baru:</span>
                        <img id="previewPhoto"
                             src=""
                             alt="Preview foto"
                             class="photo-preview-box new">
                    </div>
                </div>

                {{-- ACTION BAR --}}
                <div class="border-top pt-4 mt-2">
                    <div class="d-flex justify-content-end gap-2 flex-wrap action-bar">
                        <a href="{{ route('admin.guru') }}" class="btn btn-cancel">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-main">
                            <i class="fas {{ $isEdit ? 'fa-save' : 'fa-plus' }} me-2"></i>
                            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data Guru' }}
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>

    {{-- ZONA BAHAYA --}}
    @if ($isEdit)
        <div class="danger-card mb-5">
            <div class="danger-head">
                <i class="fas fa-exclamation-triangle"></i>Zona Bahaya
            </div>
            <div class="danger-body">
                <div>
                    <h6>Hapus Data Guru</h6>
                    <p>
                        Data guru <strong>{{ $teacher->nama_guru }}</strong>
                        akan dihapus secara permanen.
                    </p>
                </div>

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
    @endif

</div>

{{-- SCRIPT: PREVIEW FOTO + FALLBACK CLOSE ALERT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ============ PREVIEW FOTO ============ */
    const fotoInput      = document.getElementById('foto');
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