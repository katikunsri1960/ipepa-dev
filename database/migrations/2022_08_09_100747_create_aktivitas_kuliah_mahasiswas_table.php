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
        Schema::create('pd_feeder_aktivitas_kuliah_mahasiswa', function (Blueprint $table) {
            $table->string("id_registrasi_mahasiswa")->nullable();
            $table->string("id_mahasiswa")->nullable();
            $table->string("id_semester")->nullable();
            $table->string("nama_semester")->nullable();
            $table->string("nim")->nullable();
            $table->string("nama_mahasiswa")->nullable();
            $table->string("angkatan")->nullable();
            $table->string("id_prodi")->nullable();
            $table->string("nama_program_studi")->nullable();
            $table->string("id_status_mahasiswa")->nullable();
            $table->string("nama_status_mahasiswa")->nullable();
            $table->string("ips")->nullable();
            $table->string("ipk")->nullable();
            $table->string("sks_semester")->nullable();
            $table->string("sks_total")->nullable();
            $table->string("biaya_kuliah_smt")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_aktivitas_kuliah_mahasiswa');
    }
};
