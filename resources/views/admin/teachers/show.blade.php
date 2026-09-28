@extends('layouts.template')

@section('content')

<style>
    /* ================================
       DETAIL CARD
    ================================ */

    .detail-card {
        background-color: #ffffff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .detail-header {
        background-color: #273b69;
        color: #ffffff;
        padding: 20px 25px;
    }

    .detail-header h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        margin: 0;
    }

    .detail-body {
        padding: 30px;
    }

    /* ================================
       PROFILE
    ================================ */

    .profile-section {
        text-align: center;
        padding: 10px 0 30px;
    }

    .teacher-photo {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #ffffff;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
    }

    .teacher-photo-placeholder {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background-color: #f1f5f9;
        border: 3px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .teacher-photo-placeholder i {
        font-size: 4rem;
    }

    .teacher-name {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: #1e293b;
        margin-top: 18px;
        margin-bottom: 8px;
    }

    .subject-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: rgba(39, 59, 105, 0.08);
        color: #273b69;
        border: 1px solid rgba(39, 59, 105, 0.15);
        border-radius: 50px;
        padding: 8px 16px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* ================================
       INFORMATION
    ================================ */

    .info-card {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
    }

    .info-title {
        padding: 16px 20px;
        background-color: #f1f5f9;
        border-bottom: 1px solid #e2e8f0;
        color: #273b69;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
    }

    .info-row {
        display: flex;
        align-items: flex-start;
        padding: 16px 20px;
        border-bottom: 1px solid #e2e8f0;
        background-color: #ffffff;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        width: 35%;
        min-width: 150px;
        color: #64748b;
        font-weight: 600;
    }

    .info-value {
        flex: 1;
        color: #1e293b;
        font-weight: 500;
        word-break: break-word;
    }

    .empty-value {
        color: #94a3b8;
        font-style: italic;
    }

    /* ================================
       ACTION
    ================================ */

    .action-wrapper {
        border-top: 1px solid #e2e8f0;
        padding-top: 25px;
        margin-top: 30px;
    }

    .btn-main {
        background-color: #273b69;
        border: none;
        color: #ffffff;
        border-radius: 10px;
        padding: 10px 20px;
    }

    .btn-main:hover {
        background-color: #1f3159;
        color: #ffffff;
    }

    .btn-back {
        border-radius: 10px;
        padding: 10px 20px;
    }

    /* ================================
       RESPONSIVE
    ================================ */

    @media (max-width: 767.98px) {

        .detail-body {
            padding: 20px 15px;
        }

        .detail-header {
            padding: 18px 15px;
        }

        .teacher-photo,
        .teacher-photo-placeholder {
            width: 115px;
            height: 115px;
        }

        .teacher-photo-placeholder i {
            font-size: 3rem;
        }

        .teacher-name {
            font-size: 1.35rem;
        }

        .info-row {
            flex-direction: column;
            gap: 5px;
            padding: 14px 15px;
        }

        .info-label {
            width: 100%;
            min-width: unset;
        }

        .action-wrapper {
            flex-direction: column;
        }

        .action-wrapper a {
            width: 100%;
        }
    }
</style>


<div class="container-fluid p-0">

    <!-- ================================
         HEADER
    ================================ -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h2 class="fw-bold text-dark mb-1"
                style="font-family: 'Poppins', sans-serif;">

                Detail Guru

            </h2>

            <p class="text-muted mb-0">
                Informasi lengkap tenaga pendidik.
            </p>
        </div>


        <a
            href="{{ route('admin.guru') }}"
            class="btn btn-secondary btn-back">

            <i class="fas fa-arrow-left me-2"></i>
            Kembali

        </a>

    </div>


    <!-- ================================
         ALERT
    ================================ -->

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm"
            role="alert">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show border-0 shadow-sm"
            role="alert">

            <i class="fas fa-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ================================
         DETAIL GURU
    ================================ -->

    <div class="detail-card mb-5">

        <!-- Header Card -->

        <div class="detail-header">

            <div class="d-flex justify-content-between align-items-center">

                <h5>

                    <i class="fas fa-user-tie me-2"></i>
                    Informasi Guru

                </h5>

            </div>

        </div>


        <!-- Body -->

        <div class="detail-body">

            <!-- ================================
                 PROFILE
            ================================ -->

            <div class="profile-section">

                @if($teacher->foto)

                    <img
                        src="{{ asset('storage/' . $teacher->foto) }}"
                        alt="Foto {{ $teacher->nama_guru }}"
                        class="teacher-photo">

                @else

                    <div class="teacher-photo-placeholder">

                        <i class="fas fa-user"></i>

                    </div>

                @endif


                <h3 class="teacher-name">

                    {{ $teacher->nama_guru }}

                </h3>


                @if($teacher->mapel)

                    <div class="subject-badge">

                        <i class="fas fa-book-open"></i>

                        {{ $teacher->mapel }}

                    </div>

                @else

                    <div class="subject-badge">

                        <i class="fas fa-book-open"></i>

                        Mata pelajaran belum diisi

                    </div>

                @endif

            </div>


            <!-- ================================
                 INFORMASI DATA
            ================================ -->

            <div class="info-card">

                <div class="info-title">

                    <i class="fas fa-id-card me-2"></i>
                    Data Guru

                </div>


                <!-- Nama -->

                <div class="info-row">

                    <div class="info-label">
                        Nama Guru
                    </div>

                    <div class="info-value">

                        {{ $teacher->nama_guru }}

                    </div>

                </div>


                <!-- NIP -->

                <div class="info-row">

                    <div class="info-label">
                        NIP
                    </div>

                    <div class="info-value">

                        @if($teacher->nip)

                            {{ $teacher->nip }}

                        @else

                            <span class="empty-value">
                                NIP belum diisi
                            </span>

                        @endif

                    </div>

                </div>


                <!-- Mata Pelajaran -->

                <div class="info-row">

                    <div class="info-label">
                        Mata Pelajaran
                    </div>

                    <div class="info-value">

                        @if($teacher->mapel)

                            {{ $teacher->mapel }}

                        @else

                            <span class="empty-value">
                                Mata pelajaran belum diisi
                            </span>

                        @endif

                    </div>

                </div>


                <!-- Foto -->

                <div class="info-row">

                    <div class="info-label">
                        Foto Guru
                    </div>

                    <div class="info-value">

                        @if($teacher->foto)

                            <span class="text-success fw-semibold">

                                <i class="fas fa-check-circle me-1"></i>
                                Sudah tersedia

                            </span>

                        @else

                            <span class="empty-value">

                                Belum ada foto

                            </span>

                        @endif

                    </div>

                </div>


                <!-- Tanggal Dibuat -->

                <div class="info-row">

                    <div class="info-label">
                        Tanggal Ditambahkan
                    </div>

                    <div class="info-value">

                        {{ $teacher->created_at
                            ? $teacher->created_at->translatedFormat('d F Y, H:i')
                            : '-'
                        }}

                    </div>

                </div>


                <!-- Terakhir Diubah -->

                <div class="info-row">

                    <div class="info-label">
                        Terakhir Diperbarui
                    </div>

                    <div class="info-value">

                        {{ $teacher->updated_at
                            ? $teacher->updated_at->translatedFormat('d F Y, H:i')
                            : '-'
                        }}

                    </div>

                </div>

            </div>


            <!-- ================================
                 BUTTON ACTION
            ================================ -->

            @php
                $encryptedId = \Illuminate\Support\Facades\Crypt::encrypt($teacher->id);
            @endphp

            <div class="action-wrapper">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <a
                        href="{{ route('admin.guru') }}"
                        class="btn btn-secondary btn-back">

                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Data Guru

                    </a>


                    <div class="d-flex gap-2 flex-wrap">

                        <a
                            href="{{ route('admin.guru.edit', $encryptedId) }}"
                            class="btn btn-main">

                            <i class="fas fa-edit me-2"></i>
                            Edit Data Guru

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection