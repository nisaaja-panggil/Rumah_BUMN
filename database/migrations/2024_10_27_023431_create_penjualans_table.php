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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->string('nama_customer');
            $table->integer('jumlah');
            $table->decimal('total', 15, 2);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('uang_bayar', 15, 2);
            $table->decimal('uang_kembali', 15, 2)->storedAs('uang_bayar - (total - diskon)');
            $table->date('tanggal');
            $table->timestamps();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
