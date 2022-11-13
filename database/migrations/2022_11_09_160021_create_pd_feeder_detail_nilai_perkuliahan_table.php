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
        Schema::create('pd_feeder_detail_nilai_perkuliahan', function (Blueprint $table) {
            $table->string("id_prodi")->nullable();
            $table->index('id_prodi', 'idx_id_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("id_semester")->nullable();
            $table->index('id_semester', 'idx_id_semester');
            $table->string("nama_semester")->nullable();
            $table->string("id_matkul")->nullable();
            $table->index('id_matkul', 'idx_id_matkul');
            $table->string("kode_mata_kuliah")->nullable();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("id_kelas_kuliah")->nullable();
            $table->index('id_kelas_kuliah', 'idx_id_kelas_kuliah');
            $table->string("nama_kelas_kuliah")->nullable();
            $table->string("id_registrasi_mahasiswa")->nullable();
            $table->index('id_registrasi_mahasiswa', 'idx_id_registrasi_mahasiswa');
            $table->string("id_mahasiswa")->nullable();
            $table->index('id_mahasiswa', 'idx_id_mahasiswa');
            $table->string("nim")->nullable();
            $table->string("nama_mahasiswa")->nullable();
            $table->string("jurusan")->nullable();
            $table->string("angkatan")->nullable();
            $table->string("nilai_angka")->nullable();
            $table->string("nilai_indeks")->nullable();
            $table->string("nilai_huruf")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_detail_nilai_perkuliahan');
    }
};
