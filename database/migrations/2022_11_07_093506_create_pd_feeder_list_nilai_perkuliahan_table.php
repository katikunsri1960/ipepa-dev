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
        Schema::create('pd_feeder_list_nilai_perkuliahan', function (Blueprint $table) {
            $table->string("id_matkul")->nullable();
            $table->index('id_matkul', 'idx_matkul');
            $table->string("kode_mata_kuliah")->nullable();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("id_kelas_kuliah")->nullable();
            $table->index('id_kelas_kuliah', 'idx_kelas_kuliah');
            $table->string("nama_kelas_kuliah")->nullable();
            $table->string("sks_mata_kuliah")->nullable();
            $table->string("jumlah_mahasiswa_krs")->nullable();
            $table->string("jumlah_mahasiswa_dapat_nilai")->nullable();
            $table->string("sks_tm")->nullable();
            $table->string("sks_prak")->nullable();
            $table->string("sks_prak_lap")->nullable();
            $table->string("sks_sim")->nullable();
            $table->string("bahasan_case")->nullable();
            $table->string("a_selenggara_pditt")->nullable();
            $table->string("a_pengguna_pditt")->nullable();
            $table->string("kuota_pditt")->nullable();
            $table->string("tgl_mulai_koas")->nullable();
            $table->string("tgl_selesai_koas")->nullable();
            $table->string("id_mou")->nullable();
            $table->string("id_kls_pditt")->nullable();
            $table->string("id_sms")->nullable();
            $table->index('id_sms', 'idx_sms');
            $table->string("id_smt")->nullable();
            $table->index('id_smt', 'idx_smt');
            $table->date("tgl_create")->nullable();
            $table->string("lingkup_kelas")->nullable();
            $table->string("mode_kuliah")->nullable();
            $table->string("nm_smt")->nullable();
            $table->string("nama_prodi")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_nilai_perkuliahan');
    }
};
