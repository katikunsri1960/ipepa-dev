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
        Schema::create('pd_feeder_jenis_keluar', function (Blueprint $table) {
            $table->string('id_jenis_keluar', 2);
            $table->primary('id_jenis_keluar');
            $table->string('jenis_keluar')->nullable();
            $table->boolean('apa_mahasiswa')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_jenis_keluar');
    }
};
