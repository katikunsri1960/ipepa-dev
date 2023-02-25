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
        Schema::table('pd_feeder_riwayat_nilai_mahasiswa', function (Blueprint $table) {
            $table->string('id_prodi',)->after('id_registrasi_mahasiswa')->nullable();
            $table->string('nama_program_studi',)->after('id_prodi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pd_feeder_riwayat_nilai_mahasiswa', function (Blueprint $table) {
            //
        });
    }
};
