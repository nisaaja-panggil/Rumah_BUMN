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
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('penjualan_id');
            $table->string('nama_customer');
            $table->integer('qty');
            $table->double('price');
            $table->timestamps();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            $table->foreign('penjualan_id')->references('id')->on('penjualans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
