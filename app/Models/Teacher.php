<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'nama_guru',
        'nip',
        'mapel',
        'foto',
    ];

    public function extracurriculars()
    {
        return $this->hasMany(Extracurricular::class, 'id_guru', 'id');
    }
}