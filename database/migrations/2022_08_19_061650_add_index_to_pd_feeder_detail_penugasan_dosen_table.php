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
        Schema::table('pd_feeder_detail_penugasan_dosen', function (Blueprint $table) {
            $table->index(['id_prodi', 'id_tahun_ajaran'], 'idx_prodi_periode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pd_feeder_detail_penugasan_dosen', function (Blueprint $table) {
            //
        });
    }
};
