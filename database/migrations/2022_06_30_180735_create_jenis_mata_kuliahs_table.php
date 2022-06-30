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
        Schema::create('pd_feeder_jenis_mata_kuliah', function (Blueprint $table) {
            $table->string('id_jenis_mata_kuliah')->unique();
            $table->primary('id_jenis_mata_kuliah');
            $table->string('nama_jenis_mata_kuliah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_jenis_mata_kuliah');
    }
};
