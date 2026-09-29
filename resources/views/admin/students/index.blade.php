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
                Data Siswa
            </h2>

            <p class="text-muted mb-0">
                Kelola data peserta didik sekolah.
            </p>
        </div>

        <a
            href="{{ route('admin.siswa.create') }}"
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

        <!-- Header Card -->
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

            <h6 class="mb-0 fw-bold fs-6">
                <i class="fas fa-user-graduate me-2"></i>
                Daftar Peserta Didik
            </h6>

            <span class="small opacity-75">
                Total: {{ $students->total() }} siswa
            </span>

        </div>


        <!-- Body Card -->
        <div class="card-body p-0">

            <!-- =========================
                 TABEL RESPONSIVE
            ========================== -->
            <div class="table-responsive">

                <table class="table table-custom">

                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">NISN</th>
                            <th width="30%">Nama Siswa</th>
                            <th width="15%" class="text-center">
                                Jenis Kelamin
                            </th>
                            <th width="15%" class="text-center">
                                Tahun Masuk
                            </th>
                            <th width="20%" class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($students as $student)

                            @php
                                $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($student->id);
                            @endphp

                            <tr>

                                <!-- Nomor -->
                                <td>
                                    {{ $students->firstItem() + $loop->index }}
                                </td>


                                <!-- NISN -->
                                <td class="fw-semibold text-secondary">
                                    {{ $student->nisn }}
                                </td>


                                <!-- Nama Siswa -->
                                <td class="fw-bold text-dark">
                                    {{ $student->nama_siswa }}
                                </td>


                                <!-- Jenis Kelamin -->
                                <td class="text-center">

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

                                </td>


                                <!-- Tahun Masuk -->
                                <td class="text-center fw-bold text-secondary">
                                    {{ $student->tahun_masuk }}
                                </td>


                                <!-- Aksi -->
                                <td class="text-center text-nowrap">

                                    <!-- Detail -->
                                    <a
                                        href="{{ route('admin.siswa.show', $encryptedId) }}"
                                        class="btn btn-info btn-sm btn-action text-white shadow-sm me-1"
                                        title="Lihat Detail"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </a>


                                    <!-- Edit -->
                                    <a
                                        href="{{ route('admin.siswa.edit', $encryptedId) }}"
                                        class="btn btn-warning btn-sm btn-action text-white shadow-sm me-1"
                                        title="Edit Data"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>


                                    <!-- Hapus -->
                                    <form
                                        action="{{ route('admin.siswa.destroy', $encryptedId) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');"
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

                            <tr>

                                <td colspan="6">

                                    <div class="empty-state">

                                        <i class="fas fa-user-graduate d-block"></i>

                                        <h6 class="fw-bold text-secondary">
                                            Belum Ada Data Siswa
                                        </h6>

                                        <p class="mb-3">
                                            Data peserta didik belum tersedia.
                                        </p>

                                        <a
                                            href="{{ route('admin.siswa.create') }}"
                                            class="btn btn-sm text-white px-3"
                                            style="background-color: #273b69; border: none;"
                                        >
                                            <i class="fas fa-plus me-1"></i>
                                            Tambah Siswa
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
            @if ($students->hasPages())

                <div class="p-3 border-top bg-light">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <small class="text-muted">
                            Menampilkan
                            <strong>{{ $students->firstItem() }}</strong>
                            sampai
                            <strong>{{ $students->lastItem() }}</strong>
                            dari
                            <strong>{{ $students->total() }}</strong>
                            data siswa
                        </small>

                        <div>
                            {{ $students->links() }}
                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection