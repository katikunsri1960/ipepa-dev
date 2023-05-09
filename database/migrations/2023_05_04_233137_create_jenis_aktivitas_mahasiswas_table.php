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
        Schema::create('pd_feeder_jenis_aktivitas_mahasiswa', function (Blueprint $table) {
            $table->integer('id_jenis_aktivitas_mahasiswa')->primary();
            $table->string('nama_jenis_aktivitas_mahasiswa')->nullable();
            $table->boolean('untuk_kampus_merdeka')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_jenis_aktivitas_mahasiswa');
    }
};
