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
        Schema::create('pd_feeder_riwayat_pangkat_dosen', function (Blueprint $table) {
            $table->string("id_dosen")->nullable();
            $table->index('id_dosen', 'idx_dosen');
            $table->string("nidn")->nullable();
            $table->string("nama_dosen")->nullable();
            $table->string("id_pangkat_golongan")->nullable();
            $table->string("nama_pangkat_golongan")->nullable();
            $table->string("sk_pangkat")->nullable();
            $table->date("tanggal_sk_pangkat")->nullable();
            $table->date("mulai_sk_pangkat")->nullable();
            $table->string("masa_kerja_dalam_tahun")->nullable();
            $table->string("masa_kerja_dalam_bulan")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_riwayat_pangkat_dosen');
    }
};
