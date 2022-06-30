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
        Schema::create('pd_feeder_wilayah', function (Blueprint $table) {

            $table->string('id_wilayah')->unique();
            $table->primary('id_wilayah');
            $table->string('id_negara');
            $table->foreign('id_negara')->references('id_negara')->on('pd_negara');
            $table->string('nama_wilayah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_wilayah');
    }
};
