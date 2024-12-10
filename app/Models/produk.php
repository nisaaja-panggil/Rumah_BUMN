<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class produk extends Model
{
    use HasFactory;
    protected $fillable = ['nama_produk', 'penitipan_id', 'deskripsi', 'stok', 'price', 'foto'];



    public function pembelian()
    {
        return $this->hasMany(penjualan::class, 'produk_id');
    }
    public function detail_penjualan()
{
    return $this->hasMany(detail_penjualan::class, 'produk_id');
}
public function penitipan()
{
    return $this->belongsTo(Penitipan::class, 'penitipan_id');
}
}
