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
       USER CELL
    ========================== */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: var(--c-soft);
        color: var(--c-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .9rem;
        border: 1px solid var(--c-border);
        flex-shrink: 0;
    }

    .user-name {
        font-weight: 600;
        color: var(--c-primary-d);
        font-size: .875rem;
        line-height: 1.2;
    }

    .user-id {
        font-family: 'Courier New', monospace;
        font-size: .75rem;
        color: var(--c-text-soft);
        margin-top: 2px;
    }

    /* =========================
       BADGE ROLE
    ========================== */
    .badge-role {
        font-size: .75rem;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 20px;
        border: 1px solid;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-role.admin {
        background-color: #fef2f2;
        border-color: #fecaca;
        color: #b91c1c;
    }

    .badge-role.operator {
        background-color: #eff6ff;
        border-color: #bfdbfe;
        color: #1d4ed8;
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
</style>

<div class="container-fluid p-0">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Data Pengelola</h2>
            <p class="page-subtitle">Kelola pengguna yang memiliki akses ke sistem.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary-soft">
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

    {{-- CARD TABEL --}}
    <div class="card-clean">

        <div class="card-head">
            <h6><i class="fas fa-users-cog me-2"></i>Daftar Pengelola</h6>
            <span class="count">Total: {{ $users->count() }} pengelola</span>
        </div>

        <div class="table-responsive">
            <table class="table table-clean">

                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="55%">Pengelola</th>
                        <th width="20%" class="text-center">Role</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $index => $user)
                        @php
                            $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($user->id_user);
                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="user-name">{{ $user->username }}</div>
                                        <div class="user-id">ID: {{ $user->id_user }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">
                                @if ($user->role === 'Admin')
                                    <span class="badge-role admin">
                                        <i class="fas fa-user-shield"></i>Admin
                                    </span>
                                @elseif ($user->role === 'Operator')
                                    <span class="badge-role operator">
                                        <i class="fas fa-user-cog"></i>Operator
                                    </span>
                                @else
                                    <span class="badge-role">{{ $user->role }}</span>
                                @endif
                            </td>

                            <td class="text-center text-nowrap">
                                <a href="{{ route('admin.users.edit', $encryptedId) }}"
                                   class="btn-icon edit me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.users.destroy', $encryptedId) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->username }}?');">
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
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="fas fa-users-slash"></i>
                                    <h6>Belum Ada Data Pengelola</h6>
                                    <p>Belum terdapat pengguna yang terdaftar di dalam sistem.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

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