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
        Schema::create('operasi_produksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('i_u_p_id')->nullable();
            $table->foreign('i_u_p_id')->references('id')->on('i_u_p_s')->onDelete('set null');
            $table->date('tanggalSK_op')->nullable();
            $table->string('noSK_op')->nullable();
            $table->integer('masaBerlaku_op')->nullable();
            $table->date('tanggalBerakhir_op')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operasi_produksi');
    }
};
