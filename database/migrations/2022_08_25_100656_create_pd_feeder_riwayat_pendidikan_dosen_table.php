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
        Schema::create('pd_feeder_riwayat_pendidikan_dosen', function (Blueprint $table) {
            $table->string('id_dosen')->nullable();
            $table->index('id_dosen', 'idx_dosen');
            $table->string('nidn')->nullable();
            $table->string('nama_dosen')->nullable();
            $table->string('id_bidang_studi')->nullable();
            $table->string('nama_bidang_studi')->nullable();
            $table->string('id_jenjang_pendidikan')->nullable();
            $table->string('nama_jenjang_pendidikan')->nullable();
            $table->string('id_gelar_akademik')->nullable();
            $table->string('nama_gelar_akademik')->nullable();
            $table->string('id_perguruan_tinggi')->nullable();
            $table->string('nama_perguruan_tinggi')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('sks_lulus')->nullable();
            $table->string('ipk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_riwayat_pendidikan_dosen');
    }
};
