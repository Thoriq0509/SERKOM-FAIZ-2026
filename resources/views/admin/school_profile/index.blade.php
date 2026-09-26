@extends('layouts.template')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="fw-bold text-dark mb-0" style="font-family: 'Poppins', sans-serif;">Profil Sekolah</h2>
        
        <!-- Tombol menuju halaman edit terpisah -->
        <a href="{{ route('admin.school_profile.edit') }}" class="btn btn-primary px-4 py-2 shadow-sm" style="background-color: #273b69; border: none;">
            <i class="fas fa-edit me-2"></i> Edit Profil
        </a>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- TAMPILAN READ (HANYA BACA / INDEX) -->
    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
        <div class="card-body p-0">
            <div class="row g-0">
                <!-- Sisi Kiri: Foto Utama & Logo -->
                <div class="col-md-4 text-center p-4 text-white d-flex flex-column justify-content-center align-items-center" style="background-color: #273b69;">
                    @if($profil->logo)
                        <img src="{{ asset('storage/'.$profil->logo) }}" alt="Logo" class="img-fluid bg-white rounded-circle p-2 mb-3 shadow" style="width: 120px; height: 120px; object-fit: contain;">
                    @else
                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center mb-3 shadow" style="width: 120px; height: 120px; font-size: 3rem;">
                            <i class="fas fa-school"></i>
                        </div>
                    @endif
                    
                    <h4 class="fw-bold mb-1">{{ $profil->nama_sekolah ?? 'Nama Sekolah Belum Diatur' }}</h4>
                    <p class="mb-0 opacity-75">NPSN: {{ $profil->npsn ?? '-' }}</p>
                </div>

                <!-- Sisi Kanan: Detail Informasi -->
                <div class="col-md-8 p-4 p-md-5">
                    <h5 class="fw-bold border-bottom pb-2 mb-4 text-secondary">Informasi Detail</h5>
                    
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted fw-semibold">Kepala Sekolah</div>
                        <div class="col-sm-8 fw-bold text-dark">{{ $profil->kepala_sekolah ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted fw-semibold">Tahun Berdiri</div>
                        <div class="col-sm-8 text-dark">{{ $profil->tahun_berdiri ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted fw-semibold">Kontak / Telp</div>
                        <div class="col-sm-8 text-dark">{{ $profil->kontak ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted fw-semibold">Alamat Lengkap</div>
                        <div class="col-sm-8 text-dark">{{ $profil->alamat ?? '-' }}</div>
                    </div>
                    
                    <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4 text-secondary">Visi & Misi</h5>
                    <p class="text-dark" style="line-height: 1.6;">{{ $profil->visi_misi ?? 'Belum ada data visi & misi.' }}</p>

                    <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4 text-secondary">Sejarah / Deskripsi</h5>
                    <p class="text-dark" style="line-height: 1.6;">{{ $profil->deskripsi ?? 'Belum ada deskripsi singkat.' }}</p>
                    
                    @if($profil->foto)
                        <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4 text-secondary">Foto Gedung Utama</h5>
                        <img src="{{ asset('storage/'.$profil->foto) }}" alt="Foto Gedung" class="img-fluid rounded shadow-sm" style="max-height: 250px; width: 100%; object-fit: cover;">
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection