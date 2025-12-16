<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPesanan extends Model
{
    use HasFactory;

    protected $table = 'log_pesanan';
    
    protected $fillable = [
        'kode_pesanan',
        'status_lama',
        'status_baru',
        'waktu_perubahan'
    ];

    /**
     * Relasi balik ke Pesanan
     * Satu Log dimiliki oleh SATU Pesanan
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'kode_pesanan', 'kode_pesanan');
    }
}