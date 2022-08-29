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
        Schema::create('pd_feeder_dosen_pembimbing', function (Blueprint $table) {
            $table->string("id_registrasi_mahasiswa")->nullable();
            $table->index('id_registrasi_mahasiswa', 'idx_reg_mahasiswa');
            $table->string("nama_mahasiswa")->nullable();
            $table->string("nim")->nullable();
            $table->string("id_dosen")->nullable();
            $table->index('id_dosen', 'idx_dosen');
            $table->string("nidn")->nullable();
            $table->string("nama_dosen")->nullable();
            $table->string("pembimbing_ke")->nullable();
            $table->string("jenis_aktivitas")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_dosen_pembimbing');
    }
};
