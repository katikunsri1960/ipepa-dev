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
        Schema::create('pd_feeder_dosen_pengajar_kelas_kuliah', function (Blueprint $table) {
            $table->string("id_aktivitas_mengajar")->nullable();
            $table->index("id_aktivitas_mengajar", 'idx_aktivitas_mengajar');
            $table->string("id_registrasi_dosen")->nullable();
            $table->index("id_registrasi_dosen", 'idx_registrasi_dosen');
            $table->string("id_dosen")->nullable();
            $table->index("id_dosen", 'idx_dosen');
            $table->string("nidn")->nullable();
            $table->string("nama_dosen")->nullable();
            $table->string("id_kelas_kuliah")->nullable();
            $table->index("id_kelas_kuliah", 'idx_kelas_kuliah');
            $table->string("nama_kelas_kuliah")->nullable();
            $table->string("id_substansi")->nullable();
            $table->index("id_substansi", 'idx_substansi');
            $table->string("sks_substansi_total")->nullable();
            $table->string("rencana_minggu_pertemuan")->nullable();
            $table->string("realisasi_minggu_pertemuan")->nullable();
            $table->string("id_jenis_evaluasi")->nullable();
            $table->index("id_jenis_evaluasi", 'idx_jenis_evaluasi');
            $table->string("nama_jenis_evaluasi")->nullable();
            $table->string("id_prodi")->nullable();
            $table->index("id_prodi", 'idx_prodi');
            $table->string("id_semester")->nullable();
            $table->index("id_semester", 'idx_semester');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_dosen_pengajar_kelas_kuliah');
    }
};
