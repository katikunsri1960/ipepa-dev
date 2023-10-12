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
        Schema::create('daya_tampungs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jalur_ujian_id')->constrained('jalur_ujians');
            $table->string('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('pd_feeder_program_studi');
            $table->string('kode_pusat');
            $table->year('tahun');
            $table->integer('daya_tampung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daya_tampungs');
    }
};
