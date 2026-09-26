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
        padding: 15px 25px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap; /* Teks header tidak turun ke bawah */
    }
    
    .table-custom td {
        padding: 15px 25px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #e2e8f0;
    }
    
    /* Ukuran Thumbnail Gambar Berita */
    .img-thumbnail-custom {
        width: 90px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    /* Desain Kotak Tombol Aksi (CRUD) */
    .btn-action {
        width: 35px;
        height: 35px;
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
        <h2 class="fw-bold text-dark mb-0" style="font-family: 'Poppins', sans-serif;">Kelola Berita</h2>
        <a href="#" class="btn btn-primary rounded-pill px-4 shadow-sm" style="background-color: #273b69; border: none;">
            <i class="fas fa-plus me-2"></i> Tambah Berita
        </a>
    </div>

    <!-- Card Utama Berisi Tabel -->
    <div class="card table-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold fs-6"><i class="fas fa-newspaper me-2"></i> Daftar Berita Sekolah</h6>
        </div>
        
        <div class="card-body p-0">
            <!-- Table Responsive agar aman di layar HP -->
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Gambar</th>
                            <th width="35%">Judul Berita</th>
                            <th width="15%">Tanggal Publikasi</th>
                            <th width="15%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CONTOH PENGGUNAAN LOOPING DATABASE LARAVEL: -->
                        {{-- @foreach($berita as $item) --}}
                        <tr>
                            <td>1 {{-- {{ $loop->iteration }} --}}</td>
                            <td>
                                <!-- Menampilkan Gambar (Dengan Fallback Unsplash jika kosong) -->
                                <img src="https://images.unsplash.com/photo-1546422904-90eab23c3d7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                                     alt="Gambar Berita" class="img-thumbnail-custom"
                                     {{-- onerror="this.src='{{ asset('assets/admin/img/default-news.jpg') }}'" --}}>
                            </td>
                            <td class="fw-bold">
                                Penerimaan Siswa Baru Tahun Ajaran 2026/2027 Dibuka
                                {{-- {{ $item->judul }} --}}
                            </td>
                            <td>
                                19 September 2026
                                {{-- {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }} --}}
                            </td>
                            <td class="text-center">
                                <!-- Status Publish -->
                                <span class="badge bg-success rounded-pill px-3 py-2 fw-normal">Publish</span>
                                
                                {{-- Contoh logika database:
                                @if($item->status == 'Publish')
                                    <span class="badge bg-success rounded-pill px-3 py-2 fw-normal">Publish</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2 fw-normal">Draft</span>
                                @endif
                                --}}
                            </td>
                            <td class="text-center">
                                <!-- Tombol EDIT -->
                                <a href="#" class="btn btn-warning btn-sm btn-action text-white shadow-sm me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol HAPUS -->
                                <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini? Data yang dihapus tidak dapat dikembalikan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action shadow-sm" title="Hapus Data">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        {{-- @endforeach --}}

                        <!-- Dummy Data Kedua (Status Draft) -->
                        <tr>
                            <td>2</td>
                            <td>
                                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Gambar Berita" class="img-thumbnail-custom">
                            </td>
                            <td class="fw-bold">Tim Robotik SMK Raih Juara 1 Tingkat Nasional</td>
                            <td>15 September 2026</td>
                            <td class="text-center">
                                <!-- Status Draft -->
                                <span class="badge bg-secondary rounded-pill px-3 py-2 fw-normal">Draft</span>
                            </td>
                            <td class="text-center">
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
                {{-- {{ $berita->links('pagination::bootstrap-5') }} --}}
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