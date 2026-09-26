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
    
    /* Ukuran Thumbnail Galeri (Dibuat lebih lebar / 16:9) */
    .img-gallery-custom {
        width: 120px;
        height: 75px;
        object-fit: cover;
        border-radius: 8px;
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

    /* Badge Custom Kategori */
    .badge-foto {
        background-color: rgba(13, 202, 240, 0.1);
        color: #0dcaf0;
        border: 1px solid rgba(13, 202, 240, 0.2);
    }
    .badge-video {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.2);
    }
</style>

<div class="container-fluid p-0">

    <!-- Header Judul & Tombol Tambah Data -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-bold text-dark mb-0" style="font-family: 'Poppins', sans-serif;">Kelola Galeri</h2>
        <a href="#" class="btn btn-primary rounded-pill px-4 shadow-sm" style="background-color: #273b69; border: none;">
            <i class="fas fa-upload me-2"></i> Tambah Media
        </a>
    </div>

    <!-- Card Utama Berisi Tabel -->
    <div class="card table-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold fs-6"><i class="fas fa-images me-2"></i> Daftar Album & Dokumentasi</h6>
        </div>
        
        <div class="card-body p-0">
            <!-- Table Responsive -->
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%" class="text-center">Preview (File)</th>
                            <th width="35%">Judul & Keterangan</th>
                            <th width="15%" class="text-center">Kategori</th>
                            <th width="15%" class="text-center">Tanggal</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CONTOH PENGGUNAAN LOOPING DATABASE LARAVEL: -->
                        {{-- @foreach($galeri as $item) --}}
                        <tr>
                            <td>1 {{-- {{ $loop->iteration }} --}}</td>
                            <td class="text-center">
                                <!-- Thumbnail Media -->
                                <img src="https://images.unsplash.com/photo-1523580494112-747682f718aa?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" 
                                     alt="Preview Galeri" class="img-gallery-custom"
                                     {{-- onerror="this.src='{{ asset('assets/admin/img/default-gallery.jpg') }}'" --}}>
                            </td>
                            <td>
                                <!-- Judul digabung dengan keterangan agar ringkas -->
                                <div class="fw-bold text-dark mb-1">
                                    Lomba 17 Agustus 2026
                                    {{-- {{ $item->judul }} --}}
                                </div>
                                <small class="text-muted d-block" style="line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    Dokumentasi kegiatan keseruan perlombaan HUT RI yang ke-81 di lapangan utama sekolah tercinta.
                                    {{-- {{ $item->keterangan }} --}}
                                </small>
                            </td>
                            <td class="text-center">
                                <!-- Kategori Foto -->
                                <span class="badge badge-foto px-3 py-2 rounded-pill fw-normal">
                                    <i class="fas fa-camera me-1"></i> Foto
                                </span>
                                
                                {{-- Logika Database:
                                @if($item->kategori == 'Foto')
                                    <span class="badge badge-foto px-3 py-2 rounded-pill fw-normal"><i class="fas fa-camera me-1"></i> Foto</span>
                                @else
                                    <span class="badge badge-video px-3 py-2 rounded-pill fw-normal"><i class="fas fa-video me-1"></i> Video</span>
                                @endif
                                --}}
                            </td>
                            <td class="text-center fw-semibold text-secondary">
                                17 Ags 2026
                                {{-- {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }} --}}
                            </td>
                            <td class="text-center text-nowrap">
                                <!-- Tombol EDIT -->
                                <a href="#" class="btn btn-warning btn-sm btn-action text-white shadow-sm me-1" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Tombol HAPUS -->
                                <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus media galeri ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action shadow-sm" title="Hapus Data">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        {{-- @endforeach --}}

                        <!-- Dummy Data Kedua (Kategori Video) -->
                        <tr>
                            <td>2</td>
                            <td class="text-center position-relative">
                                <!-- Anggap ini thumbnail video, kita beri icon play di tengah secara visual -->
                                <div style="position: relative; display: inline-block;">
                                    <img src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="Preview Video" class="img-gallery-custom" style="filter: brightness(0.8);">
                                    <i class="fas fa-play-circle text-white position-absolute top-50 start-50 translate-middle fs-3 opacity-75"></i>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-1">Company Profile SMK 2026</div>
                                <small class="text-muted d-block" style="line-height: 1.4;">Video profil singkat pengenalan lingkungan dan fasilitas sekolah.</small>
                            </td>
                            <td class="text-center">
                                <!-- Kategori Video -->
                                <span class="badge badge-video px-3 py-2 rounded-pill fw-normal">
                                    <i class="fas fa-video me-1"></i> Video
                                </span>
                            </td>
                            <td class="text-center fw-semibold text-secondary">10 Jul 2026</td>
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
                        <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
                    </ul>
                </nav>
            </div>
            
        </div>
    </div>

</div>
@endsection