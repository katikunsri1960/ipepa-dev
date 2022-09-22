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
        Schema::create('pd_feeder_matkul_kurikulum', function (Blueprint $table) {
            $table->date("tgl_create")->nullable();
            $table->string("id_kurikulum")->nullable();
            $table->index('id_kurikulum', 'idx_kurikulum');
            $table->string("nama_kurikulum")->nullable();
            $table->string("id_matkul")->nullable();
            $table->index('id_matkul', 'idx_matkul');
            $table->string("kode_mata_kuliah")->nullable();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("id_prodi")->nullable();
            $table->index('id_prodi', 'idx_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("semester")->nullable();
            $table->string("id_semester")->nullable();
            $table->index('id_semester', 'idx_semester');
            $table->string("semester_mulai_berlaku")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("sks_tatap_muka")->nullable();
            $table->string("sks_praktek")->nullable();
            $table->string("sks_praktek_lapangan")->nullable();
            $table->string("sks_simulasi")->nullable();
            $table->string("apakah_wajib")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_matkul_kurikulum');
    }
};
