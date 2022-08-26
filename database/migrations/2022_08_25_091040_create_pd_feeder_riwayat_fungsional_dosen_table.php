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
        Schema::create('pd_feeder_riwayat_fungsional_dosen', function (Blueprint $table) {
            $table->string("id_dosen")->nullable();
            $table->index('id_dosen', 'idx_id_dosen');
            $table->string("nidn")->nullable();
            $table->string("nama_dosen")->nullable();
            $table->string("id_jabatan_fungsional")->nullable();
            $table->string("nama_jabatan_fungsional")->nullable();
            $table->string("sk_jabatan_fungsional")->nullable();
            $table->date("mulai_sk_jabatan")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_riwayat_fungsional_dosen');
    }
};
