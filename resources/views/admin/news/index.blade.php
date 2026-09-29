@extends('layouts.template')

@section('content')

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

    .btn-primary-soft {
        background-color: var(--c-primary);
        border: 1px solid var(--c-primary);
        color: #fff;
        font-size: .875rem;
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 8px;
        transition: all .15s ease;
    }

    .btn-primary-soft:hover {
        background-color: var(--c-primary-d);
        border-color: var(--c-primary-d);
        color: #fff;
    }

    /* =========================
       ALERT
    ========================== */
    .alert-soft {
        border: 1px solid;
        border-radius: 8px;
        font-size: .875rem;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-soft .alert-text { flex: 1; }

    .alert-soft.alert-success {
        background-color: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }

    .alert-soft.alert-danger {
        background-color: #fef2f2;
        border-color: #fecaca;
        color: #991b1b;
    }

    .alert-soft .alert-close {
        background: transparent;
        border: none;
        color: inherit;
        font-size: .9rem;
        opacity: .6;
        padding: 4px 6px;
        line-height: 1;
        cursor: pointer;
        border-radius: 4px;
        transition: opacity .15s ease, background .15s ease;
    }

    .alert-soft .alert-close:hover {
        opacity: 1;
        background: rgba(0,0,0,.06);
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

    .card-clean .card-head {
        padding: 16px 22px;
        border-bottom: 1px solid var(--c-border);
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
    }

    .card-clean .card-head h6 {
        margin: 0;
        font-size: .95rem;
        font-weight: 600;
        color: var(--c-primary-d);
    }

    .card-clean .card-head .count {
        font-size: .8rem;
        color: var(--c-text-soft);
        background-color: var(--c-soft);
        padding: 4px 10px;
        border-radius: 20px;
    }

    /* =========================
       TABEL
    ========================== */
    .table-clean {
        margin: 0;
        font-size: .875rem;
    }

    .table-clean thead th {
        background-color: var(--c-bg);
        color: var(--c-text-soft);
        font-weight: 600;
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 14px 20px;
        border-bottom: 1px solid var(--c-border);
        white-space: nowrap;
    }

    .table-clean tbody td {
        padding: 14px 20px;
        color: var(--c-text);
        border-bottom: 1px solid var(--c-border);
        vertical-align: middle;
    }

    .table-clean tbody tr:last-child td { border-bottom: none; }
    .table-clean tbody tr:hover { background-color: var(--c-bg); }

    /* =========================
       THUMBNAIL GAMBAR
    ========================== */
    .news-thumb {
        width: 80px;
        height: 55px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid var(--c-border);
        display: block;
    }

    .news-thumb-placeholder {
        width: 80px;
        height: 55px;
        border-radius: 6px;
        background-color: var(--c-soft);
        border: 1px solid var(--c-border);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--c-text-soft);
        font-size: .9rem;
    }

    /* =========================
       TEXT CELL
    ========================== */
    .news-title {
        font-weight: 600;
        color: var(--c-primary-d);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
    }

    .news-date {
        font-size: .82rem;
        color: var(--c-text-soft);
        font-family: 'Courier New', monospace;
    }

    /* =========================
       BADGE STATUS
    ========================== */
    .badge-status {
        font-size: .75rem;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 20px;
        border: 1px solid;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-status.publish {
        background-color: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }

    .badge-status.draft {
        background-color: var(--c-soft);
        border-color: var(--c-border);
        color: var(--c-text-soft);
    }

    /* =========================
       TOMBOL AKSI
    ========================== */
    .btn-icon {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: 1px solid;
        font-size: .8rem;
        transition: all .15s ease;
    }

    .btn-icon:hover { transform: translateY(-1px); }

    .btn-icon.view   { background:#eff6ff; border-color:#bfdbfe; color:#1d4ed8; }
    .btn-icon.view:hover { background:#dbeafe; color:#1e40af; }

    .btn-icon.edit   { background:#fffbeb; border-color:#fde68a; color:#b45309; }
    .btn-icon.edit:hover { background:#fef3c7; color:#92400e; }

    .btn-icon.delete { background:#fef2f2; border-color:#fecaca; color:#b91c1c; }
    .btn-icon.delete:hover { background:#fee2e2; color:#991b1b; }

    /* =========================
       EMPTY STATE
    ========================== */
    .empty-state {
        padding: 70px 20px;
        text-align: center;
        color: var(--c-text-soft);
    }

    .empty-state i {
        font-size: 2.5rem;
        color: #cbd5e1;
        margin-bottom: 14px;
        display: block;
    }

    .empty-state h6 {
        color: var(--c-primary-d);
        font-weight: 600;
        margin-bottom: 6px;
    }

    .empty-state p {
        margin: 0;
        font-size: .85rem;
    }

    /* =========================
       TABLE FOOTER (PAGINATION)
    ========================== */
    .table-foot {
        padding: 14px 22px;
        border-top: 1px solid var(--c-border);
        background-color: var(--c-bg);
        font-size: .8rem;
        color: var(--c-text-soft);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
</style>

<div class="container-fluid p-0">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Kelola Berita</h2>
            <p class="page-subtitle">Kelola berita dan informasi sekolah.</p>
        </div>

        <a href="{{ route('admin.news.create') }}" class="btn btn-primary-soft">
            <i class="fas fa-plus me-2"></i>Tambah Berita
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-text">{{ session('success') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-exclamation-circle"></i>
            <span class="alert-text">{{ session('error') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    {{-- CARD TABEL --}}
    <div class="card-clean">

        <div class="card-head">
            <h6><i class="fas fa-newspaper me-2"></i>Daftar Berita Sekolah</h6>
            <span class="count">Total: {{ $news->total() ?? 0 }} berita</span>
        </div>

        <div class="table-responsive">
            <table class="table table-clean">

                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="12%">Gambar</th>
                        <th width="35%">Judul Berita</th>
                        <th width="15%">Tanggal</th>
                        <th width="13%" class="text-center">Status</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($news as $index => $item)
                        @php
                            $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($item->id);
                        @endphp

                        <tr>
                            <td>{{ $news->firstItem() + $index }}</td>

                            {{-- Thumbnail --}}
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

                            {{-- Judul --}}
                            <td>
                                <div class="news-title">{{ $item->judul }}</div>
                            </td>

                            {{-- Tanggal --}}
                            <td>
                                <span class="news-date">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                </span>
                            </td>

                            {{-- Status --}}
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

                            {{-- Aksi --}}
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
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-newspaper"></i>
                                    <h6>Belum Ada Berita</h6>
                                    <p>Belum terdapat berita yang dipublikasikan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if (isset($news) && $news->hasPages())
            <div class="table-foot">
                <small>
                    Menampilkan <strong>{{ $news->firstItem() }}</strong>
                    sampai <strong>{{ $news->lastItem() }}</strong>
                    dari <strong>{{ $news->total() }}</strong> berita
                </small>
                <div>{{ $news->links() }}</div>
            </div>
        @endif

    </div>

</div>

{{-- FALLBACK CLOSE ALERT --}}
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