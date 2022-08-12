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
        Schema::create('pd_feeder_list_dosen', function (Blueprint $table) {
            $table->string("id_dosen");
            $table->primary("id_dosen");
            $table->string("nama_dosen")->nullable();
            $table->string("nidn")->nullable();
            $table->string("nip")->nullable();
            $table->string("jenis_kelamin")->nullable();
            $table->string("id_agama")->nullable();
            $table->string("nama_agama")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->string("id_status_aktif")->nullable();
            $table->string("nama_status_aktif")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_list_dosen');
    }
};
