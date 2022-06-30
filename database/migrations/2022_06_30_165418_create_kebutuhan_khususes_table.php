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
        Schema::create('pd_feeder_kebutuhan_khusus', function (Blueprint $table) {
            $table->string('id_kebutuhan_khusus')->unique();
            $table->string('nama_kebutuhan_khusus');
            $table->primary('id_kebutuhan_khusus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_kebutuhan_khusus');
    }
};
