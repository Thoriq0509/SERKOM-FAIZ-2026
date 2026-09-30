@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/news.css') }}">
@endpush

@section('breadcrumb')
    <li>Kelola Berita</li>
@endsection

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Kelola Berita</h2>
            <p class="page-subtitle">Kelola berita dan informasi sekolah.</p>
        </div>

        <a href="{{ route('admin.news.create') }}" class="btn btn-primary-soft">
            <i class="fas fa-plus me-2"></i>Tambah Berita
        </a>
    </div>

    <!-- Alert sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-text">{{ session('success') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Alert error -->
    @if (session('error'))
        <div class="alert alert-danger alert-soft mb-4" role="alert" data-alert>
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
            <h6><i class="fas fa-newspaper me-2"></i>Daftar Berita Sekolah</h6>
            <span class="count">Total: {{ $news->count() ?? 0 }} berita</span>
        </div>

        <div class="p-3">
            <table id="tableNews" class="table table-clean align-middle" data-datatable style="width:100%">

                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="12%" data-orderable="false">Gambar</th>
                        <th width="35%">Judul Berita</th>
                        <th width="15%">Tanggal</th>
                        <th width="13%" class="text-center">Status</th>
                        <th width="20%" class="text-center" data-orderable="false">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($news as $item)
                        @php
                            $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($item->id);
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <!-- Thumbnail -->
                            <td>
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         alt="{{ $item->judul }}"
                                         class="news-thumb">
                                @else
                                    <div class="news-thumb-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Judul -->
                            <td>
                                <div class="news-title">{{ $item->judul }}</div>
                            </td>

                            <!-- Tanggal -->
                            <td>
                                <span class="news-date">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="text-center">
                                @if ($item->status === 'Publish')
                                    <span class="badge-status publish">
                                        <i class="fas fa-circle-check"></i>Publish
                                    </span>
                                @else
                                    <span class="badge-status draft">
                                        <i class="fas fa-circle-dot"></i>Draft
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="text-center text-nowrap">
                                <a href="{{ route('admin.news.show', $encryptedId) }}"
                                   class="btn-icon view me-1" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.news.edit', $encryptedId) }}"
                                   class="btn-icon edit me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.news.destroy', $encryptedId) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini? Data yang dihapus tidak dapat dikembalikan.');">
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
            const box = btn.closest("[data-alert]");
            if (!box) return;
            box.style.transition = "opacity .2s ease";
            box.style.opacity = "0";
            setTimeout(() => box.remove(), 200);
        });
    });
});
</script>

@endsection