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
        Schema::create('raw_inventoris', function (Blueprint $table) {
            $table->id();
            $table->string('namaPerusahaan');
            $table->string('volumeRawInventori')->nullable();
            $table->string('tonaseRawInventori')->nullable();
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
        Schema::dropIfExists('raw_inventoris');
    }
};
