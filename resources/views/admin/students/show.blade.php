@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/students.css') }}">
@endpush

@section('breadcrumb')
    <li><a href="{{ route('admin.siswa.index') }}">Data Siswa</a></li>
    <li>Detail Siswa</li>
@endsection

@section('content')

@php
    $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($student->id);
@endphp

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="page-title">Detail Siswa</h2>
            <p class="page-subtitle">Informasi lengkap mengenai peserta didik.</p>
        </div>

        <a href="{{ route('admin.siswa.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Card detail -->
    <div class="card-clean mb-5">

        <!-- Hero header -->
        <div class="hero-head">
            <div class="hero-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div>
                <h4 class="hero-name">{{ $student->nama_siswa }}</h4>
                <div class="hero-meta">
                    <span>NISN: {{ $student->nisn }}</span>
                    <span class="dot"></span>
                    <span>Tahun Masuk: {{ $student->tahun_masuk }}</span>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body-clean">

            <!-- Informasi siswa -->
            <div class="section-title">
                <i class="fas fa-id-card"></i>Informasi Siswa
            </div>
            <hr class="section-divider">

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">NISN</div>
                    <div class="detail-value mono">{{ $student->nisn }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Nama Siswa</div>
                    <div class="detail-value">{{ $student->nama_siswa }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Jenis Kelamin</div>
                    <div class="detail-value">
                        @if ($student->jenis_kelamin === 'Laki-Laki')
                            <span class="badge-jk lk">
                                <i class="fas fa-mars"></i>Laki-Laki
                            </span>
                        @else
                            <span class="badge-jk pr">
                                <i class="fas fa-venus"></i>Perempuan
                            </span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tahun Masuk</div>
                    <div class="detail-value">{{ $student->tahun_masuk }}</div>
                </div>
            </div>

            <!-- Informasi data -->
            <div class="section-title">
                <i class="fas fa-database"></i>Informasi Data
            </div>
            <hr class="section-divider">

                <div class="detail-item">
                    <div class="detail-label">Data Dibuat</div>
                    <div class="detail-value">
                        {{ $student->created_at ? $student->created_at->format('d F Y, H:i') : '-' }}
                    </div>
                </div>

                <div class="detail-item" style="grid-column: 1 / -1;">
                    <div class="detail-label">Terakhir Diperbarui</div>
                    <div class="detail-value">
                        {{ $student->updated_at ? $student->updated_at->format('d F Y, H:i') : '-' }}
                    </div>
                </div>
            </div>

            <!-- Action bar -->
            <div class="action-bar">
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>

                <a href="{{ route('admin.siswa.edit', $encryptedId) }}" class="btn btn-primary-full">
                    <i class="fas fa-edit me-2"></i>Edit Data
                </a>

                <form action="{{ route('admin.siswa.destroy', $encryptedId) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-soft">
                        <i class="fas fa-trash-alt me-2"></i>Hapus Data
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection