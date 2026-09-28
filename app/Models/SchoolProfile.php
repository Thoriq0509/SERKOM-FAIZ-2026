<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'school_profiles';

    /**
     * Primary key tabel.
     */
    protected $primaryKey = 'id';

    /**
     * Kolom yang diizinkan untuk mass assignment.
     */
    protected $fillable = [
        'nama_sekolah',
        'kepala_sekolah',
        'npsn',
        'alamat',
        'kontak',
        'visi_misi',
        'tahun_berdiri',
        'deskripsi',
        'logo',
        'foto',
    ];
}