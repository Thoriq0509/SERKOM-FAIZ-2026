@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/extracurricular.css') }}">
@endpush

@php
    $isEdit = isset($extracurricular) && $extracurricular->exists;

    $encryptedId = $isEdit
        ? \Illuminate\Support\Facades\Crypt::encryptString($extracurricular->id)
        : null;

    // Parse jadwal lama (format: "Jumat, 14:00 - 16:00")
    $jadwalLama   = old('jadwal_latihan', $extracurricular->jadwal_latihan ?? '');
    $hariList     = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    $hariTerpilih = '';
    $jamMulaiH    = '';
    $jamMulaiM    = '';
    $jamSelesaiH  = '';
    $jamSelesaiM  = '';

    foreach ($hariList as $h) {
        if (str_starts_with($jadwalLama, $h)) {
            $hariTerpilih = $h;
            $sisa = trim(substr($jadwalLama, strlen($h)), ", \t\n\r\0\x0B");

            if (preg_match('/(\d{1,2}):(\d{2})\s*-\s*(\d{1,2}):(\d{2})/', $sisa, $m)) {
                $jamMulaiH   = str_pad($m[1], 2, '0', STR_PAD_LEFT);
                $jamMulaiM   = $m[2];
                $jamSelesaiH = str_pad($m[3], 2, '0', STR_PAD_LEFT);
                $jamSelesaiM = $m[4];
            }
            break;
        }
    }

    $jamOptions   = [];
    for ($i = 0; $i < 24; $i++) {
        $jamOptions[] = str_pad($i, 2, '0', STR_PAD_LEFT);
    }
    $menitOptions = ['00', '15', '30', '45'];
@endphp

