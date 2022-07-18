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
        Schema::create('pd_feeder_semester', function (Blueprint $table) {
            $table->string('id_semester');
            $table->primary('id_semester');
            $table->integer('id_tahun_ajaran')->nullable();
            $table->string('nama_semester')->nullable();
            $table->integer('semester')->nullable();
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
        Schema::dropIfExists('pd_feeder_semester');
    }
};
