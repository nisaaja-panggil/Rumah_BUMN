<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class detail_penjualan extends Model
{
    use HasFactory;
    protected $fillable=['produk_id','penjualan_id','qty','price'];
    
    public function order():BelongsTo{
        return $this->belongsTo(penjualan::class);
    }

    public function produk():BelongsTo{
        return $this->belongsTo(Produk::class);
    }

    
}