@section('breadcrumb')
    <li><a href="{{ route('admin.extracurricular.index') }}">Kelola Ekstrakurikuler</a></li>
    <li>{{ $isEdit ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler' }}</li>
@endsection

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">
                {{ $isEdit ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler' }}
            </h2>
            <p class="page-subtitle">
                {{ $isEdit
                    ? 'Perbarui informasi kegiatan ekstrakurikuler.'
                    : 'Tambahkan kegiatan ekstrakurikuler baru.'
                }}
            </p>
        </div>

        <a href="{{ route('admin.extracurricular.index') }}" class="btn btn-back">
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
                <i class="fas {{ $isEdit ? 'fa-pen-to-square' : 'fa-circle-plus' }}"></i>
            </div>
            <div>
                <h6>{{ $isEdit ? 'Form Edit Ekstrakurikuler' : 'Form Tambah Ekstrakurikuler' }}</h6>
                <small>Lengkapi data ekstrakurikuler dengan benar.</small>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ $isEdit
                    ? route('admin.extracurricular.update', $encryptedId)
                    : route('admin.extracurricular.store')
                }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($isEdit) @method('PUT') @endif

                <!-- Section: Informasi ekstrakurikuler -->
                <div class="section-title">
                    <i class="fas fa-circle-info"></i>Informasi Ekstrakurikuler
                </div>
                <hr class="section-divider">

                <!-- Info box -->
                <div class="info-box">
                    <i class="fas fa-circle-info"></i>
                    <span>
                        Isi data ekstrakurikuler dengan lengkap.
                        @if ($isEdit)
                            Kosongkan <strong>gambar</strong> jika tidak ingin menggantinya.
                        @else
                            Format gambar: <strong>JPG, JPEG, PNG, WEBP</strong>, maksimal 2 MB.
                        @endif
                    </span>
                </div>

                <div class="row">

                    <!-- Nama ekskul -->
                    <div class="col-md-6 mb-4">
                        <label for="nama_ekskul" class="form-label">
                            Nama Ekstrakurikuler <span class="req">*</span>
                        </label>
                        <input type="text"
                               id="nama_ekskul"
                               name="nama_ekskul"
                               class="form-control @error('nama_ekskul') is-invalid @enderror"
                               value="{{ old('nama_ekskul', $extracurricular->nama_ekskul ?? '') }}"
                               maxlength="40"
                               placeholder="Contoh: Pramuka"
                               required>
                        @error('nama_ekskul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Maksimal 40 karakter.</small>
                    </div>

                    <!-- ============================================ -->
                    <!-- PEMBINA — DIUBAH JADI DROPDOWN DARI DATA GURU -->
                    <!-- ============================================ -->
                    <div class="col-md-6 mb-4">
                        <label for="id_guru" class="form-label">
                            Pembina <span class="opt">(Opsional)</span>
                        </label>
                        <select id="id_guru"
                                name="id_guru"
                                class="form-select @error('id_guru') is-invalid @enderror">
                            <option value="">-- Pilih Pembina --</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('id_guru', $extracurricular->id_guru ?? '') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->nama_guru }}
                                    @if($teacher->nip) — NIP: {{ $teacher->nip }} @endif
                                </option>
                            @endforeach
                        </select>
                        @error('id_guru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Pilih dari daftar guru yang tersedia.</small>
                    </div>
                    <!-- ============================================ -->

                    <!-- Jadwal latihan -->
                    <div class="col-12 mb-4">
                        <label class="form-label">
                            Jadwal Latihan <span class="opt">(Opsional)</span>
                        </label>

                        <div class="schedule-box">
                            <div class="row g-3">

                                <!-- Hari -->
                                <div class="col-md-4">
                                    <span class="schedule-label-mini">Hari</span>
                                    <select id="hari" class="form-select">
                                        <option value="">Pilih Hari</option>
                                        @foreach ($hariList as $h)
                                            <option value="{{ $h }}" {{ $hariTerpilih === $h ? 'selected' : '' }}>
                                                {{ $h }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Jam mulai -->
                                <div class="col-md-4">
                                    <span class="schedule-label-mini">Jam Mulai</span>
                                    <div class="time-pair">
                                        <select id="jam_mulai_h" class="form-select">
                                            <option value="">Jam</option>
                                            @foreach ($jamOptions as $j)
                                                <option value="{{ $j }}" {{ $jamMulaiH === $j ? 'selected' : '' }}>
                                                    {{ $j }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="time-sep">:</span>
                                        <select id="jam_mulai_m" class="form-select">
                                            <option value="">Menit</option>
                                            @foreach ($menitOptions as $m)
                                                <option value="{{ $m }}" {{ $jamMulaiM === $m ? 'selected' : '' }}>
                                                    {{ $m }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Jam selesai -->
                                <div class="col-md-4">
                                    <span class="schedule-label-mini">Jam Selesai</span>
                                    <div class="time-pair">
                                        <select id="jam_selesai_h" class="form-select">
                                            <option value="">Jam</option>
                                            @foreach ($jamOptions as $j)
                                                <option value="{{ $j }}" {{ $jamSelesaiH === $j ? 'selected' : '' }}>
                                                    {{ $j }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="time-sep">:</span>
                                        <select id="jam_selesai_m" class="form-select">
                                            <option value="">Menit</option>
                                            @foreach ($menitOptions as $m)
                                                <option value="{{ $m }}" {{ $jamSelesaiM === $m ? 'selected' : '' }}>
                                                    {{ $m }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden input: nilai akhir ke server -->
                        <input type="hidden"
                               name="jadwal_latihan"
                               id="jadwal_latihan"
                               value="{{ $jadwalLama }}">

                        @error('jadwal_latihan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <!-- Preview jadwal -->
                        <div id="schedulePreview" class="schedule-preview empty">
                            <i class="far fa-clock"></i>
                            <span id="schedulePreviewText">Belum ada jadwal</span>
                        </div>
                    </div>

                </div>

                <!-- Section: Deskripsi -->
                <div class="section-title mt-2">
                    <i class="fas fa-align-left"></i>Deskripsi
                </div>
                <hr class="section-divider">

                <div class="mb-4">
                    <label for="deskripsi" class="form-label">
                        Deskripsi <span class="opt">(Opsional)</span>
                    </label>
                    <textarea id="deskripsi"
                              name="deskripsi"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="5"
                              placeholder="Tulis deskripsi kegiatan ekstrakurikuler di sini...">{{ old('deskripsi', $extracurricular->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Section: Gambar -->
                <div class="section-title mt-2">
                    <i class="fas fa-image"></i>Gambar Ekstrakurikuler
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
                    @if ($isEdit && $extracurricular->gambar)
                        <div class="photo-wrapper">
                            <span class="photo-label">Gambar saat ini:</span>
                            <img src="{{ asset('storage/' . $extracurricular->gambar) }}"
                                 alt="{{ $extracurricular->nama_ekskul }}"
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
                    <a href="{{ route('admin.extracurricular.index') }}" class="btn btn-cancel">
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

<!-- Script jadwal + preview gambar + tutup alert -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    // ==== Jadwal: gabung hari + jam ====
    const hariSelect       = document.getElementById('hari');
    const jamMulaiHInput   = document.getElementById('jam_mulai_h');
    const jamMulaiMInput   = document.getElementById('jam_mulai_m');
    const jamSelesaiHInput = document.getElementById('jam_selesai_h');
    const jamSelesaiMInput = document.getElementById('jam_selesai_m');
    const jadwalInput      = document.getElementById('jadwal_latihan');
    const previewBox       = document.getElementById('schedulePreview');
    const previewText      = document.getElementById('schedulePreviewText');

    function updateJadwal() {
        if (!hariSelect || !jadwalInput) return;

        const hari = hariSelect.value.trim();

        const jmH = jamMulaiHInput ? jamMulaiHInput.value : '';
        const jmM = jamMulaiMInput ? jamMulaiMInput.value : '';
        const jamMulai = (jmH && jmM) ? jmH + ':' + jmM : '';

        const jsH = jamSelesaiHInput ? jamSelesaiHInput.value : '';
        const jsM = jamSelesaiMInput ? jamSelesaiMInput.value : '';
        const jamSelesai = (jsH && jsM) ? jsH + ':' + jsM : '';

        let jamStr = '';
        if (jamMulai && jamSelesai)  jamStr = jamMulai + ' - ' + jamSelesai;
        else if (jamMulai)           jamStr = jamMulai;
        else if (jamSelesai)         jamStr = jamSelesai;

        let hasil = '';
        if (hari && jamStr)     hasil = hari + ', ' + jamStr;
        else if (hari)          hasil = hari;
        else if (jamStr)        hasil = jamStr;

        jadwalInput.value = hasil;

        if (previewBox && previewText) {
            if (hasil) {
                previewBox.classList.remove('empty');
                previewText.textContent = hasil;
            } else {
                previewBox.classList.add('empty');
                previewText.textContent = 'Belum ada jadwal';
            }
        }
    }

    [hariSelect, jamMulaiHInput, jamMulaiMInput, jamSelesaiHInput, jamSelesaiMInput].forEach(function (el) {
        if (el) el.addEventListener('change', updateJadwal);
    });

    updateJadwal();

    // ==== Preview gambar ====
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

    // ==== Tutup alert manual ====
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