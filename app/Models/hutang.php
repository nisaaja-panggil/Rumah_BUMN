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
    public static function boot()
    {
        parent::boot();

        static::updating(function ($hutang) {
            // Hitung sisa hutang
            $sisaHutang = $hutang->jumlah_hutang - $hutang->jumlah_bayar;

            // Tentukan status berdasarkan sisa hutang
            if ($sisaHutang <= 0) {
                $hutang->status = 'lunas';
            } else {
                $hutang->status = 'belum_lunas';
            }
        });
    }

    public function penitipan()
    {
        return $this->belongsTo(Penitipan::class);
    }
}
