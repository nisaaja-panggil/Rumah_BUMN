<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans'; // Nama tabel

    protected $fillable = [
        'produk_id',
        'nama_customer',
        'jumlah',
        'total',
        'diskon',
        'uang_bayar',
        'uang_kembali',
        'tanggal',
    ];
    public function barang()
    {
        return $this->belongsTo(Produk::class);
    }
    // Mengatur bahwa kolom 'uang_kembali' otomatis dihitung
    protected $casts = [
        'uang_kembali' => 'decimal:2',
    ];

    /**
     * Relasi ke model Produk
     * Satu penjualan terkait dengan satu produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    /**
     * Hitung Grand Total (total setelah diskon)
     */
    public function getGrandTotalAttribute()
    {
        return $this->total - $this->diskon;
    }

    /**
     * Hitung Kembalian (uang yang dibayarkan - grand total)
     */
    public function getKembalianAttribute()
    {
        return $this->uang_bayar - $this->grand_total;
    }
}
