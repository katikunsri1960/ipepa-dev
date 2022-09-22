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
        Schema::create('pd_feeder_list_skala_nilai_prodi', function (Blueprint $table) {
            $table->datetime("tgl_create")->nullable();
            $table->string("id_bobot_nilai")->nullable();
            $table->index('id_bobot_nilai', 'idx_bobot_nilai');
            $table->string("id_prodi")->nullable();
            $table->index('id_prodi', 'idx_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("nilai_huruf")->nullable();
            $table->string("nilai_indeks")->nullable();
            $table->string("bobot_minimum")->nullable();
            $table->string("bobot_maksimum")->nullable();
            $table->date("tanggal_mulai_efektif")->nullable();
            $table->date("tanggal_akhir_efektif")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_skala_nilai_prodi');
    }
};
