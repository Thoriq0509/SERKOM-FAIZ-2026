@extends('layouts.template')

@section('content')

<style>
    /* ================================
       TABLE CARD
    ================================ */

    .table-card {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: none;
    }

    .table-card .card-header {
        background-color: #273b69;
        color: #ffffff;
        padding: 18px 24px;
        border: none;
        font-family: 'Poppins', sans-serif;
    }

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

    /* ================================
       FOTO GURU
    ================================ */

    .teacher-photo {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e2e8f0;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .teacher-photo-placeholder {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e2e8f0;
        color: #64748b;
        border: 2px solid #cbd5e1;
        font-size: 1.3rem;
    }

    /* ================================
       BUTTON AKSI
    ================================ */

    .btn-action {
        width: 34px;
        height: 34px;
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

    /* ================================
       EMPTY STATE
    ================================ */

    .empty-state {
        padding: 60px 20px;
        text-align: center;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    .empty-state h5 {
        color: #475569;
        font-weight: 600;
    }

    /* ================================
       HEADER PAGE
    ================================ */

    .page-title {
        font-family: 'Poppins', sans-serif;
    }

    .btn-main {
        background-color: #273b69;
        border: none;
        color: #ffffff;
    }

    .btn-main:hover {
        background-color: #1f3159;
        color: #ffffff;
    }

    /* ================================
       RESPONSIVE
    ================================ */

    @media (max-width: 767.98px) {

        .table-card .card-header {
            padding: 15px;
        }

        .table-custom th,
        .table-custom td {
            padding: 12px 15px;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .btn-main {
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
            <h2 class="page-title fw-bold text-dark mb-1">
                Data Guru
            </h2>

            <p class="text-muted mb-0">
                Kelola seluruh data tenaga pendidik sekolah.
            </p>
        </div>

        <a
            href="{{ route('admin.guru.create') }}"
            class="btn btn-main rounded-pill px-4 py-2 shadow-sm">

            <i class="fas fa-plus me-2"></i>
            Tambah Data Guru

        </a>

    </div>


    <!-- ================================
         ALERT SUCCESS
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
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    @endif


    <!-- ================================
         ALERT ERROR
    ================================ -->

    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show border-0 shadow-sm"
            role="alert">

            <i class="fas fa-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    @endif


    <!-- ================================
         CARD DATA GURU
    ================================ -->

    <div class="card table-card">

        <!-- CARD HEADER -->

        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

            <h6 class="mb-0 fw-bold">

                <i class="fas fa-chalkboard-teacher me-2"></i>
                Daftar Tenaga Pendidik

            </h6>

            <span class="badge bg-light text-dark rounded-pill px-3 py-2">

                Total:
                {{ $teachers->total() }}

                Guru

            </span>

        </div>


        <!-- CARD BODY -->

        <div class="card-body p-0">

            @if($teachers->count() > 0)

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

                            @foreach($teachers as $teacher)

                                @php

                                    $encryptedId = \Illuminate\Support\Facades\Crypt::encrypt(
                                        $teacher->id
                                    );

                                @endphp

                                <tr>

                                    <!-- Nomor -->
                                    <td>

                                        {{ $teachers->firstItem() + $loop->index }}

                                    </td>


                                    <!-- Foto -->
                                    <td class="text-center">

                                        @if($teacher->foto)

                                            <img
                                                src="{{ asset('storage/' . $teacher->foto) }}"
                                                alt="Foto {{ $teacher->nama_guru }}"
                                                class="teacher-photo">

                                        @else

                                            <div
                                                class="teacher-photo-placeholder mx-auto">

                                                <i class="fas fa-user"></i>

                                            </div>

                                        @endif

                                    </td>


                                    <!-- Nama Guru -->
                                    <td>

                                        <div class="fw-bold text-dark">

                                            {{ $teacher->nama_guru }}

                                        </div>

                                    </td>


                                    <!-- NIP -->
                                    <td>

                                        @if($teacher->nip)

                                            <span class="text-dark">
                                                {{ $teacher->nip }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    <!-- Mata Pelajaran -->
                                    <td>

                                        @if($teacher->mapel)

                                            <span
                                                class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill">

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
                                            title="Lihat Detail">

                                            <i class="fas fa-eye"></i>

                                        </a>


                                        <!-- Edit -->
                                        <a
                                            href="{{ route('admin.guru.edit', $encryptedId) }}"
                                            class="btn btn-warning btn-sm btn-action text-white shadow-sm me-1"
                                            title="Edit Data">

                                            <i class="fas fa-edit"></i>

                                        </a>


                                        <!-- Hapus -->
                                        <form
                                            action="{{ route('admin.guru.destroy', $encryptedId) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru {{ $teacher->nama_guru }}?');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm btn-action shadow-sm"
                                                title="Hapus Data">

                                                <i class="fas fa-trash-alt"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                <!-- ================================
                     PAGINATION
                ================================ -->

                @if($teachers->hasPages())

                    <div class="p-3 border-top bg-light">

                        {{ $teachers->links() }}

                    </div>

                @endif

            @else

                <!-- ================================
                     EMPTY STATE
                ================================ -->

                <div class="empty-state">

                    <i class="fas fa-chalkboard-teacher"></i>

                    <h5 class="mb-2">
                        Belum Ada Data Guru
                    </h5>

                    <p class="mb-3">
                        Belum ada tenaga pendidik yang tersimpan di database.
                    </p>

                    <a
                        href="{{ route('admin.guru.create') }}"
                        class="btn btn-main rounded-pill px-4">

                        <i class="fas fa-plus me-2"></i>
                        Tambah Guru Pertama

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection