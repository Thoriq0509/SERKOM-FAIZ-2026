<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids; // <-- 1. Import trait ini
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasUuids, Notifiable; // <-- 2. Pasang HasUuids di sini

    protected $primaryKey = 'id_user'; // Memberitahu Laravel nama primary key-nya
    public $incrementing = false;      // Karena UUID bukan angka berurutan
    protected $keyType = 'string';     // Tipe data primary key adalah string

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}