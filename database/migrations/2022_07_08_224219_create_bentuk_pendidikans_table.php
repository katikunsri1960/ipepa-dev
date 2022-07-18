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
        Schema::create('pd_feeder_bentuk_pendidikan', function (Blueprint $table) {
            $table->integer('id_bentuk_pendidikan');
            $table->primary('id_bentuk_pendidikan');
            $table->string('nama_bentuk_pendidikan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_bentuk_pendidikan');
    }
};
