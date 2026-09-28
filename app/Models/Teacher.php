<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Teacher extends Model
{
    use HasFactory;

    /**
     * Nama tabel.
     */
    protected $table = 'teachers';

    /**
     * Primary key menggunakan UUID.
     */
    protected $primaryKey = 'id';

    /**
     * UUID berupa string.
     */
    protected $keyType = 'string';

    /**
     * Primary key bukan auto increment.
     */
    public $incrementing = false;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'id',
        'nama_guru',
        'nip',
        'mapel',
        'foto',
    ];

    /**
     * Membuat UUID otomatis ketika data dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function ($teacher) {

            if (empty($teacher->id)) {
                $teacher->id = (string) Str::uuid();
            }

        });
    }
}