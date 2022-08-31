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
        Schema::create('pd_feeder_list_uji_mahasiswa', function (Blueprint $table) {
            $table->string('id_aktivitas')->nullable();
            $table->index('id_aktivitas', 'idx_aktivitas');
            $table->text('judul')->nullable();
            $table->string('id_uji')->nullable();
            $table->string('id_kategori_kegiatan')->nullable();
            $table->text('nama_kategori_kegiatan')->nullable();
            $table->string('id_dosen')->nullable();
            $table->index('id_dosen', 'idx_dosen');
            $table->string('nidn')->nullable();
            $table->string('nama_dosen')->nullable();
            $table->string('penguji_ke')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_uji_mahasiswa');
    }
};
