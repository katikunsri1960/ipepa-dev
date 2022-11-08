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
        Schema::table('pd_feeder_riwayat_nilai_mahasiswa', function (Blueprint $table) {
            $table->index(['id_registrasi_mahasiswa', 'id_periode'], 'idx_id_reg_periode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pd_feeder_riwayat_nilai_mahasiswa', function (Blueprint $table) {
            //
        });
    }
};
