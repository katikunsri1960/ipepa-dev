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
            $table->string("id_mahasiswa");
            $table->primary('id_mahasiswa');
            $table->string("nama_mahasiswa")->nullable();
            $table->string("jenis_kelamin")->nullable();
            $table->string("tempat_lahir")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->string("id_agama")->nullable();
            $table->string("nama_agama")->nullable();
            $table->string("nik")->nullable();
            $table->string("nisn")->nullable();
            $table->string("npwp")->nullable();
            $table->string("id_negara")->nullable();
            $table->string("kewarganegaraan")->nullable();
            $table->string("jalan")->nullable();
            $table->string("dusun")->nullable();
            $table->string("rt")->nullable();
            $table->string("rw")->nullable();
            $table->string("kelurahan")->nullable();
            $table->string("kode_pos")->nullable();
            $table->string("id_wilayah")->nullable();
            $table->string("nama_wilayah")->nullable();
            $table->string("id_jenis_tinggal")->nullable();
            $table->string("nama_jenis_tinggal")->nullable();
            $table->string("id_alat_transportasi")->nullable();
            $table->string("nama_alat_transportasi")->nullable();
            $table->string("telepon")->nullable();
            $table->string("handphone")->nullable();
            $table->string("email")->nullable();
            $table->string("penerima_kps")->nullable();
            $table->string("nomor_kps")->nullable();
            $table->string("nik_ayah")->nullable();
            $table->string("nama_ayah")->nullable();
            $table->date("tanggal_lahir_ayah")->nullable();
            $table->string("id_pendidikan_ayah")->nullable();
            $table->string("nama_pendidikan_ayah")->nullable();
            $table->string("id_pekerjaan_ayah")->nullable();
            $table->string("nama_pekerjaan_ayah")->nullable();
            $table->string("id_penghasilan_ayah")->nullable();
            $table->string("nama_penghasilan_ayah")->nullable();
            $table->string("nik_ibu")->nullable();
            $table->string("nama_ibu_kandung")->nullable();
            $table->date("tanggal_lahir_ibu")->nullable();
            $table->string("id_pendidikan_ibu")->nullable();
            $table->string("nama_pendidikan_ibu")->nullable();
            $table->string("id_pekerjaan_ibu")->nullable();
            $table->string("nama_pekerjaan_ibu")->nullable();
            $table->string("id_penghasilan_ibu")->nullable();
            $table->string("nama_penghasilan_ibu")->nullable();
            $table->string("nama_wali")->nullable();
            $table->date("tanggal_lahir_wali")->nullable();
            $table->string("id_pendidikan_wali")->nullable();
            $table->string("nama_pendidikan_wali")->nullable();
            $table->string("id_pekerjaan_wali")->nullable();
            $table->string("nama_pekerjaan_wali")->nullable();
            $table->string("id_penghasilan_wali")->nullable();
            $table->string("nama_penghasilan_wali")->nullable();
            $table->string("id_kebutuhan_khusus_mahasiswa")->nullable();
            $table->string("nama_kebutuhan_khusus_mahasiswa")->nullable();
            $table->string("id_kebutuhan_khusus_ayah")->nullable();
            $table->string("nama_kebutuhan_khusus_ayah")->nullable();
            $table->string("id_kebutuhan_khusus_ibu")->nullable();
            $table->string("nama_kebutuhan_khusus_ibu")->nullable();
            $table->index('id_mahasiswa');
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
