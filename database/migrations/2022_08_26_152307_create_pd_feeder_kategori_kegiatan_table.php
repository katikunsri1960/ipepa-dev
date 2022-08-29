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
        Schema::create('pd_feeder_kategori_kegiatan', function (Blueprint $table) {
            $table->string("id_kategori_kegiatan")->nullable();
            $table->index('id_kategori_kegiatan', 'idx_kk');
            $table->text("nama_kategori_kegiatan")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_kategori_kegiatan');
    }
};
