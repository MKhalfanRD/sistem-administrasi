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
        Schema::create('i_u_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('namaPerusahaan');
            $table->text('alamat');
            $table->integer('npwp');
            $table->integer('nib');
            $table->string('kabupaten');
            $table->string('noSK')->nullable();
            $table->string('luasWilayah');
            $table->string('tahapanKegiatan');
            $table->string('komoditas');
            $table->integer('masaBerlaku')->nullable();
            $table->date('tanggalSK')->nullable();
            $table->date('tanggalBerakhir')->nullable();
            $table->string('lokasiIzin');
            $table->string('statusIzin')->nullable();
            $table->string('scanSK')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_u_p_s');
    }
};
