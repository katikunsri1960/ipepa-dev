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
        Schema::table('pd_feeder_list_penugasan_dosen', function (Blueprint $table) {
            $table->index('id_tahun_ajaran', 'idx_tahun_ajaran');
            $table->index('id_prodi', 'idx_prodi');
            $table->index('id_registrasi_dosen', 'idx_registrasi_dosen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pd_feeder_list_penugasan_dosen', function (Blueprint $table) {
            //
        });
    }
};
