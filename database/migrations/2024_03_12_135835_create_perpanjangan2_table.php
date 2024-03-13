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
        Schema::create('perpanjangan2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('i_u_p_id')->nullable();
            $table->foreign('i_u_p_id')->references('id')->on('i_u_p_s')->onDelete('set null');
            $table->date('tanggalSK_p2')->nullable();
            $table->string('noSK_p2')->nullable();
            $table->integer('masaBerlaku_p2')->nullable();
            $table->date('tanggalBerakhir_p2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perpanjangan2');
    }
};
