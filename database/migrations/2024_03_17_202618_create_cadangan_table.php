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
        Schema::create('cadangans', function (Blueprint $table) {
            $table->id();
            $table->string('namaPerusahaan');
            $table->string('komoditas');
            $table->string('volumeTerkira')->nullable();
            $table->string('tonaseTerkira')->nullable();
            $table->string('volumeTerbukti')->nullable();
            $table->string('tonaseTerbukti')->nullable();
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
        Schema::dropIfExists('cadangans');
    }
};
