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
        Schema::create('pd_feeder_jenis_daftar', function (Blueprint $table) {
            $table->integer('id_jenis_daftar')->unique();
            $table->primary('id_jenis_daftar');
            $table->string('nama_jenis_daftar');
            $table->boolean('untuk_daftar_sekolah')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_jenis_daftar');
    }
};
