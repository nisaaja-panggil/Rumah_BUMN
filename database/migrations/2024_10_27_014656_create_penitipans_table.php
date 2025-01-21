<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penitipans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('umkm_id')->nullable();
            $table->string('merek');
            $table->string('produk');
            $table->integer('jumlah_titip');
            $table->date('tanggal');
            $table->decimal('harga_bayar', 15, 2);
            $table->enum('status', ['lunas', 'belum_lunas'])->default('belum_lunas');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penitipans');
    }
};
