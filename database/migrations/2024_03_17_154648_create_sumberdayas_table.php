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
        Schema::create('sumberdayas', function (Blueprint $table) {
            $table->id();
            $table->string('namaPerusahaan');
            $table->string('komoditas');
            $table->string('jenisSdm')->nullable();
            $table->string('volumeTereka')->nullable();
            $table->string('volumeTertunjuk')->nullable();
            $table->string('volumeTerukur')->nullable();
            $table->string('tonaseTereka')->nullable();
            $table->string('tonaseTertunjuk')->nullable();
            $table->string('tonaseTerukur')->nullable();
            $table->string('luas');
            $table->string('cp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumberdayas');
    }
};
