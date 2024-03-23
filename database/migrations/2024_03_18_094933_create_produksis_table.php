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
        Schema::create('produksis', function (Blueprint $table) {
            $table->id();
            $table->string('namaPerusahaan');
            $table->string('komoditas');
            $table->string('bulan');
            $table->integer('tahun');
            $table->string('buktiBayar')->nullable();
            $table->string('volumeProduksi')->nullable();
            $table->string('tonaseProduksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksis');
    }
};
