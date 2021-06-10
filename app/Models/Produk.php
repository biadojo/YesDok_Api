<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'cashier_id', 'nama_produk', 'deskripsi', 'harga_satuan', 'stok_produk', 'foto_produk', 'status_verifikasi', 'alasan_penolakan'
    ];
    protected $guarded = ['id'];
    protected $table = 'produk';
}
