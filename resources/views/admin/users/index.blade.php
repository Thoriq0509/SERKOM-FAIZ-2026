@extends('layouts.template')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data User</h4>
            <p class="text-muted mb-0">
                Kelola pengguna yang memiliki akses ke sistem.
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Tambah User
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            Data user akan ditampilkan di sini.
        </div>
    </div>
</div>

@endsection