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

    /* Badge Custom untuk Jenis Kelamin */
    .badge-lk {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, 0.2);
    }
    .badge-pr {
        background-color: rgba(214, 51, 132, 0.1);
        color: #d63384;
        border: 1px solid rgba(214, 51, 132, 0.2);
    }
</style>

<div class="container-fluid p-0">

    <!-- Header Judul & Tombol Tambah Data -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-bold text-dark mb-0" style="font-family: 'Poppins', sans-serif;">Data Siswa</h2>
        <a href="#" class="btn btn-primary rounded-pill px-4 shadow-sm" style="background-color: #273b69; border: none;">
            <i class="fas fa-plus me-2"></i> Tambah Data
        </a>
    </div>

    <!-- Card Utama Berisi Tabel -->
    <div class="card table-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold fs-6"><i class="fas fa-user-graduate me-2"></i> Daftar Peserta Didik</h6>
        </div>
        
        <div class="card-body p-0">
            <!-- Table Responsive agar aman di layar HP -->
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">NISN</th>
                            <th width="35%">Nama Siswa</th>
                            <th width="15%" class="text-center">Jenis Kelamin</th>
                            <th width="15%" class="text-center">Tahun Masuk</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CONTOH PENGGUNAAN LOOPING DATABASE LARAVEL: -->
                        {{-- @foreach($siswa as $item) --}}
                        <tr>
                            <td>1 {{-- {{ $loop->iteration }} --}}</td>
                            <td class="fw-semibold text-secondary">
                                0012345678
                                {{-- {{ $item->nisn }} --}}
                            </td>
                            <td class="fw-bold text-dark">
                                Muhammad Sagara
                                {{-- {{ $item->nama_siswa }} --}}
                            </td>
                            <td class="text-center">
                                <!-- Badge Laki-Laki -->
                                <span class="badge badge-lk px-3 py-2 rounded-pill fw-normal">
                                    <i class="fas fa-mars me-1"></i> Laki-Laki
                                </span>
                                
                                {{-- Logika Database:
                                @if($item->jenis_kelamin == 'Laki-Laki')
                                    <span class="badge badge-lk px-3 py-2 rounded-pill fw-normal"><i class="fas fa-mars me-1"></i> Laki-Laki</span>
                                @else
                                    <span class="badge badge-pr px-3 py-2 rounded-pill fw-normal"><i class="fas fa-venus me-1"></i> Perempuan</span>
                                @endif
                                --}}
                            </td>
                            <td class="text-center fw-bold text-secondary">
                                2024
                                {{-- {{ $item->tahun_masuk }} --}}
                            </td>
                            <td class="text-center text-nowrap">
                                <!-- Tombol EDIT -->
                                <a href="#" class="btn btn-warning btn-sm btn-action text-white shadow-sm me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol HAPUS -->
                                <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action shadow-sm" title="Hapus Data">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        {{-- @endforeach --}}

                        <!-- Dummy Data Kedua (Perempuan) -->
                        <tr>
                            <td>2</td>
                            <td class="fw-semibold text-secondary">0087654321</td>
                            <td class="fw-bold text-dark">Siti Aisyah</td>
                            <td class="text-center">
                                <!-- Badge Perempuan -->
                                <span class="badge badge-pr px-3 py-2 rounded-pill fw-normal">
                                    <i class="fas fa-venus me-1"></i> Perempuan
                                </span>
                            </td>
                            <td class="text-center fw-bold text-secondary">2025</td>
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