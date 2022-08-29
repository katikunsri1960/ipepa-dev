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
        Schema::create('pd_feeder_list_aktivitas_mahasiswa', function (Blueprint $table) {
            $table->string("id_aktivitas")->nullable();
            $table->index('id_aktivitas', 'idx_aktivitas');
            $table->string("jenis_anggota")->nullable();
            $table->string("nama_jenis_anggota")->nullable();
            $table->string("id_jenis_aktivitas")->nullable();
            $table->string("nama_jenis_aktivitas")->nullable();
            $table->string("id_prodi")->nullable();
            $table->string("nama_prodi")->nullable();
            $table->string("id_semester")->nullable();
            $table->string("nama_semester")->nullable();
            $table->text("judul")->nullable();
            $table->string("keterangan")->nullable();
            $table->string("lokasi")->nullable();
            $table->string("sk_tugas")->nullable();
            $table->date("tanggal_sk_tugas")->nullable();
            $table->string("untuk_kampus_merdeka")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_aktivitas_mahasiswa');
    }
};
