@extends('layouts.template')

@section('content')

<style>
    /* =========================
       CARD DETAIL
    ========================== */
    .detail-card {
        background-color: #ffffff;
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* =========================
       HEADER
    ========================== */
    .detail-header {
        background-color: #273b69;
        color: #ffffff;
        padding: 22px 25px;
    }

    /* =========================
       ICON PROFILE
    ========================== */
    .student-icon {
        width: 90px;
        height: 90px;
        background-color: #f1f5f9;
        color: #273b69;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        flex-shrink: 0;
    }

    /* =========================
       DETAIL ITEM
    ========================== */
    .detail-item {
        padding: 18px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .detail-value {
        color: #1e293b;
        font-size: 1rem;
        font-weight: 600;
    }

    /* =========================
       BADGE JENIS KELAMIN
    ========================== */
    .badge-lk {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, 0.2);
    }

    .badge-pr {
        background-color: rgba(214, 51, 132, 0.1);
        color: #d63384;
        border: 1px solid rgba(214, 51, 132, 0.2);
    }

    /* =========================
       ACTION BUTTON
    ========================== */
    .btn-edit {
        background-color: #273b69;
        border: none;
        color: #ffffff;
    }

    .btn-edit:hover {
        background-color: #1f3158;
        color: #ffffff;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 576px) {
        .detail-header {
            padding: 18px;
        }

        .detail-header-content {
            flex-direction: column;
            text-align: center;
        }

        .student-icon {
            width: 80px;
            height: 80px;
            font-size: 2.2rem;
        }

        .detail-card .card-body {
            padding: 20px !important;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn,
        .action-buttons form {
            width: 100%;
        }

        .action-buttons form button {
            width: 100%;
        }
    }
</style>


<div class="container-fluid p-0">

    <!-- =========================
         HEADER HALAMAN
    ========================== -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h2
                class="fw-bold text-dark mb-1"
                style="font-family: 'Poppins', sans-serif;"
            >
                Detail Siswa
            </h2>

            <p class="text-muted mb-0">
                Informasi lengkap mengenai peserta didik.
            </p>
        </div>

        <a
            href="{{ route('admin.siswa') }}"
            class="btn btn-secondary px-4 py-2 shadow-sm"
        >
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>

    </div>


    <!-- =========================
         CARD DETAIL
    ========================== -->
    <div class="card detail-card mb-5">

        <!-- HEADER CARD -->
        <div class="detail-header">

            <div class="d-flex align-items-center gap-4 detail-header-content">

                <div class="student-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>

                <div>
                    <h4 class="fw-bold mb-1">
                        {{ $student->nama_siswa }}
                    </h4>

                    <p class="mb-0 opacity-75">
                        NISN: {{ $student->nisn }}
                    </p>
                </div>

            </div>

        </div>


        <!-- BODY CARD -->
        <div class="card-body p-4 p-md-5">

            <!-- =========================
                 INFORMASI SISWA
            ========================== -->
            <div class="mb-4">

                <h5
                    class="fw-bold mb-3"
                    style="color: #273b69;"
                >
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Siswa
                </h5>

                <div class="row">

                    <!-- NISN -->
                    <div class="col-md-6">

                        <div class="detail-item">

                            <div class="detail-label">
                                NISN
                            </div>

                            <div class="detail-value">
                                {{ $student->nisn }}
                            </div>

                        </div>

                    </div>


                    <!-- Nama -->
                    <div class="col-md-6">

                        <div class="detail-item">

                            <div class="detail-label">
                                Nama Siswa
                            </div>

                            <div class="detail-value">
                                {{ $student->nama_siswa }}
                            </div>

                        </div>

                    </div>


                    <!-- Jenis Kelamin -->
                    <div class="col-md-6">

                        <div class="detail-item">

                            <div class="detail-label">
                                Jenis Kelamin
                            </div>

                            <div class="detail-value">

                                @if ($student->jenis_kelamin === 'Laki-Laki')

                                    <span class="badge badge-lk px-3 py-2 rounded-pill fw-normal">
                                        <i class="fas fa-mars me-1"></i>
                                        Laki-Laki
                                    </span>

                                @else

                                    <span class="badge badge-pr px-3 py-2 rounded-pill fw-normal">
                                        <i class="fas fa-venus me-1"></i>
                                        Perempuan
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    <!-- Tahun Masuk -->
                    <div class="col-md-6">

                        <div class="detail-item">

                            <div class="detail-label">
                                Tahun Masuk
                            </div>

                            <div class="detail-value">
                                {{ $student->tahun_masuk }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =========================
                 INFORMASI SISTEM
            ========================== -->
            <div class="mb-4">

                <h5
                    class="fw-bold mb-3"
                    style="color: #273b69;"
                >
                    <i class="fas fa-database me-2"></i>
                    Informasi Data
                </h5>

                <div class="row">

                    <!-- ID -->
                    <div class="col-md-6">

                        <div class="detail-item">

                            <div class="detail-label">
                                ID Data
                            </div>

                            <div class="detail-value">
                                {{ $student->id }}
                            </div>

                        </div>

                    </div>


                    <!-- Dibuat -->
                    <div class="col-md-6">

                        <div class="detail-item">

                            <div class="detail-label">
                                Data Dibuat
                            </div>

                            <div class="detail-value">
                                {{ $student->created_at ? $student->created_at->format('d F Y, H:i') : '-' }}
                            </div>

                        </div>

                    </div>


                    <!-- Diperbarui -->
                    <div class="col-md-6">

                        <div class="detail-item">

                            <div class="detail-label">
                                Terakhir Diperbarui
                            </div>

                            <div class="detail-value">
                                {{ $student->updated_at ? $student->updated_at->format('d F Y, H:i') : '-' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =========================
                 TOMBOL AKSI
            ========================== -->
            <div class="border-top pt-4 mt-4">

                <div class="d-flex justify-content-end gap-2 flex-wrap action-buttons">

                    <!-- Kembali -->
                    <a
                        href="{{ route('admin.siswa') }}"
                        class="btn btn-secondary px-4 py-2"
                    >
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali
                    </a>


                    <!-- Edit -->
                    @php
                        $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($student->id);
                    @endphp

                    <a
                        href="{{ route('admin.siswa.edit', $encryptedId) }}"
                        class="btn btn-edit px-4 py-2 shadow-sm"
                    >
                        <i class="fas fa-edit me-2"></i>
                        Edit Data
                    </a>


                    <!-- Hapus -->
                    <form
                        action="{{ route('admin.siswa.destroy', $encryptedId) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger px-4 py-2 shadow-sm"
                        >
                            <i class="fas fa-trash-alt me-2"></i>
                            Hapus Data
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection