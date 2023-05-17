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
        Schema::table('pd_feeder_list_riwayat_pendidikan_mahasiswa', function (Blueprint $table) {
            $table->string("id_periode_keluar")->nullable();
            $table->string("tanggal_keluar")->nullable();
            $table->string("last_update")->nullable();
            $table->string("tgl_create")->nullable();
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
        Schema::table('pd_feeder_list_riwayat_pendidikan_mahasiswa', function (Blueprint $table) {
            //
        });
    }
};
