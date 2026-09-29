@extends('layouts.template')

@section('content')

<div class="container-fluid">

    <!-- ================================
         HEADER
    ================================ -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Data Pengelola
            </h4>

            <p class="text-muted mb-0">
                Kelola pengguna yang memiliki akses ke sistem.
            </p>
        </div>


        <a
            href="{{ route('admin.users.create') }}"
            class="btn btn-primary"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Pengelola
        </a>

    </div>


    <!-- ================================
         ALERT SUCCESS
    ================================ -->
    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>

        </div>

    @endif


    <!-- ================================
         ALERT ERROR
    ================================ -->
    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>

        </div>

    @endif


    <!-- ================================
         TABLE DATA USER
    ================================ -->
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-users-cog me-2 text-primary"></i>
                    Daftar Pengelola
                </h5>

                <span class="badge bg-primary rounded-pill px-3 py-2">
                    {{ $users->count() }} Data
                </span>

            </div>

        </div>


        <div class="card-body p-0">

            @if($users->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th
                                    width="7%"
                                    class="text-center"
                                >
                                    No
                                </th>

                                <th>
                                    Username
                                </th>

                                <th
                                    width="20%"
                                    class="text-center"
                                >
                                    Role
                                </th>

                                <th
                                    width="25%"
                                    class="text-center"
                                >
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($users as $index => $user)

                                @php
                                    $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString(
                                        $user->id_user
                                    );
                                @endphp

                                <tr>

                                    <!-- Nomor -->
                                    <td class="text-center">
                                        {{ $index + 1 }}
                                    </td>


                                    <!-- Username -->
                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div
                                                class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                                                style="width: 42px; height: 42px;"
                                            >
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <div>

                                                <div class="fw-semibold">
                                                    {{ $user->username }}
                                                </div>

                                                <small class="text-muted">
                                                    ID: {{ $user->id_user }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    <!-- Role -->
                                    <td class="text-center">

                                        @if($user->role === 'Admin')

                                            <span class="badge bg-danger rounded-pill px-3 py-2">
                                                <i class="fas fa-user-shield me-1"></i>
                                                Admin
                                            </span>

                                        @elseif($user->role === 'Operator')

                                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                                <i class="fas fa-user-cog me-1"></i>
                                                Operator
                                            </span>

                                        @else

                                            <span class="badge bg-secondary rounded-pill px-3 py-2">
                                                {{ $user->role }}
                                            </span>

                                        @endif

                                    </td>


                                    <!-- Aksi -->
                                    <td>

                                        <div class="d-flex justify-content-center gap-2">

                                            <!-- Detail -->
                                            <a
                                                href="{{ route('admin.users.show', $encryptedId) }}"
                                                class="btn btn-sm btn-info text-white"
                                                title="Detail"
                                            >
                                                <i class="fas fa-eye"></i>
                                            </a>


                                            <!-- Edit -->
                                            <a
                                                href="{{ route('admin.users.edit', $encryptedId) }}"
                                                class="btn btn-sm btn-warning text-white"
                                                title="Edit"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </a>


                                            <!-- Hapus -->
                                            <form
                                                action="{{ route('admin.users.destroy', $encryptedId) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus pengguna {{ $user->username }}?');"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Hapus"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <!-- ================================
                     EMPTY DATA
                ================================ -->
                <div class="text-center py-5">

                    <div
                        class="mb-3 text-muted"
                        style="font-size: 3rem;"
                    >
                        <i class="fas fa-users-slash"></i>
                    </div>

                    <h5 class="fw-bold">
                        Belum Ada Data Pengelola
                    </h5>

                    <p class="text-muted mb-3">
                        Belum terdapat pengguna yang terdaftar
                        di dalam sistem.
                    </p>

                    <a
                        href="{{ route('admin.users.create') }}"
                        class="btn btn-primary"
                    >
                        <i class="fas fa-plus me-1"></i>
                        Tambah Pengelola
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection