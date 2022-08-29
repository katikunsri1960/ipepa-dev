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
        Schema::create('pd_feeder_detail_mata_kuliah', function (Blueprint $table) {
            $table->string("id_matkul")->nullable();
            $table->index('id_matkul', 'idx_matkul');
            $table->string("kode_mata_kuliah")->nullable();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("id_prodi")->nullable();
            $table->index('id_prodi', 'idx_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("id_jenis_mata_kuliah")->nullable();
            $table->string("id_kelompok_mata_kuliah")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("sks_tatap_muka")->nullable();
            $table->string("sks_praktek")->nullable();
            $table->string("sks_praktek_lapangan")->nullable();
            $table->string("sks_simulasi")->nullable();
            $table->string("metode_kuliah")->nullable();
            $table->string("ada_sap")->nullable();
            $table->string("ada_silabus")->nullable();
            $table->string("ada_bahan_ajar")->nullable();
            $table->string("ada_acara_praktek")->nullable();
            $table->string("ada_diktat")->nullable();
            $table->datetime("tanggal_mulai_efektif")->nullable();
            $table->datetime("tanggal_selesai_efektif")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_detail_mata_kuliah');
    }
};
