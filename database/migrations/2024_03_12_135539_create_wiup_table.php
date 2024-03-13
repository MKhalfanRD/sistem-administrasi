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
        Schema::create('wiup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('i_u_p_id')->nullable();
            $table->foreign('i_u_p_id')->references('id')->on('i_u_p_s')->onDelete('set null');
            $table->date('tanggalSK_wiup')->nullable();
            $table->string('noSK_wiup')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wiup');
    }
};
