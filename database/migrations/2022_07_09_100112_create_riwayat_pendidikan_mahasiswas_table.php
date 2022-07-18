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
        Schema::create('riwayat_pendidikan_mahasiswa', function (Blueprint $table) {
            $table->string('id_registrasi_mahasiswa')->unique();
            $table->primary('id_registrasi_mahasiswa');
            $table->string('id_mahasiswa');
            $table->string('nim', 40);
            $table->string('nama_mahasiswa');
            $table->integer('id_jenis_daftar')->nullable();
            $table->string('nama_jenis_daftar')->nullable();
            $table->string('nama_jalur_daftar')->nullable();
            $table->unsignedBigInteger('id_jalur_daftar')->nullable();
            $table->string('id_periode_masuk')->nullable();
            $table->string('nama_periode_masuk')->nullable();
            $table->date('tanggal_daftar')->nullable();
            $table->string('id_jenis_keluar', 2)->nullable();
            $table->string('keterangan_keluar')->nullable();
            $table->string('id_perguruan_tinggi')->nullable();
            $table->string('nama_perguruan_tinggi')->nullable();
            $table->string('id_prodi');
            $table->string('nama_program_studi')->nullable();
            $table->integer('sks_diakui')->nullable();
            $table->string('id_perguruan_tinggi_asal')->nullable();
            $table->string('nama_perguruan_tinggi_asal')->nullable();
            $table->string('id_prodi_asal')->nullable();
            $table->string('nama_program_studi_asal')->nullable();
            $table->string('jenis_kelamin', 1)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nama_ibu_kandung')->nullable();
            $table->unsignedBigInteger('id_pembiayaan')->nullable();
            $table->string('nama_pembiayaan_awal')->nullable();
            $table->bigInteger('biaya_masuk')->nullable();
            $table->string('id_bidang_minat')->nullable();
            $table->string('nm_bidang_minat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pendidikan_mahasiswa');
    }
};
