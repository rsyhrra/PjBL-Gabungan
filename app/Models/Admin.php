<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // PENTING: Ganti ini
use Illuminate\Notifications\Notifiable;

// Ubah "extends Model" menjadi "extends Authenticatable"
class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}