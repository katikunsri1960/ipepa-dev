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
        Schema::create('pd_feeder_detail_kurikulum', function (Blueprint $table) {
            $table->string('id_kurikulum')->nullable();
            $table->index('id_kurikulum', 'idx_kurikulum');
            $table->string('nama_kurikulum')->nullable();
            $table->string('id_prodi')->nullable();
            $table->index('id_prodi', 'idx_prodi');
            $table->string('nama_program_studi')->nullable();
            $table->string('id_semester')->nullable();
            $table->index('id_semester', 'idx_semester');
            $table->string('semester_mulai_berlaku')->nullable();
            $table->string('jumlah_sks_lulus')->nullable();
            $table->string('jumlah_sks_wajib')->nullable();
            $table->string('jumlah_sks_pilihan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feeder_detail_kurikulum');
    }
};
