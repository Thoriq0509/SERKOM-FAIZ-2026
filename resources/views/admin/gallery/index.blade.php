@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/gallery.css') }}">
@endpush

@section('breadcrumb')
    <li>Kelola Galeri</li>
@endsection

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Kelola Galeri</h2>
            <p class="page-subtitle">Kelola album dan dokumentasi kegiatan sekolah.</p>
        </div>

        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary-soft">
            <i class="fas fa-plus me-2"></i>Tambah Media
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
            <h6><i class="fas fa-images me-2"></i>Daftar Galeri Sekolah</h6>
            <span class="count">Total: {{ $galleries->count() ?? 0 }} media</span>
        </div>

        <div class="p-3">
            <table id="tableGallery" class="table table-clean align-middle" data-datatable style="width:100%">

                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="13%" class="text-center" data-orderable="false">Preview</th>
                        <th width="35%">Judul & Keterangan</th>
                        <th width="13%" class="text-center">Kategori</th>
                        <th width="14%" class="text-center">Tanggal</th>
                        <th width="20%" class="text-center" data-orderable="false">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($galleries as $item)
                        @php
                            $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($item->id);
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <!-- Thumbnail -->
                            <td class="text-center">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         alt="{{ $item->judul }}"
                                         class="gallery-thumb">
                                @else
                                    <div class="gallery-thumb-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Judul + keterangan -->
                            <td>
                                <div class="cell-title">{{ $item->judul }}</div>
                                <div class="cell-desc">
                                    {{ $item->keterangan ?: 'Belum ada keterangan' }}
                                </div>
                            </td>

                            <!-- Kategori -->
                            <td class="text-center">
                                @if ($item->kategori === 'Foto')
                                    <span class="badge-cat photo">
                                        <i class="fas fa-camera"></i>Foto
                                    </span>
                                @elseif ($item->kategori === 'Video')
                                    <span class="badge-cat video">
                                        <i class="fas fa-video"></i>Video
                                    </span>
                                @else
                                    <span class="badge-cat other">
                                        {{ $item->kategori ?: 'Lainnya' }}
                                    </span>
                                @endif
                            </td>

                            <!-- Tanggal -->
                            <td class="text-center" data-order="{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') : '' }}">
                                <span class="cell-date">
                                    {{ $item->tanggal
                                        ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y')
                                        : '-'
                                    }}
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="text-center text-nowrap">
                                <a href="{{ route('admin.gallery.show', $encryptedId) }}"
                                   class="btn-icon view me-1" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.gallery.edit', $encryptedId) }}"
                                   class="btn-icon edit me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.gallery.destroy', $encryptedId) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus media galeri {{ $item->judul }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon delete" title="Hapus Data">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

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