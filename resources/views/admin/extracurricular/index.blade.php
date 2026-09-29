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
       PAGE HEADER
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
       TABLE
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
       THUMBNAIL
    ========================== */
    .thumb-round {
        width: 52px;
        height: 52px;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid var(--c-border);
        display: block;
        margin: 0 auto;
    }

    .thumb-placeholder {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background-color: var(--c-soft);
        border: 1px solid var(--c-border);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--c-text-soft);
        font-size: .95rem;
        margin: 0 auto;
    }

    /* =========================
       TEXT CELLS
    ========================== */
    .cell-name {
        font-weight: 600;
        color: var(--c-primary-d);
    }

    .cell-desc {
        font-size: .82rem;
        color: var(--c-text-soft);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
    }

    .schedule-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .75rem;
        padding: 4px 12px;
        border-radius: 20px;
        background-color: var(--c-soft);
        border: 1px solid var(--c-border);
        color: var(--c-text);
        white-space: nowrap;
    }

    .empty-val {
        color: var(--c-text-soft);
        font-style: italic;
        font-size: .82rem;
    }

    /* =========================
       ACTION BUTTONS
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
       PAGINATION FOOTER
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

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Data Ekstrakurikuler</h2>
            <p class="page-subtitle">Kelola kegiatan ekstrakurikuler sekolah.</p>
        </div>

        <a href="{{ route('admin.extracurricular.create') }}" class="btn btn-primary-soft">
            <i class="fas fa-plus me-2"></i>Tambah Data
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

    {{-- TABLE CARD --}}
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

                            {{-- Thumbnail --}}
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

                            {{-- ✅ Nama Ekstrakurikuler --}}
                            <td>
                                <div class="cell-name">{{ $item->nama_ekskul }}</div>
                            </td>

                            {{-- Pembina --}}
                            <td>
                                @if ($item->pembina)
                                    {{ $item->pembina }}
                                @else
                                    <span class="empty-val">Belum diisi</span>
                                @endif
                            </td>

                            {{-- ✅ Jadwal Latihan --}}
                            <td>
                                @if ($item->jadwal_latihan)
                                    <span class="schedule-pill">
                                        <i class="far fa-clock"></i>{{ $item->jadwal_latihan }}
                                    </span>
                                @else
                                    <span class="empty-val">Belum ada</span>
                                @endif
                            </td>

                            {{-- Deskripsi --}}
                            <td>
                                <div class="cell-desc">
                                    @if ($item->deskripsi)
                                        {{ $item->deskripsi }}
                                    @else
                                        <span class="empty-val">Belum ada deskripsi</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Aksi --}}
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

        {{-- PAGINATION --}}
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