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
        Schema::create('k_t_t_s', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->id();
            $table->string('namaPerusahaan');
            $table->string('namaKtt');
            $table->string('statusKTT')->nullable();
            $table->integer('noSK');
            $table->string('bulan');
            $table->integer('tahun');
            $table->string('fileUpload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('k_t_t_s');
    }
};
