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
        Schema::create('pd_feeder_alat_transportasi', function (Blueprint $table) {
            $table->integer('id_alat_transportasi')->unique();
            $table->primary('id_alat_transportasi');
            $table->string('nama_alat_transportasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat_transportasis');
    }
};
