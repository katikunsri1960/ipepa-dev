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
        Schema::create('pd_feeder_jenjang_pendidikan', function (Blueprint $table) {
            $table->integer('id_jenjang_didik')->unique();
            $table->primary('id_jenjang_didik');
            $table->string('nama_jenjang_didik');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_jenjang_pendidikan');
    }
};
