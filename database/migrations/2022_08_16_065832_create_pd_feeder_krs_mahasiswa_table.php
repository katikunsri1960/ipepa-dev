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
        Schema::create('pd_feeder_krs_mahasiswa', function (Blueprint $table) {
            $table->string("id_registrasi_mahasiswa")->nullable();
            $table->index('id_registrasi_mahasiswa', 'idx_krs_id_rm');
            $table->string("id_periode")->nullable();
            $table->string("id_prodi")->nullable();
            $table->string("nama_program_studi")->nullable();
            $table->string("id_matkul")->nullable();
            $table->string("kode_mata_kuliah")->nullable();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("id_kelas")->nullable();
            $table->string("nama_kelas_kuliah")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("nim")->nullable();
            $table->string("nama_mahasiswa")->nullable();
            $table->string("angkatan")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_krs_mahasiswa');
    }
};
