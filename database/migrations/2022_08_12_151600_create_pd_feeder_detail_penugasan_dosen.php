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
        Schema::create('pd_feeder_detail_penugasan_dosen', function (Blueprint $table) {
            $table->string("id_registrasi_dosen")->nullable();
            $table->string("id_tahun_ajaran")->nullable();
            $table->string("nama_tahun_ajaran")->nullable();
            $table->string("id_perguruan_tinggi")->nullable();
            $table->string("nama_perguruan_tinggi")->nullable();
            $table->string("nidn")->nullable();
            $table->string("id_dosen")->nullable();
            $table->string("nama_dosen")->nullable();
            $table->string("id_prodi")->nullable();
            $table->string("nama_program_studi")->nullable();
            $table->string("nomor_surat_tugas")->nullable();
            $table->date("tanggal_surat_tugas")->nullable();
            $table->date("mulai_surat_tugas")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_detail_penugasan_dosen');
    }
};
