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
        Schema::create('pd_feeder_riwayat_penelitian_dosen', function (Blueprint $table) {
            $table->string("id_dosen")->nullable();
            $table->index('id_dosen', 'idx_dosen');
            $table->string("nidn")->nullable();
            $table->string("nama_dosen")->nullable();
            $table->string("id_penelitian")->nullable();
            $table->text("judul_penelitian")->nullable();
            $table->string("id_kelompok_bidang")->nullable();
            $table->string("kode_kelompok_bidang")->nullable();
            $table->string("nama_kelompok_bidang")->nullable();
            $table->string("id_lembaga_iptek")->nullable();
            $table->string("nama_lembaga_iptek")->nullable();
            $table->string("tahun_kegiatan")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_riwayat_penelitian_dosen');
    }
};
