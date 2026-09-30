@extends('layouts.template')

@section('content')

@php
    $isEdit = $student->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($student->id)
        : null;
@endphp

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">
                {{ $isEdit ? 'Edit Data Siswa' : 'Tambah Data Siswa' }}
            </h2>
            <p class="page-subtitle">
                {{ $isEdit
                    ? 'Perbarui informasi data peserta didik.'
                    : 'Tambahkan data peserta didik baru.'
                }}
            </p>
        </div>

        <a href="{{ route('admin.siswa') }}" class="btn btn-back">
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
                <i class="fas fa-user-graduate"></i>
            </div>
            <div>
                <h6>{{ $isEdit ? 'Form Edit Siswa' : 'Form Tambah Siswa' }}</h6>
                <small>Lengkapi data siswa dengan benar.</small>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ $isEdit
                    ? route('admin.siswa.update', $encryptedId)
                    : route('admin.siswa.store')
                }}"
                method="POST">
                @csrf
                @if ($isEdit) @method('PUT') @endif

                <!-- Section: Informasi siswa -->
                <div class="section-title">
                    <i class="fas fa-id-card"></i>Informasi Siswa
                </div>
                <hr class="section-divider">

                <!-- Info box -->
                <div class="info-box">
                    <i class="fas fa-circle-info"></i>
                    <span>
                        Pastikan <strong>NISN</strong>, <strong>nama</strong>,
                        <strong>jenis kelamin</strong>, dan <strong>tahun masuk</strong>
                        sudah sesuai dengan data siswa.
                    </span>
                </div>

                <div class="row">

                    <!-- NISN -->
                    <div class="col-md-6 mb-4">
                        <label for="nisn" class="form-label">
                            NISN <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="nisn"
                               name="nisn"
                               class="form-control @error('nisn') is-invalid @enderror"
                               value="{{ old('nisn', $student->nisn) }}"
                               maxlength="10"
                               inputmode="numeric"
                               placeholder="Masukkan NISN"
                               required>
                        @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Maksimal 10 karakter.</small>
                    </div>

                    <!-- Nama siswa -->
                    <div class="col-md-6 mb-4">
                        <label for="nama_siswa" class="form-label">
                            Nama Siswa <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="nama_siswa"
                               name="nama_siswa"
                               class="form-control @error('nama_siswa') is-invalid @enderror"
                               value="{{ old('nama_siswa', $student->nama_siswa) }}"
                               maxlength="40"
                               placeholder="Masukkan nama lengkap siswa"
                               required>
                        @error('nama_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Maksimal 40 karakter.</small>
                    </div>

                    <!-- Jenis kelamin -->
                    <div class="col-md-6 mb-4">
                        <label for="jenis_kelamin" class="form-label">
                            Jenis Kelamin <span class="req">*</span>
                        </label>
                        <select id="jenis_kelamin"
                                name="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki"
                                {{ old('jenis_kelamin', $student->jenis_kelamin) === 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki
                            </option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $student->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tahun masuk -->
                    <div class="col-md-6 mb-4">
                        <label for="tahun_masuk" class="form-label">
                            Tahun Masuk <span class="req">*</span>
                        </label>
                        <input type="number"
                               id="tahun_masuk"
                               name="tahun_masuk"
                               class="form-control @error('tahun_masuk') is-invalid @enderror"
                               value="{{ old('tahun_masuk', $student->tahun_masuk) }}"
                               min="1900"
                               max="{{ date('Y') }}"
                               placeholder="Contoh: {{ date('Y') }}"
                               required>
                        @error('tahun_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Masukkan tahun dalam format 4 digit.</small>
                    </div>

                </div>

                <!-- Action bar -->
                <div class="action-bar">
                    <a href="{{ route('admin.siswa') }}" class="btn btn-cancel">
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