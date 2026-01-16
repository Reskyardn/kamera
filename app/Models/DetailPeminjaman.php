<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjamans';
    /** @use HasFactory<\Database\Factories\DetailPeminjamanFactory> */
    protected $fillable = [
        'peminjaman_id',
        'kamera_id',
        'jumlah',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function kamera()
    {
        return $this->belongsTo(Kamera::class);
    }
}
