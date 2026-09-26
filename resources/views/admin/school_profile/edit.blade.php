@extends('layouts.template')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0" style="font-family: 'Poppins', sans-serif;">Edit Profil Sekolah</h2>
        <!-- Diubah ke admin.school_profile -->
        <a href="{{ route('admin.school_profile') }}" class="btn btn-secondary px-3 py-2">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <!-- Alert Validasi Error -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> <strong>Gagal Menyimpan Data!</strong> Periksa kembali isian Anda:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- FORM UTAMA UPDATE -->
    <form action="{{ route('admin.school_profile.update') }}" method="POST" enctype="multipart/form-data" id="formUpdateProfil">
        @csrf
        @method('PUT')

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="card-header bg-white p-4" style="border-radius: 15px 15px 0 0; border-bottom: 2px solid #f1f5f9;">
                <h5 class="fw-bold mb-0" style="color: #273b69;"><i class="fas fa-edit me-2"></i> Form Perubahan Data Sekolah</h5>
            </div>
            <div class="card-body p-4">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Sekolah <span class="text-danger">*</span></label>
                        <input type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $profil->nama_sekolah) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kepala Sekolah</label>
                        <input type="text" name="kepala_sekolah" class="form-control" value="{{ old('kepala_sekolah', $profil->kepala_sekolah) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">NPSN</label>
                        <input type="text" name="npsn" class="form-control" value="{{ old('npsn', $profil->npsn) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Kontak / Telp</label>
                        <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $profil->kontak) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Tahun Berdiri</label>
                        <input type="number" name="tahun_berdiri" class="form-control" value="{{ old('tahun_berdiri', $profil->tahun_berdiri) }}">
                    </div>
                </div>

                <div class="row border-top pt-3 mt-2">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Ganti Logo Sekolah</label>
                        <input type="file" name="logo" class="form-control" accept="image/jpeg,image/png,image/jpg">
                        <small class="text-muted d-block mt-1">Format: JPG, PNG (Maksimal 2MB)</small>
                        @if($profil->logo)
                            <div class="mt-2 p-2 border rounded bg-light" style="display: inline-block;">
                                <img src="{{ asset('storage/'.$profil->logo) }}" alt="Logo" class="img-fluid" style="max-width: 80px;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Ganti Foto Gedung / Utama</label>
                        <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg">
                        <small class="text-muted d-block mt-1">Format: JPG, PNG (Maksimal 2MB)</small>
                        @if($profil->foto)
                            <div class="mt-2 p-2 border rounded bg-light" style="display: inline-block;">
                                <img src="{{ asset('storage/'.$profil->foto) }}" alt="Foto" class="img-fluid" style="max-width: 150px;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3 border-top pt-3">
                    <label class="form-label fw-semibold">Visi & Misi</label>
                    <textarea name="visi_misi" class="form-control" rows="4">{{ old('visi_misi', $profil->visi_misi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $profil->alamat) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi / Sejarah Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                </div>

                <hr class="mb-4">

                <div class="d-flex justify-content-end gap-2">
                    <!-- Diubah ke admin.school_profile -->
                    <a href="{{ route('admin.school_profile') }}" class="btn btn-secondary px-4 py-2">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm" style="background-color: #273b69; border: none;">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>

            </div>
        </div>
    </form>
    <!-- End Form Utama -->

    <!-- FORM TERPISAH HAPUS (DELETE) -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px;">
        <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h6 class="fw-bold text-danger mb-1">Zona Bahaya (Hapus Profil)</h6>
                <p class="text-muted mb-0 small">Menghapus data profil akan mengosongkan seluruh informasi sekolah dan menghapus foto dari penyimpanan.</p>
            </div>
            <!-- Diubah ke admin.school_profile.destroy -->
            <form action="{{ route('admin.school_profile.destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus/mengosongkan data profil sekolah ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger px-4 py-2">
                    <i class="fas fa-trash-alt me-2"></i> Hapus Profil
                </button>
            </form>
        </div>
    </div>

</div>
@endsection