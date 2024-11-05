<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class produk extends Model
{
    use HasFactory;
    protected $fillable = ['nama_produk', 'penitipan_id', 'deskripsi', 'stok', 'harga', 'foto'];



    public function pembelian()
    {
        return $this->hasMany(penjualan::class, 'produk_id');
    }
}
