<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class penitipan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_umkm', 'merek', 'jumlah_titip', 'harga_satuan', 'tanggal', 'harga_bayar', 'status'];
    public function produk()
    {
        return $this->hasMany(Produk::class, 'penitipan_id');
    }
}
