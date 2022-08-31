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
        Schema::create('pd_feeder_list_prestasi_mahasiswa', function (Blueprint $table) {
            $table->string("id_prestasi")->nullable();
            $table->string("id_mahasiswa")->nullable();
            $table->index('id_mahasiswa', 'idx_id_mahasiswa');
            $table->string("nama_mahasiswa")->nullable();
            $table->string("id_jenis_prestasi")->nullable();
            $table->string("nama_jenis_prestasi")->nullable();
            $table->string("id_tingkat_prestasi")->nullable();
            $table->string("nama_tingkat_prestasi")->nullable();
            $table->string("nama_prestasi")->nullable();
            $table->string("tahun_prestasi")->nullable();
            $table->string("penyelenggara")->nullable();
            $table->string("peringkat")->nullable();
            $table->string("id_aktivitas")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_prestasi_mahasiswa');
    }
};
