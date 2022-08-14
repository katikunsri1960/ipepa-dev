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
        Schema::create('pd_feeder_transkrip_mahasiswa', function (Blueprint $table) {
            $table->string("id_registrasi_mahasiswa")->nullable();
            $table->index('id_registrasi_mahasiswa', 'idx_id_registrasi_mahasiswa');
            $table->string("id_matkul")->nullable();
            $table->string("id_kelas_kuliah")->nullable();
            $table->string("id_nilai_transfer")->nullable();
            $table->string("id_konversi_aktivitas")->nullable();
            $table->string("smt_diambil")->nullable();
            $table->string("kode_mata_kuliah")->nullable();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("nilai_angka")->nullable();
            $table->string("nilai_huruf")->nullable();
            $table->string("nilai_indeks")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_transkrip_mahasiswa');
    }
};
