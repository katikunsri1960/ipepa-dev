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
        Schema::create('pd_feeder_konversi_kampus_merdeka', function (Blueprint $table) {
            $table->string("id_konversi_aktivitas")->nullable()->index();
            $table->string("id_matkul")->nullable()->index();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("id_aktivitas")->nullable()->index();
            $table->string("judul")->nullable();
            $table->string("id_anggota")->nullable()->index();
            $table->string("nama_mahasiswa")->nullable();
            $table->string("nim")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("nilai_angka")->nullable();
            $table->string("nilai_indeks")->nullable();
            $table->string("nilai_huruf")->nullable();
            $table->string("id_semester")->nullable();
            $table->string("nama_semester")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_konversi_kampus_merdeka');
    }
};
