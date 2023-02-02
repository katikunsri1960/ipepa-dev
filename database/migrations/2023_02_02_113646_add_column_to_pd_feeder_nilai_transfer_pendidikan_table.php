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
        Schema::table('pd_feeder_nilai_transfer_pendidikan', function (Blueprint $table) {
            $table->string('id_aktivitas')->nullable();
            $table->text('judul')->nullable();
            $table->string("id_jenis_aktivitas")->nullable();
            $table->string("nama_jenis_aktivitas")->nullable();
            $table->string("id_semester")->nullable();
            $table->string("nama_semester")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pd_feeder_nilai_transfer_pendidikan', function (Blueprint $table) {
            //
        });
    }
};
