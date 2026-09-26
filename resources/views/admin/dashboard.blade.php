@extends('layouts.template')

@section('content')
<style>
    /* Styling khusus untuk Dashboard agar sesuai gambar referensi */
    .box-profile {
        background-color: #273b69; /* Biru Gelap */
        border-radius: 20px;
        color: #ffffff;
        padding: 40px 30px;
        box-shadow: 0 10px 20px rgba(39, 59, 105, 0.15);
        position: relative;
        overflow: hidden;
    }

    .stat-box {
        border-radius: 20px;
        padding: 30px 20px;
        color: #ffffff;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        height: 100%;
    }

    .stat-box:hover {
        transform: translateY(-5px);
    }

    .stat-box h3 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 5px;
        font-family: 'Poppins', sans-serif;
    }

    .stat-box p {
        font-size: 1.1rem;
        font-weight: 500;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .box-red { background-color: #dc2626; } /* Merah */
    .box-yellow { background-color: #eab308; color: #1e293b; } /* Kuning */
    .box-green { background-color: #16a34a; } /* Hijau */

    /* Card untuk Tabel */
    .table-card {
        background-color: #ffffff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .table-card .card-header {
        background-color: #273b69; /* Header Tabel Biru */
        color: #ffffff;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        padding: 18px 25px;
        border-bottom: none;
    }

    .table-custom th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        padding: 15px 25px;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-custom td {
        padding: 15px 25px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #e2e8f0;
    }
</style>

<div class="container-fluid p-0">
    
    <!-- 1. BLOK BIRU ATAS: Profil Sekolah -->
    <div class="box-profile mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">Profil SMK Teknologi Nusantara</h2>
                <p class="mb-0 text-light opacity-75">
                    Selamat datang di halaman dashboard admin. Di sini Anda dapat memantau seluruh aktivitas pendataan sekolah, mulai dari data pengajar, kesiswaan, hingga publikasi berita.
                </p>
            </div>
            <div class="col-md-4 text-md-end text-start mt-3 mt-md-0">
                <button class="btn btn-light rounded-pill px-4 py-2 fw-bold text-primary">
                    <i class="fas fa-edit me-2"></i> Edit Profil
                </button>
            </div>
        </div>
    </div>

    <!-- 2. BLOK 3 WARNA: Data Statistik (Responsive Grid) -->
    <div class="row g-4 mb-4">
        <!-- Merah: Guru -->
        <div class="col-12 col-md-4">
            <div class="stat-box box-red">
                <i class="fas fa-chalkboard-teacher mb-2" style="font-size: 2rem; opacity: 0.8;"></i>
                <h3>45</h3>
                <p>Data Guru</p>
            </div>
        </div>
        <!-- Kuning: Siswa -->
        <div class="col-12 col-md-4">
            <div class="stat-box box-yellow">
                <i class="fas fa-user-graduate mb-2" style="font-size: 2rem; opacity: 0.8;"></i>
                <h3>850</h3>
                <p>Data Siswa</p>
            </div>
        </div>
        <!-- Hijau: Ekstrakurikuler -->
        <div class="col-12 col-md-4">
            <div class="stat-box box-green">
                <i class="fas fa-basketball-ball mb-2" style="font-size: 2rem; opacity: 0.8;"></i>
                <h3>12</h3>
                <p>Ekstrakurikuler</p>
            </div>
        </div>
    </div>

    <!-- 3. BLOK BIRU TENGAH: Tabel Informasi Berita -->
    <div class="card table-card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-newspaper me-2"></i> Informasi Berita Terkini</span>
            <a href="{{ route('admin.berita') }}" class="btn btn-sm btn-light rounded-pill text-dark fw-bold px-3">Lihat Semua</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="55%">Judul Berita</th>
                            <th width="20%">Tanggal Publikasi</th>
                            <th width="20%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh Dummy Data -->
                        <tr>
                            <td>1</td>
                            <td class="fw-bold">Penerimaan Siswa Baru Tahun Ajaran 2026/2027 Dibuka</td>
                            <td>19 September 2026</td>
                            <td><span class="badge bg-success rounded-pill px-3">Aktif</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="fw-bold">Tim Robotik SMK Raih Juara 1 Tingkat Nasional</td>
                            <td>15 September 2026</td>
                            <td><span class="badge bg-success rounded-pill px-3">Aktif</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="fw-bold">Jadwal Ujian Tengah Semester Ganjil</td>
                            <td>10 September 2026</td>
                            <td><span class="badge bg-secondary rounded-pill px-3">Arsip</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 4. BLOK BIRU BAWAH: Tabel Informasi Galeri -->
    <div class="card table-card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-images me-2"></i> Informasi Galeri Terbaru</span>
            <a href="{{ route('admin.galeri') }}" class="btn btn-sm btn-light rounded-pill text-dark fw-bold px-3">Lihat Semua</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Preview Foto</th>
                            <th width="55%">Keterangan Kegiatan</th>
                            <th width="20%">Tanggal Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh Dummy Data -->
                        <tr>
                            <td>1</td>
                            <td>
                                <div style="width: 80px; height: 50px; background-color: #cbd5e1; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image text-white"></i>
                                </div>
                            </td>
                            <td class="fw-bold">Kegiatan Lomba 17 Agustus di Lapangan Sekolah</td>
                            <td>18 Agustus 2026</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div style="width: 80px; height: 50px; background-color: #cbd5e1; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image text-white"></i>
                                </div>
                            </td>
                            <td class="fw-bold">Kunjungan Industri ke PT. Teknologi Maju</td>
                            <td>05 Agustus 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection