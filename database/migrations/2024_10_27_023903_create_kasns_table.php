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
        Schema::create('kasns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id')->nullable(); 
            $table->unsignedBigInteger('hutang_id')->nullable(); 
            $table->double('total');
            $table->enum('arus', ['masuk', 'keluar']);
            $table->date('tanggal');
            $table->timestamps();
            $table->foreign('penjualan_id')->references('id')->on('penjualans')->onDelete('cascade');
            $table->foreign('hutang_id')->references('id')->on('hutangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasns');
    }
};
