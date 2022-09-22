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
        Schema::create('pd_feeder_list_periode_perkuliahan', function (Blueprint $table) {
            $table->string("id_prodi")->nullable();
            $table->index('id_prodi', 'idx_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("id_semester")->nullable();
            $table->index('id_semester', 'idx_semester');
            $table->string("nama_semester")->nullable();
            $table->string("jumlah_target_mahasiswa_baru")->nullable();
            $table->date("tanggal_awal_perkuliahan")->nullable();
            $table->date("tanggal_akhir_perkuliahan")->nullable();
            $table->string("calon_ikut_seleksi")->nullable();
            $table->string("calon_lulus_seleksi")->nullable();
            $table->string("daftar_sbg_mhs")->nullable();
            $table->string("pst_undur_diri")->nullable();
            $table->string("jml_mgu_kul")->nullable();
            $table->string("metode_kul")->nullable();
            $table->string("metode_kul_eks")->nullable();
            $table->date("tgl_create")->nullable();
            $table->date("last_update")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_periode_perkuliahan');
    }
};
