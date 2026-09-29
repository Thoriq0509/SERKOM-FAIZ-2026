@extends('layouts.template')

@section('content')

@php
    $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($student->id);
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
       CARD
    ========================== */
    .card-clean {
        background-color: #fff;
        border: 1px solid var(--c-border);
        border-radius: 10px;
        box-shadow: 0 1px 2px rgba(15,23,42,.04);
        overflow: hidden;
    }

    /* =========================
       HERO HEADER
    ========================== */
    .hero-head {
        padding: 24px 26px;
        border-bottom: 1px solid var(--c-border);
        background-color: #fff;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .hero-icon {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        background-color: var(--c-soft);
        color: var(--c-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        flex-shrink: 0;
    }

    .hero-name {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--c-primary-d);
        margin: 0 0 4px;
    }

    .hero-meta {
        font-size: .82rem;
        color: var(--c-text-soft);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
    }

    .hero-meta .dot {
        width: 3px;
        height: 3px;
        background-color: #cbd5e1;
        border-radius: 50%;
        display: inline-block;
    }

    /* =========================
       BODY
    ========================== */
    .card-body-clean {
        padding: 28px 26px;
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
       DETAIL GRID
    ========================== */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 24px;
        border: 1px solid var(--c-border);
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 28px;
    }

    .detail-item {
        padding: 16px 20px;
        border-bottom: 1px solid var(--c-border);
    }

    .detail-item:nth-last-child(-n+2) {
        border-bottom: none;
    }

    .detail-item:nth-child(odd) {
        border-right: 1px solid var(--c-border);
    }

    .detail-label {
        color: var(--c-text-soft);
        font-size: .75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
        margin-bottom: 6px;
    }

    .detail-value {
        color: var(--c-primary-d);
        font-size: .92rem;
        font-weight: 600;
        word-break: break-word;
    }

    .detail-value.mono {
        font-family: 'Courier New', monospace;
        font-weight: 500;
        font-size: .86rem;
        color: var(--c-text);
    }

    /* =========================
       BADGE JENIS KELAMIN
    ========================== */
    .badge-jk {
        font-size: .75rem;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 20px;
        border: 1px solid;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-jk.lk {
        background-color: #eff6ff;
        border-color: #bfdbfe;
        color: #1d4ed8;
    }

    .badge-jk.pr {
        background-color: #fdf2f8;
        border-color: #fbcfe8;
        color: #be185d;
    }

    /* =========================
       ACTION BAR
    ========================== */
    .action-bar {
        border-top: 1px solid var(--c-border);
        padding-top: 20px;
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
        padding: 9px 20px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-cancel:hover {
        background-color: var(--c-bg);
        border-color: #cbd5e1;
        color: var(--c-primary-d);
    }

    .btn-primary-soft {
        background-color: var(--c-primary);
        border: 1px solid var(--c-primary);
        color: #fff;
        font-size: .875rem;
        font-weight: 500;
        padding: 9px 20px;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .btn-primary-soft:hover {
        background-color: var(--c-primary-d);
        border-color: var(--c-primary-d);
        color: #fff;
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
    @media (max-width: 767.98px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-item {
            border-right: none !important;
        }

        .detail-item:nth-last-child(-n+2) {
            border-bottom: 1px solid var(--c-border);
        }

        .detail-item:last-child {
            border-bottom: none;
        }
    }

    @media (max-width: 576px) {
        .hero-head {
            padding: 18px 16px;
            gap: 14px;
        }

        .hero-icon {
            width: 54px;
            height: 54px;
            font-size: 1.3rem;
        }

        .hero-name { font-size: 1rem; }

        .card-body-clean { padding: 20px 16px; }

        .action-bar {
            flex-direction: column-reverse;
        }

        .action-bar .btn,
        .action-bar form {
            width: 100%;
        }

        .action-bar form button {
            width: 100%;
        }
    }
</style>

<div class="container-fluid p-0">

    {{-- HEADER HALAMAN --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Detail Siswa</h2>
            <p class="page-subtitle">Informasi lengkap mengenai peserta didik.</p>
        </div>

        <a href="{{ route('admin.siswa') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- CARD DETAIL --}}
    <div class="card-clean mb-5">

        {{-- HERO HEADER --}}
        <div class="hero-head">
            <div class="hero-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div>
                <h4 class="hero-name">{{ $student->nama_siswa }}</h4>
                <div class="hero-meta">
                    <span>NISN: {{ $student->nisn }}</span>
                    <span class="dot"></span>
                    <span>Tahun Masuk: {{ $student->tahun_masuk }}</span>
                </div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="card-body-clean">

            {{-- INFORMASI SISWA --}}
            <div class="section-title">
                <i class="fas fa-id-card"></i>Informasi Siswa
            </div>
            <hr class="section-divider">

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">NISN</div>
                    <div class="detail-value mono">{{ $student->nisn }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Nama Siswa</div>
                    <div class="detail-value">{{ $student->nama_siswa }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Jenis Kelamin</div>
                    <div class="detail-value">
                        @if ($student->jenis_kelamin === 'Laki-Laki')
                            <span class="badge-jk lk">
                                <i class="fas fa-mars"></i>Laki-Laki
                            </span>
                        @else
                            <span class="badge-jk pr">
                                <i class="fas fa-venus"></i>Perempuan
                            </span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tahun Masuk</div>
                    <div class="detail-value">{{ $student->tahun_masuk }}</div>
                </div>
            </div>

            {{-- INFORMASI DATA --}}
            <div class="section-title">
                <i class="fas fa-database"></i>Informasi Data
            </div>
            <hr class="section-divider">

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">ID Data</div>
                    <div class="detail-value mono">#{{ $student->id }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Data Dibuat</div>
                    <div class="detail-value">
                        {{ $student->created_at ? $student->created_at->format('d F Y, H:i') : '-' }}
                    </div>
                </div>

                <div class="detail-item" style="grid-column: 1 / -1;">
                    <div class="detail-label">Terakhir Diperbarui</div>
                    <div class="detail-value">
                        {{ $student->updated_at ? $student->updated_at->format('d F Y, H:i') : '-' }}
                    </div>
                </div>
            </div>

            {{-- ACTION BAR --}}
            <div class="action-bar">
                <a href="{{ route('admin.siswa') }}" class="btn btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>

                <a href="{{ route('admin.siswa.edit', $encryptedId) }}" class="btn btn-primary-soft">
                    <i class="fas fa-edit me-2"></i>Edit Data
                </a>

                <form action="{{ route('admin.siswa.destroy', $encryptedId) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-soft">
                        <i class="fas fa-trash-alt me-2"></i>Hapus Data
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection