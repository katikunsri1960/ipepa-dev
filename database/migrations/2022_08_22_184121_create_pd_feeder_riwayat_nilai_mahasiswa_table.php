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
        Schema::create('pd_feeder_riwayat_nilai_mahasiswa', function (Blueprint $table) {
            $table->string("id_registrasi_mahasiswa")->nullable();
            $table->index('id_registrasi_mahasiswa', 'idx_id_reg');
            $table->string("id_periode")->nullable();
            $table->index('id_periode', 'idx_periode');
            $table->index(['id_registrasi_mahasiswa','id_periode'], 'idx_id_per_reg');
            $table->string("id_matkul")->nullable();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("id_kelas")->nullable();
            $table->string("nama_kelas_kuliah")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("nilai_angka")->nullable();
            $table->string("nilai_huruf")->nullable();
            $table->string("nilai_indeks")->nullable();
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
        Schema::dropIfExists('pd_feeder_riwayat_nilai_mahasiswa');
    }
};
