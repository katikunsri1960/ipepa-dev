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
        Schema::table('pd_feeder_list_bimbing_mahasiswa', function (Blueprint $table) {
            $table->string("status_sync")->nullable();
        });

        Schema::table('pd_feeder_list_uji_mahasiswa', function (Blueprint $table) {
            $table->string("status_sync")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pd_feeder_list_bimbing_mahasiswa', function (Blueprint $table) {
            //
        });
    }
};
