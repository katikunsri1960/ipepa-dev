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
        Schema::table('pd_feeder_aktivitas_kuliah_mahasiswa', function (Blueprint $table) {
            $table->index(['id_semester', 'id_prodi', 'id_mahasiswa', 'id_registrasi_mahasiswa'], 'idx_aktivitas_kuliah_mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pd_feeder_aktivitas_kuliah_mahasiswa', function (Blueprint $table) {
            $table->dropIndex('idx_aktivitas_kuliah_mahasiswa');
        });
    }
};