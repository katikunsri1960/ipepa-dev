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
        Schema::create('pd_feeder_list_riwayat_pendidikan_mahasiswa', function (Blueprint $table) {
            $table->string("id_registrasi_mahasiswa");
            $table->primary("id_registrasi_mahasiswa", 'pk_list_riwayat_pendidikan_mahasiswa');
            $table->string("id_mahasiswa")->nullable();
            $table->index('id_mahasiswa', 'idx_id_mahasiswa');
            $table->string("nim")->nullable();
            $table->string("nama_mahasiswa")->nullable();
            $table->string("id_jenis_daftar")->nullable();
            $table->string("nama_jenis_daftar")->nullable();
            $table->string("id_jalur_daftar")->nullable();
            $table->string("id_periode_masuk")->nullable();
            $table->string("nama_periode_masuk")->nullable();
            $table->string("id_jenis_keluar")->nullable();
            $table->string("keterangan_keluar")->nullable();
            $table->string("id_perguruan_tinggi")->nullable();
            $table->string("nama_perguruan_tinggi")->nullable();
            $table->string("id_prodi")->nullable();
            $table->string("nama_program_studi")->nullable();
            $table->string("sks_diakui")->nullable();
            $table->string("id_perguruan_tinggi_asal")->nullable();
            $table->string("nama_perguruan_tinggi_asal")->nullable();
            $table->string("id_prodi_asal")->nullable();
            $table->string("nama_program_studi_asal")->nullable();
            $table->string("jenis_kelamin")->nullable();
            $table->date("tanggal_daftar")->nullable();
            $table->string("nama_ibu_kandung")->nullable();
            $table->string("id_pembiayaan")->nullable();
            $table->string("nama_pembiayaan_awal")->nullable();
            $table->string("biaya_masuk")->nullable();
            $table->string("id_bidang_minat")->nullable();
            $table->string("nm_bidang_minat")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_riwayat_pendidikan_mahasiswa');
    }
};
