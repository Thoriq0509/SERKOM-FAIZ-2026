<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * Nama tabel.
     */
    protected $table = 'teachers';

    /**
     * Primary key.
     */
    protected $primaryKey = 'id';

    /**
     * Primary key berupa integer.
     */
    protected $keyType = 'int';

    /**
     * Primary key menggunakan auto increment.
     */
    public $incrementing = true;

    /**
     * Kolom yang boleh diisi melalui mass assignment.
     */
    protected $fillable = [
        'nama_guru',
        'nip',
        'mapel',
        'foto',
    ];
}