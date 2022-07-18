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
        Schema::create('pd_feeder_profil_pt', function (Blueprint $table) {
            $table->string('id_perguruan_tinggi');
            $table->string('kode_perguruan_tinggi')->nullable();
            $table->string('nama_perguruan_tinggi')->nullable();
            $table->string('telepon', 30)->nullable();
            $table->string('faximile', 30)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('website')->nullable();
            $table->string('jalan')->nullable();
            $table->string('dusun')->nullable();
            $table->string('rt_rw')->nullable();
            $table->string('kelurahan');
            $table->string('kode_pos')->nullable();
            $table->string('id_wilayah');
            $table->string('nama_wilayah')->nullable();
            $table->string('lintang_bujur')->nullable();
            $table->string('bank')->nullable();
            $table->string('unit_cabang')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->integer('mbs');
            $table->integer('luas_tanah_milik');
            $table->integer('luas_tanah_bukan_milik');
            $table->string('sk_pendirian')->nullable();
            $table->date('tanggal_sk_pendirian')->nullable();
            $table->integer('id_status_milik');
            $table->string('nama_status_milik');
            $table->string('status_perguruan_tinggi');
            $table->string('sk_izin_operasional')->nullable();
            $table->date('tanggal_izin_operasional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_profil_pt');
    }
};
