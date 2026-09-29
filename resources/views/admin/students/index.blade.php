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

    /* Tombol close custom agar pasti bisa diklik */
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

    .cell-nisn {
        font-family: 'Courier New', monospace;
        color: var(--c-text-soft);
        font-size: .82rem;
    }

    .cell-name {
        font-weight: 600;
        color: var(--c-primary-d);
    }

    /* =========================
       BADGE JENIS KELAMIN
    ========================== */
    .badge-jk {
        font-size: .75rem;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 20px;
        border: 1px solid;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-jk.lk {
        background-color: #eff6ff;
        border-color: #bfdbfe;
        color: #1d4ed8;
    }

    .badge-jk.pr {
        background-color: #fdf2f8;
        border-color: #fbcfe8;
        color: #be185d;
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
       EMPTY STATE (tanpa tombol)
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
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        font-size: .8rem;
        color: var(--c-text-soft);
    }
</style>

<div class="container-fluid p-0">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Data Siswa</h2>
            <p class="page-subtitle">Kelola data peserta didik sekolah.</p>
        </div>

        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary-soft">
            <i class="fas fa-plus me-2"></i>Tambah Data
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-soft alert-dismissible fade show" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-text">{{ session('success') }}</span>
            <button type="button" class="alert-close" data-alert-close aria-label="Tutup">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger alert-soft alert-dismissible fade show" role="alert" data-alert>
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
                                {{-- Empty state TANPA tombol --}}
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

{{-- =========================================================
     SCRIPT: FALLBACK CLOSE ALERT
     Berfungsi walau Bootstrap JS tidak ter-load / error
========================================================== --}}
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