@extends('layouts.template')

@section('content')

<style>
    /* =========================
       CARD TABEL
    ========================== */
    .table-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: none;
    }

    /* =========================
       HEADER TABEL
    ========================== */
    .table-card .card-header {
        background-color: #273b69;
        color: #ffffff;
        padding: 16px 25px;
        font-family: 'Poppins', sans-serif;
        border-bottom: none;
    }

    /* =========================
       TABEL
    ========================== */
    .table-custom {
        margin-bottom: 0;
    }

    .table-custom th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        padding: 15px 20px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    .table-custom td {
        padding: 15px 20px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    .table-custom tbody tr:hover {
        background-color: #f8fafc;
    }

    /* =========================
       FOTO GURU
    ========================== */
    .teacher-photo {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e2e8f0;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .teacher-photo-placeholder {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f1f5f9;
        color: #64748b;
        border: 2px solid #e2e8f0;
        font-size: 1.2rem;
        margin: 0 auto;
    }

    /* =========================
       TOMBOL AKSI
    ========================== */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    /* =========================
       BADGE MAPEL
    ========================== */
    .badge-mapel {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, 0.2);
    }

    /* =========================
       EMPTY STATE
    ========================== */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 767.98px) {

        .table-card .card-header {
            padding: 15px;
        }

        .table-custom th,
        .table-custom td {
            padding: 12px 15px;
        }

        .btn-main {
            width: 100%;
        }
    }
</style>


<div class="container-fluid p-0">

    <!-- =========================
         HEADER
    ========================== -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

        <div>
            <h2
                class="fw-bold text-dark mb-1"
                style="font-family: 'Poppins', sans-serif;"
            >
                Data Guru
            </h2>

            <p class="text-muted mb-0">
                Kelola data tenaga pendidik sekolah.
            </p>
        </div>

        <a
            href="{{ route('admin.guru.create') }}"
            class="btn rounded-pill px-4 shadow-sm text-white"
            style="background-color: #273b69; border: none;"
        >
            <i class="fas fa-plus me-2"></i>
            Tambah Data
        </a>

    </div>


    <!-- =========================
         ALERT SUCCESS
    ========================== -->
    @if (session('success'))

        <div
            class="alert alert-success alert-dismissible fade show shadow-sm border-0"
            role="alert"
        >
            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"
            ></button>
        </div>

    @endif


    <!-- =========================
         ALERT ERROR
    ========================== -->
    @if (session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm border-0"
            role="alert"
        >
            <i class="fas fa-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"
            ></button>
        </div>

    @endif


    <!-- =========================
         CARD TABEL
    ========================== -->
    <div class="card table-card">

        <!-- HEADER CARD -->
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

            <h6 class="mb-0 fw-bold fs-6">
                <i class="fas fa-chalkboard-teacher me-2"></i>
                Daftar Tenaga Pendidik
            </h6>

            <span class="small opacity-75">
                Total: {{ $teachers->total() }} guru
            </span>

        </div>


        <!-- BODY CARD -->
        <div class="card-body p-0">

            <!-- =========================
                 TABEL RESPONSIVE
            ========================== -->
            <div class="table-responsive">

                <table class="table table-custom">

                    <thead>

                        <tr>

                            <th width="5%">
                                No
                            </th>

                            <th width="12%" class="text-center">
                                Foto
                            </th>

                            <th width="28%">
                                Nama Guru
                            </th>

                            <th width="20%">
                                NIP
                            </th>

                            <th width="20%">
                                Mata Pelajaran
                            </th>

                            <th width="15%" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($teachers as $teacher)

                            @php
                                $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($teacher->id);
                            @endphp

                            <tr>

                                <!-- Nomor -->
                                <td>
                                    {{ $teachers->firstItem() + $loop->index }}
                                </td>


                                <!-- Foto -->
                                <td class="text-center">

                                    @if ($teacher->foto)

                                        <img
                                            src="{{ asset('storage/' . $teacher->foto) }}"
                                            alt="Foto {{ $teacher->nama_guru }}"
                                            class="teacher-photo"
                                        >

                                    @else

                                        <div class="teacher-photo-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>

                                    @endif

                                </td>


                                <!-- Nama Guru -->
                                <td class="fw-bold text-dark">
                                    {{ $teacher->nama_guru }}
                                </td>


                                <!-- NIP -->
                                <td class="fw-semibold text-secondary">

                                    @if ($teacher->nip)

                                        {{ $teacher->nip }}

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                <!-- Mata Pelajaran -->
                                <td>

                                    @if ($teacher->mapel)

                                        <span class="badge badge-mapel px-3 py-2 rounded-pill fw-normal">
                                            {{ $teacher->mapel }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                <!-- Aksi -->
                                <td class="text-center text-nowrap">

                                    <!-- Detail -->
                                    <a
                                        href="{{ route('admin.guru.show', $encryptedId) }}"
                                        class="btn btn-info btn-sm btn-action text-white shadow-sm me-1"
                                        title="Lihat Detail"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </a>


                                    <!-- Edit -->
                                    <a
                                        href="{{ route('admin.guru.edit', $encryptedId) }}"
                                        class="btn btn-warning btn-sm btn-action text-white shadow-sm me-1"
                                        title="Edit Data"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>


                                    <!-- Hapus -->
                                    <form
                                        action="{{ route('admin.guru.destroy', $encryptedId) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru {{ $teacher->nama_guru }}?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm btn-action shadow-sm"
                                            title="Hapus Data"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <!-- =========================
                                 EMPTY STATE
                            ========================== -->
                            <tr>

                                <td colspan="6">

                                    <div class="empty-state">

                                        <i class="fas fa-chalkboard-teacher d-block"></i>

                                        <h6 class="fw-bold text-secondary">
                                            Belum Ada Data Guru
                                        </h6>

                                        <p class="mb-3">
                                            Data tenaga pendidik belum tersedia.
                                        </p>

                                        <a
                                            href="{{ route('admin.guru.create') }}"
                                            class="btn btn-sm text-white px-3"
                                            style="background-color: #273b69; border: none;"
                                        >
                                            <i class="fas fa-plus me-1"></i>
                                            Tambah Guru
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- =========================
                 PAGINATION
            ========================== -->
            @if ($teachers->hasPages())

                <div class="p-3 border-top bg-light">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <small class="text-muted">

                            Menampilkan
                            <strong>{{ $teachers->firstItem() }}</strong>
                            sampai
                            <strong>{{ $teachers->lastItem() }}</strong>
                            dari
                            <strong>{{ $teachers->total() }}</strong>
                            data guru

                        </small>

                        <div>
                            {{ $teachers->links() }}
                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection