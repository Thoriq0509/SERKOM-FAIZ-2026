@extends('layouts.template')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/teachers.css') }}">
@endpush

@section('breadcrumb')
    <li>Data Guru</li>
@endsection

@section('content')

<div class="container-fluid p-0">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title">Data Guru</h2>
            <p class="page-subtitle">Kelola data tenaga pendidik sekolah.</p>
        </div>

        <a href="{{ route('admin.guru.create') }}" class="btn btn-primary-soft">
            <i class="fas fa-plus me-2"></i>Tambah Data
        </a>
    </div>

    <!-- Alert sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-check-circle"></i>
            <span class="alert-text">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Alert error -->
    @if (session('error'))
        <div class="alert alert-danger alert-soft mb-4" role="alert" data-alert>
            <i class="fas fa-exclamation-circle"></i>
            <span class="alert-text">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Card tabel -->
    <div class="card-clean">

        <div class="card-head">
            <h6><i class="fas fa-chalkboard-teacher me-2"></i>Daftar Tenaga Pendidik</h6>
            <span class="count">Total: {{ $teachers->count() }} guru</span>
        </div>

        <div class="p-3">
            <table id="tableTeachers" class="table table-clean align-middle" data-datatable style="width:100%">

                <thead>
                    <tr>
                        <th width="5%" data-orderable="false">No</th>
                        <th width="12%" class="text-center" data-orderable="false">Foto</th>
                        <th width="28%">Nama Guru</th>
                        <th width="20%">NIP</th>
                        <th width="20%">Mata Pelajaran</th>
                        <th width="15%" class="text-center" data-orderable="false">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($teachers as $teacher)
                        @php
                            $encryptedId = \Illuminate\Support\Facades\Crypt::encryptString($teacher->id);
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <!-- Foto -->
                            <td class="text-center">
                                @if ($teacher->foto)
                                    <img src="{{ asset('storage/' . $teacher->foto) }}"
                                         alt="Foto {{ $teacher->nama_guru }}"
                                         class="teacher-photo">
                                @else
                                    <div class="teacher-photo-placeholder">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </td>

                            <td class="cell-name">{{ $teacher->nama_guru }}</td>

                            <td class="cell-nip">
                                {{ $teacher->nip ?: '-' }}
                            </td>

                            <td>
                                @if ($teacher->mapel)
                                    <span class="badge-mapel">{{ $teacher->mapel }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td class="text-center text-nowrap">
                                <a href="{{ route('admin.guru.show', $encryptedId) }}"
                                   class="btn-icon view me-1" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.guru.edit', $encryptedId) }}"
                                   class="btn-icon edit me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.guru.destroy', $encryptedId) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru {{ $teacher->nama_guru }}?');">
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

@endsection