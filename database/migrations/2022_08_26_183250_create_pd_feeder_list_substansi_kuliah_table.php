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
        Schema::create('pd_feeder_list_substansi_kuliah', function (Blueprint $table) {
            $table->date("tgl_create")->nullable();
            $table->date("last_update")->nullable();
            $table->string("id_substansi")->nullable();
            $table->index('id_substansi', 'idx_sub');
            $table->string("id_prodi")->nullable();
            $table->index('id_prodi', 'idx_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("nama_substansi")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("sks_tatap_muka")->nullable();
            $table->string("sks_praktek")->nullable();
            $table->string("sks_praktek_lapangan")->nullable();
            $table->string("sks_simulasi")->nullable();
            $table->string("id_jenis_substansi")->nullable();
            $table->string("nama_jenis_substansi")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_substansi_kuliah');
    }
};
