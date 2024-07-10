<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';

    protected $fillable = [
        'user_id',
        'tanggal',
        'no_penjualan',
        'total',
        'tanggal_check',
        'status'
    ];

    //status note
    // 0 menunggu pembayaran
    // 1 menunggu konfirmasi pembayaran
    // 2 pengecekan sapi
    // 3 pesanan di proses
    // 4 pesanan di kirim
    // 5 selesai
    // 6 pesanan di tolak

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembayaran_status()
    {
        return $this->hasOne(Pembayaran::class, 'penjualan_id')->orderBy('created_at', 'DESC');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'penjualan_id');
    }
}
