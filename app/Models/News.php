<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;

class News extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'news';

    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'gambar',
        'status',
        'id_user',
        'slug',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function slugSource(): string
    {
        return 'judul';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}