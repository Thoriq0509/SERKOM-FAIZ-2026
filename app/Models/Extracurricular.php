<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;

class Extracurricular extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'extracurriculars';

    protected $fillable = [
        'nama_ekskul',
        'id_guru',
        'jadwal_latihan',
        'deskripsi',
        'gambar',
        'slug',
    ];

    public function slugSource(): string
    {
        return 'nama_ekskul';
    }

    public function pembina()
    {
        return $this->belongsTo(Teacher::class, 'id_guru', 'id');
    }
}