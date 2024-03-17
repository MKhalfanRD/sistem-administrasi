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
        Schema::create('jampas', function (Blueprint $table) {
            $table->id();
            $table->string('namaPerusahaan');
            $table->string('besaranDitetapkan');
            $table->date('tanggal');
            $table->string('filePenempatan')->nullable();
            $table->string('besaranDitempatkan');
            $table->date('tanggalPenempatan');
            $table->date('jatuhTempo');
            $table->string('namaBank');
            $table->string('bentukPenempatan');
            $table->integer('noSeri');
            $table->integer('noRekening');
            $table->string('filePasca')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jampas');
    }
};
