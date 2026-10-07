<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;

class Teacher extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'teachers';

    protected $fillable = [
        'nama_guru',
        'nip',
        'mapel',
        'foto',
        'slug',
    ];

    public function slugSource(): string
    {
        return 'nama_guru';
    }

    public function extracurriculars()
    {
        return $this->hasMany(Extracurricular::class, 'id_guru', 'id');
    }
}