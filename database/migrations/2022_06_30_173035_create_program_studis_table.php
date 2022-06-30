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
        Schema::create('pd_feeder_program_studi', function (Blueprint $table) {
            $table->string('id_prodi')->unique();
            $table->primary('id_prodi');
            $table->string('kode_program_studi');
            $table->string('nama_program_studi');
            $table->string('status');
            $table->integer('id_jenjang_pendidikan');
            $table->foreign('id_jenjang_pendidikan')->references('id_jenjang_didik')->on('pd_feeder_jenjang_pendidikan');
            $table->string('nama_jenjang_pendidikan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_program_studi');
    }
};
