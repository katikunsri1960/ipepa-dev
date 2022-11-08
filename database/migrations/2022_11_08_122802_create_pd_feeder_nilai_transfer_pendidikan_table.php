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
        Schema::create('pd_feeder_nilai_transfer_pendidikan', function (Blueprint $table) {
            $table->string("id_transfer")->nullable();
            $table->index('id_transfer', 'idx_transfer');
            $table->string("id_registrasi_mahasiswa")->nullable();
            $table->index('id_registrasi_mahasiswa', 'idx_registrasi_mahasiswa');
            $table->string("nim")->nullable();
            $table->string("nama_mahasiswa")->nullable();
            $table->string("id_prodi")->nullable();
            $table->index('id_prodi', 'idx_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("id_periode_masuk")->nullable();
            $table->index('id_periode_masuk', 'idx_periode_masuk');
            $table->string("kode_mata_kuliah_asal")->nullable();
            $table->string("nama_mata_kuliah_asal")->nullable();
            $table->string("sks_mata_kuliah_asal")->nullable();
            $table->string("nilai_huruf_asal")->nullable();
            $table->string("id_matkul")->nullable();
            $table->index('id_matkul', 'idx_matkul');
            $table->string("kode_matkul_diakui")->nullable();
            $table->string("nama_mata_kuliah_diakui")->nullable();
            $table->string("sks_mata_kuliah_diakui")->nullable();
            $table->string("nilai_huruf_diakui")->nullable();
            $table->string("nilai_angka_diakui")->nullable();
            $table->string("id_perguruan_tinggi")->nullable();
            $table->index('id_perguruan_tinggi', 'idx_perguruan_tinggi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_nilai_transfer_pendidikan');
    }
};
