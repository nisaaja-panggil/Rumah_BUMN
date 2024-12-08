<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans'; // Nama tabel

    protected $fillable = [
        'user_id',
        'invoice',
        'nama_customer', // Pastikan nama_customer ada di sini
        'total',
    ];
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function detail_penjualan():HasMany{
        return $this->hasMany(detail_penjualan::class);
    }
}
