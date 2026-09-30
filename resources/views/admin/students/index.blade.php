@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/students.css') }}">
@endpush

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Data Siswa</h2>
            <p class="page-subtitle">Kelola data peserta didik sekolah.</p>
        </div>

        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary-soft">
            <i class="fas fa-plus me-2"></i>Tambah Data
        </a>
    </div>

    <!-- Alert sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-soft alert-dismissible fade show" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-text">{{ session('success') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Alert error -->
    @if (session('error'))
        <div class="alert alert-danger alert-soft alert-dismissible fade show" role="alert" data-alert>
            <i class="fas fa-exclamation-circle"></i>
            <span class="alert-text">{{ session('error') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Card tabel -->
    <div class="card-clean">

        <div class="card-head">
            <h6><i class="fas fa-user-graduate me-2"></i>Daftar Peserta Didik</h6>
            <span class="count">Total: {{ $students->total() }} siswa</span>
        </div>

        <div class="table-responsive">
            <table class="table table-clean">

                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">NISN</th>
                        <th width="30%">Nama Siswa</th>
                        <th width="15%" class="text-center">Jenis Kelamin</th>
                        <th width="15%" class="text-center">Tahun Masuk</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($students as $student)
                        @php
                            $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($student->id);
                        @endphp

                        <tr>
                            <td>{{ $students->firstItem() + $loop->index }}</td>

                            <td class="cell-nisn">{{ $student->nisn }}</td>

                            <td class="cell-name">{{ $student->nama_siswa }}</td>

                            <td class="text-center">
                                @if ($student->jenis_kelamin === 'Laki-Laki')
                                    <span class="badge-jk lk">
                                        <i class="fas fa-mars"></i>Laki-Laki
                                    </span>
                                @else
                                    <span class="badge-jk pr">
                                        <i class="fas fa-venus"></i>Perempuan
                                    </span>
                                @endif
                            </td>

                            <td class="text-center fw-semibold">{{ $student->tahun_masuk }}</td>

                            <td class="text-center text-nowrap">
                                <a href="{{ route('admin.siswa.show', $encryptedId) }}"
                                   class="btn-icon view me-1" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.siswa.edit', $encryptedId) }}"
                                   class="btn-icon edit me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.siswa.destroy', $encryptedId) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon delete" title="Hapus Data">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-user-graduate"></i>
                                    <h6>Belum Ada Data Siswa</h6>
                                    <p>Data peserta didik belum tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        @if ($students->hasPages())
            <div class="table-foot">
                <small>
                    Menampilkan <strong>{{ $students->firstItem() }}</strong>
                    sampai <strong>{{ $students->lastItem() }}</strong>
                    dari <strong>{{ $students->total() }}</strong> data siswa
                </small>
                <div>{{ $students->links() }}</div>
            </div>
        @endif

    </div>

</div>

<!-- Script tutup alert manual -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-alert-close]").forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const alertBox = btn.closest("[data-alert]");
            if (!alertBox) return;

            alertBox.style.transition = "opacity .2s ease";
            alertBox.style.opacity = "0";

            setTimeout(function () {
                alertBox.remove();
            }, 200);
        });
    });
});
</script>

@endsection