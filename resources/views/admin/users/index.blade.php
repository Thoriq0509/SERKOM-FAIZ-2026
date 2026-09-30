@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/users.css') }}">
@endpush

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Data Pengelola</h2>
            <p class="page-subtitle">Kelola pengguna yang memiliki akses ke sistem.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary-soft">
            <i class="fas fa-plus me-2"></i>Tambah Data
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
            <h6><i class="fas fa-users-cog me-2"></i>Daftar Pengelola</h6>
            <span class="count">Total: {{ $users->count() }} pengelola</span>
        </div>

        <div class="table-responsive">
            <table class="table table-clean">

                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="45%">Pengelola</th>
                        <th width="20%" class="text-center">Role</th>
                        <th width="30%" class="text-center">Aksi</th>
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