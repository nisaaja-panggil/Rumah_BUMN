<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penitipan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_umkm', 'merek', 'jumlah_titip', 'harga_satuan', 'tanggal', 'harga_bayar', 'status'];
}
