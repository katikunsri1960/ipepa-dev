<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pd_feeder_riwayat_sertifikasi_dosen', function (Blueprint $table) {
            $table->string('id_dosen')->nullable();
            $table->index('id_dosen', 'idx_dosen');
            $table->string('nidn')->nullable();
            $table->string('nama_dosen')->nullable();
            $table->string('nomor_peserta')->nullable();
            $table->string('id_bidang_studi')->nullable();
            $table->string('nama_bidang_studi')->nullable();
            $table->string('id_jenis_sertifikasi')->nullable();
            $table->string('nama_jenis_sertifikasi')->nullable();
            $table->string('tahun_sertifikasi')->nullable();
            $table->string('sk_sertifikasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_riwayat_sertifikasi_dosen');
    }
};
