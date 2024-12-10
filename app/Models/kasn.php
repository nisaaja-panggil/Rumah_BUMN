<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;

class kasn extends Model
{
    use HasFactory;
    protected $fillable = ['penjualan_id', 'hutang_id', 'arus', 'total','tanggal'];

    protected static function boot()
{
    parent::boot();

    static::creating(function ($kasn) {
        $existingData = kasn::where('penjualan_id', $kasn->penjualan_id)->first();
        if ($existingData) {
            throw ValidationException::withMessages([
                'penjualan_id' => 'Customer ini sudah ada di data kas.',
            ]);
        }
    });
}
    public function penjualan()
{
    return $this->belongsTo(Penjualan::class);
}


    public function hutang()
    {
        return $this->belongsTo(Hutang::class);
    }
}
