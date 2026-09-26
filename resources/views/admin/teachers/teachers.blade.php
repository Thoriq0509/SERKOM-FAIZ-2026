@extends('layouts.template')

@section('content')
<style>
    /* Styling khusus Card Tabel */
    .table-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        overflow: hidden;
        border: none;
    }
    
    .table-card .card-header {
        background-color: #273b69; /* Tema Biru Gelap */
        color: #ffffff;
        padding: 16px 25px;
        font-family: 'Poppins', sans-serif;
        border-bottom: none;
    }
    
    .table-custom th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        padding: 15px 20px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap; 
    }
    
    .table-custom td {
        padding: 15px 20px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #e2e8f0;
    }
    
    /* Ukuran Foto Guru dibuat bulat */
    .img-thumbnail-custom {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    /* Desain Kotak Tombol Aksi (CRUD) */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid p-0">

    <!-- Header Judul & Tombol Tambah Data -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-bold text-dark mb-0" style="font-family: 'Poppins', sans-serif;">Data Guru</h2>
        <a href="#" class="btn btn-primary rounded-pill px-4 shadow-sm" style="background-color: #273b69; border: none;">
            <i class="fas fa-plus me-2"></i> Tambah Data
        </a>
    </div>

    <!-- Card Utama Berisi Tabel -->
    <div class="card table-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold fs-6"><i class="fas fa-chalkboard-teacher me-2"></i> Daftar Tenaga Pendidik</h6>
        </div>
        
        <div class="card-body p-0">
            <!-- Table Responsive agar aman di layar HP -->
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%" class="text-center">Foto</th>
                            <th width="30%">Nama Guru</th>
                            <th width="20%">NIP</th>
                            <th width="20%">Mata Pelajaran</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CONTOH PENGGUNAAN LOOPING DATABASE LARAVEL: -->
                        {{-- @foreach($guru as $item) --}}
                        <tr>
                            <td>1 {{-- {{ $loop->iteration }} --}}</td>
                            <td class="text-center">
                                <!-- Kolom foto guru -->
                                <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                                     alt="Foto Guru" class="img-thumbnail-custom"
                                     {{-- onerror="this.src='{{ asset('assets/admin/img/default-avatar.png') }}'" --}}>
                            </td>
                            <td class="fw-bold text-dark">
                                H. Budi Santoso, S.Pd., M.Kom.
                                {{-- {{ $item->nama_guru }} --}}
                            </td>
                            <td>
                                198005122005011003
                                {{-- {{ $item->nip }} --}}
                            </td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill">
                                    Rekayasa Perangkat Lunak
                                </span>
                                {{-- <span class="...">{{ $item->mapel }}</span> --}}
                            </td>
                            <td class="text-center text-nowrap">
                                <!-- Tombol EDIT -->
                                <a href="#" class="btn btn-warning btn-sm btn-action text-white shadow-sm me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol HAPUS -->
                                <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action shadow-sm" title="Hapus Data">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        {{-- @endforeach --}}

                        <!-- Dummy Data Kedua -->
                        <tr>
                            <td>2</td>
                            <td class="text-center">
                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Foto Guru" class="img-thumbnail-custom">
                            </td>
                            <td class="fw-bold text-dark">Siti Aminah, M.Pd.</td>
                            <td>198507222010022001</td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill">
                                    Matematika
                                </span>
                            </td>
                            <td class="text-center text-nowrap">
                                <a href="#" class="btn btn-warning btn-sm btn-action text-white shadow-sm me-1" title="Edit Data"><i class="fas fa-edit"></i></a>
                                <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action shadow-sm" title="Hapus Data"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Section -->
            <div class="p-3 border-top d-flex justify-content-end bg-light">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                        <li class="page-item active"><a class="page-link" href="#" style="background-color: #273b69; border-color: #273b69;">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
                    </ul>
                </nav>
            </div>
            
        </div>
    </div>

</div>
@endsection