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
        Schema::create('pd_feeder_biodata_mahasiswa', function (Blueprint $table) {
            $table->string('id_mahasiswa')->unique();
            $table->primary('id_mahasiswa');
            $table->string('nama_mahasiswa', 100);
            $table->string('jenis_kelamin', 1)->nullable();
            $table->string('tempat_lahir', 32)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('id_agama')->nullable();
            $table->foreign('id_agama')->references('id_agama')->on('pd_feeder_agama');
            $table->string('nik', 30)->nullable();
            $table->string('nisn', 10)->nullable();
            $table->string('npwp',15)->nullable();
            $table->string('id_negara')->nullable();
            $table->foreign('id_negara')->references('id_negara')->on('pd_negara');
            $table->string('kewarganegaraan')->nullable();
            $table->string('jalan')->nullable();
            $table->string('dusun', 60)->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('id_wilayah')->nullable();
            $table->foreign('id_wilayah')->references('id_wilayah')->on('pd_feeder_wilayah');
            $table->integer('id_jenis_tinggal')->nullable();
            $table->foreign('id_jenis_tinggal')->references('id_jenis_tinggal')->on('pd_feeder_jenis_tinggal');
            $table->integer('id_alat_transportasi')->nullable();
            $table->foreign('id_alat_transportasi')->references('id_alat_transportasi')->on('pd_feeder_alat_transportasi');
            $table->string('telepon', 20)->nullable();
            $table->string('handphone', 20)->nullable();
            $table->string('email', 60)->nullable();
            $table->boolean('penerima_kps');
            $table->string('nomor_kps', 80)->nullable();

            $table->string('nik_ayah',30)->nullable();
            $table->string('nama_ayah', 100)->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->integer('id_pendidikan_ayah')->nullable();
            $table->foreign('id_pendidikan_ayah')->references('id_jenjang_didik')->on('pd_feeder_jenjang_pendidikan');
            $table->integer('id_pekerjaan_ayah')->nullable();
            $table->foreign('id_pekerjaan_ayah')->references('id_pekerjaan')->on('pd_feeder_pekerjaan');
            $table->integer('id_penghasilan_ayah')->nullable();
            $table->foreign('id_penghasilan_ayah')->references('id_penghasilan')->on('pd_feeder_penghasilan');

            $table->string('nik_ibu',30)->nullable();
            $table->string('nama_ibu_kandung', 100);
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->integer('id_pendidikan_ibu')->nullable();
            $table->foreign('id_pendidikan_ibu')->references('id_jenjang_didik')->on('pd_feeder_jenjang_pendidikan');
            $table->integer('id_pekerjaan_ibu')->nullable();
            $table->foreign('id_pekerjaan_ibu')->references('id_pekerjaan')->on('pd_feeder_pekerjaan');
            $table->integer('id_penghasilan_ibu')->nullable();
            $table->foreign('id_penghasilan_ibu')->references('id_penghasilan')->on('pd_feeder_penghasilan');

            $table->string('nama_wali', 100)->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->integer('id_pendidikan_wali')->nullable();
            $table->foreign('id_pendidikan_wali')->references('id_jenjang_didik')->on('pd_feeder_jenjang_pendidikan');
            $table->integer('id_pekerjaan_wali')->nullable();
            $table->foreign('id_pekerjaan_wali')->references('id_pekerjaan')->on('pd_feeder_pekerjaan');
            $table->integer('id_penghasilan_wali')->nullable();
            $table->foreign('id_penghasilan_wali')->references('id_penghasilan')->on('pd_feeder_penghasilan');

            $table->integer('id_kebutuhan_khusus_mahasiswa')->default(0);

            $table->integer('id_kebutuhan_khusus_ayah')->default(0);

            $table->integer('id_kebutuhan_khusus_ibu')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_feeder_biodata_mahasiswa');
    }
};
