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
        Schema::table('pd_feeder_list_mahasiswa', function (Blueprint $table) {
            $table->index(['id_prodi', 'id_periode'], 'idx_periode_to_pd_feeder_list_mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pd_feeder_list_mahasiswa', function (Blueprint $table) {
            //
        });
    }
};
