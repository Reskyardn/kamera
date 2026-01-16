<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamera extends Model
{
    use HasFactory;

    protected $table = 'kameras';

    /** @use HasFactory<\Database\Factories\KameraFactory> */
    protected $fillable = [
        'nama_kamera',
        'merk',
        'tipe',
        'spesifikasi',
        'stok',
        'kondisi',
        'status_ketersediaan',
    ];
    
}
