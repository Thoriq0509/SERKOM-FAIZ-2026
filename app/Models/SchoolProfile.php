<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;

    protected $table = 'school_profiles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_sekolah',
        'kepala_sekolah',
        'foto_kepsek',
        'sambutan_kepsek',
        'npsn',
        'alamat',
        'kontak',
        'email',
        'facebook',
        'instagram',
        'whatsapp',
        'visi',
        'misi',
        'tahun_berdiri',
        'deskripsi',
        'logo',
        'foto',
    ];
}