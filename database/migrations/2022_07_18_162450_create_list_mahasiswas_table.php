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
        Schema::create('pd_feeder_list_mahasiswa', function (Blueprint $table) {
            $table->string("id_mahasiswa")->nullable();
            $table->string("nama_mahasiswa")->nullable();
            $table->string("jenis_kelamin")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->string("id_perguruan_tinggi")->nullable();
            $table->string("nipd")->nullable();
            $table->string("ipk")->nullable();
            $table->string("total_sks")->nullable();
            $table->string("id_sms")->nullable();
            $table->string("id_agama")->nullable();
            $table->string("nama_agama")->nullable();
            $table->string("id_prodi")->nullable();
            $table->string("nama_program_studi")->nullable();
            $table->string("nama_status_mahasiswa")->nullable();
            $table->string("nim")->nullable();
            $table->string("id_periode")->nullable();
            $table->string("nama_periode_masuk")->nullable();
            $table->string("id_registrasi_mahasiswa")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_mahasiswa');
    }
};
