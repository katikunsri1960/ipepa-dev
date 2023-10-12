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
        Schema::table('peminats', function (Blueprint $table) {
            $table->unique(['jalur_ujian_id', 'id_prodi', 'tahun']);
        });
        Schema::table('daya_tampungs', function (Blueprint $table) {
            $table->unique(['jalur_ujian_id', 'id_prodi', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminats', function (Blueprint $table) {
            //
        });
    }
};
