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
        Schema::create('pd_feeder_tahun_ajaran', function (Blueprint $table) {
            $table->integer('id_tahun_ajaran');
            $table->primary('id_tahun_ajaran');
            $table->string('nama_tahun_ajaran')->nullable();
            $table->integer('a_periode_aktif')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_tahun_ajaran');
    }
};
