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
        Schema::create('pd_feeder_perguruan_tinggi', function (Blueprint $table) {
            $table->string('id_perguruan_tinggi')->unique();
            $table->primary('id_perguruan_tinggi');
            $table->string('kode_perguruan_tinggi');
            $table->string('nama_perguruan_tinggi');
            $table->string('nama_singkat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_perguruan_tinggi');
    }
};
