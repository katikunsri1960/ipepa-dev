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
        Schema::create('pd_feeder_all_prodi', function (Blueprint $table) {
            $table->string('id_perguruan_tinggi');
            $table->string('id_prodi')->unique();
            $table->primary('id_prodi');
            $table->string('kode_program_studi')->nullable();
            $table->string('nama_program_studi');
            $table->string('status', 20)->nullable();
            $table->integer('id_jenjang_pendidikan')->nullable();
            $table->string('nama_perguruan_tinggi')->nullable();
            $table->string('kode_perguruan_tinggi')->nullable();
            $table->string('nama_jenjang_pendidikan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_all_prodi');
    }
};
