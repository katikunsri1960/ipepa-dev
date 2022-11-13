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
        Schema::create('pd_feeder_rencana_pembelajaran', function (Blueprint $table) {
            $table->string("id_rencana_ajar")->nullable();
            $table->index("id_rencana_ajar", 'idx_rencana_ajar');
            $table->string("id_matkul")->nullable();
            $table->index("id_matkul", 'idx_matkul');
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("kode_mata_kuliah")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("id_prodi")->nullable();
            $table->index("id_prodi", 'idx_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("pertemuan")->nullable();
            $table->text("materi_indonesia")->nullable();
            $table->text("materi_inggris")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_rencana_pembelajaran');
    }
};
