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


    public function penjualan()
{
    return $this->belongsTo(Penjualan::class);
}


public function hutang()
{
    return $this->belongsTo(Hutang::class);
}
}
