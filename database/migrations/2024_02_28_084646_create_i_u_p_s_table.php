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
            $table->string('noSK_wiup')->nullable();
            $table->string('noSK_eksplor')->nullable();
            $table->string('noSK_op')->nullable();
            $table->string('noSK_p1')->nullable();
            $table->string('noSK_p2')->nullable();
            $table->string('luasWilayah');
            $table->string('tahapanKegiatan')->nullable();
            $table->string('jenisKegiatan')->nullable();
            $table->string('komoditas_wiup')->nullable();
            $table->string('komoditas_eksplor')->nullable();
            $table->string('komoditas_op')->nullable();
            $table->string('komoditas_p1')->nullable();
            $table->string('komoditas_p2')->nullable();
            $table->string('golongan_wiup')->nullable();
            $table->string('golongan_eksplor')->nullable();
            $table->string('golongan_op')->nullable();
            $table->string('golongan_p1')->nullable();
            $table->string('golongan_p2')->nullable();
            $table->integer('masaBerlaku_eksplor')->nullable();
            $table->integer('masaBerlaku_op')->nullable();
            $table->integer('masaBerlaku_p1')->nullable();
            $table->integer('masaBerlaku_p2')->nullable();
            $table->date('tanggalSK_wiup')->nullable();
            $table->date('tanggalSK_eksplor')->nullable();
            $table->date('tanggalSK_op')->nullable();
            $table->date('tanggalSK_p1')->nullable();
            $table->date('tanggalSK_p2')->nullable();
            $table->date('tanggalBerakhir_eksplor')->nullable();
            $table->date('tanggalBerakhir_op')->nullable();
            $table->date('tanggalBerakhir_p1')->nullable();
            $table->date('tanggalBerakhir_p2')->nullable();
            $table->string('lokasiIzin');
            $table->string('statusIzin')->nullable();
            $table->string('scanSK_wiup')->nullable();
            $table->string('scanSK_eksplor')->nullable();
            $table->string('scanSK_op')->nullable();
            $table->string('scanSK_p1')->nullable();
            $table->string('scanSK_p2')->nullable();
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
