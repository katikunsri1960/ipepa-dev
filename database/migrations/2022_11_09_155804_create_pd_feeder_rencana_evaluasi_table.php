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
        Schema::create('pd_feeder_rencana_evaluasi', function (Blueprint $table) {
            $table->string("id_jenis_evaluasi")->nullable();
            $table->index('id_jenis_evaluasi', 'idx_id_jenis_evaluasi');
            $table->string("id_rencana_evaluasi")->nullable();
            $table->index('id_rencana_evaluasi', 'idx_id_rencana_evaluasi');
            $table->string("jenis_evaluasi")->nullable();
            $table->string("id_matkul")->nullable();
            $table->index('id_matkul', 'idx_id_matkul');
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("kode_mata_kuliah")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("id_prodi")->nullable();
            $table->index('id_prodi', 'idx_id_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("nama_evaluasi")->nullable();
            $table->text("deskripsi_indonesia")->nullable();
            $table->text("deskrips_inggris")->nullable();
            $table->string("nomor_urut")->nullable();
            $table->string("bobot_evaluasi")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_rencana_evaluasi');
    }
};
