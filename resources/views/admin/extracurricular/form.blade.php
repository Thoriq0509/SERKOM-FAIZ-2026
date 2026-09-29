@extends('layouts.template')

@section('content')

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
       SCHEDULE PICKER
    ========================== */
    .schedule-box {
        background-color: var(--c-bg);
        border: 1px solid var(--c-border);
        border-radius: 8px;
        padding: 16px;
    }

    .schedule-label-mini {
        font-size: .72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
        color: var(--c-text-soft);
        margin-bottom: 6px;
        display: block;
    }

    .time-pair {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .time-pair .form-select {
        flex: 1;
        min-width: 0;
    }

    .time-sep {
        color: var(--c-text-soft);
        font-weight: 600;
        font-size: .9rem;
        flex-shrink: 0;
    }

    /* =========================
       SCHEDULE PREVIEW
    ========================== */
    .schedule-preview {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 14px;
        padding: 6px 14px;
        border-radius: 20px;
        background-color: #fff;
        border: 1px solid var(--c-border);
        font-size: .78rem;
        color: var(--c-text);
    }

    .schedule-preview i {
        color: var(--c-primary);
        font-size: .75rem;
    }

    .schedule-preview.empty {
        color: var(--c-text-soft);
        font-style: italic;
    }

    /* =========================
       IMAGE PREVIEW
    ========================== */
    .photo-preview-box {
        width: 180px;
        height: 180px;
        padding: 4px;
        background-color: #fff;
        border: 1px solid var(--c-border);
        border-radius: 50%;
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
    }
</style>

<div class="container-fluid p-0">

    {{-- PAGE HEADER --}}
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

                {{-- SECTION: INFORMASI EKSKUL --}}
                <div class="section-title">
                    <i class="fas fa-circle-info"></i>Informasi Ekstrakurikuler
                </div>
                <hr class="section-divider">

                {{-- INFO BOX --}}
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

                    {{-- Nama Ekskul --}}
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

                    {{-- Pembina --}}
                    <div class="col-md-6 mb-4">
                        <label for="pembina" class="form-label">
                            Pembina <span class="opt">(Opsional)</span>
                        </label>
                        <input type="text"
                               id="pembina"
                               name="pembina"
                               class="form-control @error('pembina') is-invalid @enderror"
                               value="{{ old('pembina', $extracurricular->pembina ?? '') }}"
                               maxlength="40"
                               placeholder="Contoh: Budi Santoso, S.Pd.">
                        @error('pembina')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-hint">Maksimal 40 karakter.</small>
                    </div>

                    {{-- ✅ JADWAL LATIHAN: Format 24 Jam --}}
                    <div class="col-12 mb-4">
                        <label class="form-label">
                            Jadwal Latihan <span class="opt">(Opsional)</span>
                        </label>

                        <div class="schedule-box">
                            <div class="row g-3">

                                {{-- Hari --}}
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

                                {{-- Jam Mulai --}}
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

                                {{-- Jam Selesai --}}
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

                        {{-- Hidden input: nilai akhir yang dikirim ke server --}}
                        <input type="hidden"
                               name="jadwal_latihan"
                               id="jadwal_latihan"
                               value="{{ $jadwalLama }}">

                        @error('jadwal_latihan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- Preview jadwal final --}}
                        <div id="schedulePreview" class="schedule-preview empty">
                            <i class="far fa-clock"></i>
                            <span id="schedulePreviewText">Belum ada jadwal</span>
                        </div>
                    </div>

                </div>

                {{-- SECTION: DESKRIPSI --}}
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

                {{-- SECTION: GAMBAR --}}
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

                    {{-- Gambar saat ini --}}
                    @if ($isEdit && $extracurricular->gambar)
                        <div class="photo-wrapper">
                            <span class="photo-label">Gambar saat ini:</span>
                            <img src="{{ asset('storage/' . $extracurricular->gambar) }}"
                                 alt="{{ $extracurricular->nama_ekskul }}"
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

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ============ JADWAL: GABUNG HARI + JAM 24 ============ */
    const hariSelect      = document.getElementById('hari');
    const jamMulaiHInput  = document.getElementById('jam_mulai_h');
    const jamMulaiMInput  = document.getElementById('jam_mulai_m');
    const jamSelesaiHInput = document.getElementById('jam_selesai_h');
    const jamSelesaiMInput = document.getElementById('jam_selesai_m');
    const jadwalInput     = document.getElementById('jadwal_latihan');
    const previewBox      = document.getElementById('schedulePreview');
    const previewText     = document.getElementById('schedulePreviewText');

    function updateJadwal() {
        if (!hariSelect || !jadwalInput) return;

        const hari = hariSelect.value.trim();

        // Gabung jam mulai (HH:MM)
        const jmH = jamMulaiHInput ? jamMulaiHInput.value : '';
        const jmM = jamMulaiMInput ? jamMulaiMInput.value : '';
        const jamMulai = (jmH && jmM) ? jmH + ':' + jmM : '';

        // Gabung jam selesai (HH:MM)
        const jsH = jamSelesaiHInput ? jamSelesaiHInput.value : '';
        const jsM = jamSelesaiMInput ? jamSelesaiMInput.value : '';
        const jamSelesai = (jsH && jsM) ? jsH + ':' + jsM : '';

        // Gabung jam mulai - selesai
        let jamStr = '';
        if (jamMulai && jamSelesai)  jamStr = jamMulai + ' - ' + jamSelesai;
        else if (jamMulai)           jamStr = jamMulai;
        else if (jamSelesai)         jamStr = jamSelesai;

        // Gabung hari + jam
        let hasil = '';
        if (hari && jamStr)     hasil = hari + ', ' + jamStr;
        else if (hari)          hasil = hari;
        else if (jamStr)        hasil = jamStr;

        // Set ke hidden input
        jadwalInput.value = hasil;

        // Update preview
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

    // Pasang listener ke semua dropdown
    [hariSelect, jamMulaiHInput, jamMulaiMInput, jamSelesaiHInput, jamSelesaiMInput].forEach(function (el) {
        if (el) el.addEventListener('change', updateJadwal);
    });

    // Jalankan sekali saat load (untuk edit mode)
    updateJadwal();

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