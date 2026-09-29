<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'gambar',
        'status',
        'id_user',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi ke User (pembuat berita).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}