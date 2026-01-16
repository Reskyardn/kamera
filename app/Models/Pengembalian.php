<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';
    /** @use HasFactory<\Database\Factories\PengembalianFactory> */
    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali',
        'kondisi_kembali',
        'denda',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
