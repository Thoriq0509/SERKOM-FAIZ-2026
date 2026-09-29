<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Nama tabel.
     */
    protected $table = 'users';

    /**
     * Primary key.
     */
    protected $primaryKey = 'id_user';

    /**
     * Tipe primary key.
     */
    protected $keyType = 'int';

    /**
     * Primary key auto increment.
     */
    public $incrementing = true;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}