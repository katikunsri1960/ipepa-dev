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
        Schema::create('pd_feeder_list_anggota_aktivitas_mahasiswa', function (Blueprint $table) {
            $table->string("id_aktivitas")->nullable();
            $table->index('id_aktivitas', 'idx_aktivitas');
            $table->text("judul")->nullable();
            $table->string("id_anggota")->nullable();
            $table->string("id_registrasi_mahasiswa")->nullable();
            $table->index('id_registrasi_mahasiswa', 'idx_reg_mahasiswa');
            $table->string("nim")->nullable();
            $table->string("nama_mahasiswa")->nullable();
            $table->string("jenis_peran")->nullable();
            $table->string("nama_jenis_peran")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_anggota_aktivitas_mahasiswa');
    }
};
