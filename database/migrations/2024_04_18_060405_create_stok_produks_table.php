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
        Schema::create('stok_produks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->id();
            $table->string('namaPerusahaan');
            $table->string('volumeStokProduk')->nullable();
            $table->string('tonaseStokProduk')->nullable();
            $table->string('bulan');
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_produks');
    }
};
