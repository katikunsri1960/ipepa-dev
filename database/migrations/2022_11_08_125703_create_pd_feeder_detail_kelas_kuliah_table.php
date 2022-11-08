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
        Schema::create('pd_feeder_detail_kelas_kuliah', function (Blueprint $table) {
            $table->string("id_kelas_kuliah")->nullable();
            $table->index("id_kelas_kuliah", 'idx_kelas_kuliah');
            $table->string("id_prodi")->nullable();
            $table->index("id_prodi", 'idx_prodi');
            $table->string("nama_program_studi")->nullable();
            $table->string("id_semester")->nullable();
            $table->index("id_semester", 'idx_semester');
            $table->string("nama_semester")->nullable();
            $table->string("id_matkul")->nullable();
            $table->index("id_matkul", 'idx_matkul');
            $table->string("kode_mata_kuliah")->nullable();
            $table->string("nama_mata_kuliah")->nullable();
            $table->string("nama_kelas_kuliah")->nullable();
            $table->string("bahasan")->nullable();
            $table->string("tanggal_mulai_efektif")->nullable();
            $table->string("tanggal_akhir_efektif")->nullable();
            $table->string("kapasitas")->nullable();
            $table->string("tanggal_tutup_daftar")->nullable();
            $table->string("prodi_penyelenggara")->nullable();
            $table->string("perguruan_tinggi_penyelenggara")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_detail_kelas_kuliah');
    }
};
