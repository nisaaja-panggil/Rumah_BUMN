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
            $table->string('nama_umkm'); 
            $table->string('merek');
            $table->integer('jumlah_titip');
            $table->decimal('harga_satuan', 15, 2);
            $table->date('tanggal');
            $table->decimal('harga_bayar', 15, 2);
            $table->enum('status', ['lunas', 'belum_lunas']);
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
