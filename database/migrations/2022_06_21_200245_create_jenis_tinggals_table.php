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
        Schema::create('pd_feeder_jenis_tinggal', function (Blueprint $table) {
            $table->integer('id_jenis_tinggal')->unique();
            $table->primary('id_jenis_tinggal');
            $table->string('nama_jenis_tinggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_jenis_tinggal');
    }
};
