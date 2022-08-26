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
        Schema::create('pd_feeder_aktivitas_mengajar_dosen', function (Blueprint $table) {
            $table->string("id_registrasi_dosen")->nullable();
            $table->index('id_registrasi_dosen', 'idx_reg_dos');
            $table->string("id_dosen")->nullable();
            $table->index('id_dosen', 'idx_dos');
            $table->string("nama_dosen")->nullable();
            $table->string("id_periode")->nullable();
            $table->index('id_periode', 'idx_per');
            $table->index(['id_dosen', 'id_periode'], 'idx_dos_per');
            $table->index(['id_registrasi_dosen', 'id_periode'], 'idx_reg_per');
            $table->string("nama_periode")->nullable();
            $table->string("id_prodi")->nullable();
            $table->string("nama_program_studi")->nullable();
            $table->string("id_matkul")->nullable();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("id_kelas")->nullable();
            $table->string("nama_kelas_kuliah")->nullable();
            $table->string("rencana_minggu_pertemuan")->nullable();
            $table->string("realisasi_minggu_pertemuan")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_aktivitas_mengajar_dosen');
    }
};
