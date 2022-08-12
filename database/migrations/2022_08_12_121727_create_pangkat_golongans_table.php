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
        Schema::create('pd_feeder_pangkat_golongan', function (Blueprint $table) {
            $table->integer('id_pangkat_golongan');
            $table->primary('id_pangkat_golongan');
            $table->string('kode_golongan');
            $table->string('nama_pangkat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_pangkat_golongan');
    }
};
