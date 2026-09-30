@extends('layouts.template')

@php
    $isEdit = isset($teacher) && $teacher->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($teacher->getKey())
        : null;
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/teachers.css') }}">
@endpush

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
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

    <!-- Card form -->
    <div class="card-clean mb-4">

        <div class="card-head" style="justify-content: flex-start;">
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

                <!-- Section: Data utama -->
                <div class="section-title">
                    <i class="fas fa-id-badge"></i>Data Utama
                </div>
                <hr class="section-divider">

                <div class="row">

                    <!-- Nama guru -->
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

                    <!-- NIP -->
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

                <!-- Section: Mata pelajaran -->
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

                <!-- Section: Foto -->
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

                    <!-- Foto saat ini -->
                    @if ($isEdit && $teacher->foto)
                        <div class="photo-wrapper">
                            <span class="photo-label">Foto saat ini:</span>
                            <img src="{{ asset('storage/' . $teacher->foto) }}"
                                 alt="{{ $teacher->nama_guru }}"
                                 class="photo-preview-box">
                        </div>
                    @endif

                    <!-- Preview foto baru -->
                    <div id="previewWrapper" class="preview-wrapper">
                        <span class="photo-label">Preview foto baru:</span>
                        <img id="previewPhoto"
                             src=""
                             alt="Preview foto"
                             class="photo-preview-box new">
                    </div>
                </div>

                <!-- Action bar -->
                <div class="action-bar">
                    <a href="{{ route('admin.guru') }}" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="fas {{ $isEdit ? 'fa-save' : 'fa-plus' }} me-2"></i>
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data Guru' }}
                    </button>
                </div>

            </form>

        </div>

    </div>

    <!-- Danger zone -->
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

<!-- Script preview foto + tutup alert -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Preview foto
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