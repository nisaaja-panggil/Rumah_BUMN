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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('jenis_usaha');
            $table->string('no_hp');
            $table->timestamps();
        });
        Schema::table('penitipans', function (Blueprint $table) {
            $table->foreign('umkm_id')->references('id')->on('umkms')->onUpdate('cascade')->onDelete('cascade');
        });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
