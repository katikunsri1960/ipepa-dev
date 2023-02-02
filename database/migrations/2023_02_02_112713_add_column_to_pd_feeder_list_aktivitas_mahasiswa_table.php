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
        Schema::table('pd_feeder_list_aktivitas_mahasiswa', function (Blueprint $table) {
            $table->string('asal_data')->nullable();
            $table->string('nama_program_mbkm')->nullable();
            $table->string('nm_asaldata')->nullable();
            $table->string('program_mbkm')->nullable();
            $table->string('tanggal_mulai')->nullable();
            $table->string('tanggal_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pd_feeder_list_aktivitas_mahasiswa', function (Blueprint $table) {
            //
        });
    }
};
