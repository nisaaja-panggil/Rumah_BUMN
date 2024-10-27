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
        Schema::create('hutangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penitipan_id');
            $table->decimal('jumlah_hutang', 15, 2);
            $table->decimal('jumlah_bayar', 15, 2)->default(0);
            $table->decimal('sisa_hutang', 15, 2)->storedAs('jumlah_hutang - jumlah_bayar');
            $table->boolean('status')->storedAs('sisa_hutang <= 0');
            $table->date('tanggal');
            $table->timestamps();
            $table->foreign('penitipan_id')->references('id')->on('penitipans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hutangs');
    }
};
