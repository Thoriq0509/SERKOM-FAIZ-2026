@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/extracurricular.css') }}">
@endpush

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Data Ekstrakurikuler</h2>
            <p class="page-subtitle">Kelola kegiatan ekstrakurikuler sekolah.</p>
        </div>

        <a href="{{ route('admin.extracurricular.create') }}" class="btn btn-primary-soft">
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
            <h6><i class="fas fa-basketball me-2"></i>Daftar Ekstrakurikuler</h6>
            <span class="count">Total: {{ $extracurriculars->total() ?? 0 }} ekstrakurikuler</span>
        </div>

        <div class="table-responsive">
            <table class="table table-clean">

                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%" class="text-center">Gambar</th>
                        <th width="20%">Nama</th>
                        <th width="18%">Pembina</th>
                        <th width="17%">Jadwal</th>
                        <th width="20%">Deskripsi</th>
                        <th width="10%" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($extracurriculars as $index => $item)
                        @php
                            $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($item->id);
                        @endphp

                        <tr>
                            <td>{{ $extracurriculars->firstItem() + $index }}</td>

                            <!-- Thumbnail -->
                            <td class="text-center">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         alt="{{ $item->nama_ekskul }}"
                                         class="thumb-round">
                                @else
                                    <div class="thumb-placeholder">
                                        <i class="fas fa-basketball"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Nama -->
                            <td>
                                <div class="cell-name">{{ $item->nama_ekskul }}</div>
                            </td>

                            <!-- Pembina -->
                            <td>
                                {{ $item->pembina ?: '-' }}
                            </td>

                            <!-- Jadwal -->
                            <td>
                                @if ($item->jadwal_latihan)
                                    <span class="schedule-pill">
                                        <i class="far fa-clock"></i>{{ $item->jadwal_latihan }}
                                    </span>
                                @else
                                    <span class="empty-val">Belum ada</span>
                                @endif
                            </td>

                            <!-- Deskripsi -->
                            <td>
                                <div class="cell-desc">
                                    {{ $item->deskripsi ?: 'Belum ada deskripsi' }}
                                </div>
                            </td>

                            <!-- Aksi -->
                            <td class="text-center text-nowrap">
                                <a href="{{ route('admin.extracurricular.show', $encryptedId) }}"
                                   class="btn-icon view me-1" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.extracurricular.edit', $encryptedId) }}"
                                   class="btn-icon edit me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.extracurricular.destroy', $encryptedId) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler {{ $item->nama_ekskul }}?');">
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
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-basketball"></i>
                                    <h6>Belum Ada Data Ekstrakurikuler</h6>
                                    <p>Belum terdapat kegiatan ekstrakurikuler yang terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        @if (isset($extracurriculars) && $extracurriculars->hasPages())
            <div class="table-foot">
                <small>
                    Menampilkan <strong>{{ $extracurriculars->firstItem() }}</strong>
                    sampai <strong>{{ $extracurriculars->lastItem() }}</strong>
                    dari <strong>{{ $extracurriculars->total() }}</strong> data
                </small>
                <div>{{ $extracurriculars->links() }}</div>
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