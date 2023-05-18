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
        Schema::create('pd_feeder_list_kelas_kuliah', function (Blueprint $table) {
            $table->string('id_kelas_kuliah')->nullable();
            $table->index('id_kelas_kuliah', 'idx_kelas_kuliah');
            $table->string('id_prodi')->nullable();
            $table->index('id_prodi', 'idx_prodi');
            $table->string('nama_program_studi')->nullable();
            $table->string('id_semester')->nullable();
            $table->index('id_semester', 'idx_semester');
            $table->string('nama_semester')->nullable();
            $table->string('id_matkul')->nullable();
            $table->string('kode_mata_kuliah')->nullable();
            $table->string('nama_mata_kuliah')->nullable();
            $table->string('nama_kelas_kuliah')->nullable();
            $table->string('sks')->nullable();
            $table->text('id_dosen')->nullable();
            $table->text('nama_dosen')->nullable();
            $table->string('jumlah_mahasiswa')->nullable();
            $table->string('apa_untuk_pditt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_kelas_kuliah');
    }
};
