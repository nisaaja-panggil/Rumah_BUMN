<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class hutang extends Model
{
    use HasFactory;
    protected $fillable = [
        'penitipan_id',
        'jumlah_hutang',
        'jumlah_bayar',
        'tanggal',
    ];


    public function penitipan()
    {
        return $this->belongsTo(Penitipan::class);
    }
}
