<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BiodataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'pd_feeder_biodata_mahasiswa';

    protected $primaryKey = 'id_mahasiswa';

    protected $keyType = 'string';

    protected $fillable = [
        "id_mahasiswa",
            "nama_mahasiswa",
            "jenis_kelamin",
            "tempat_lahir",
            "tanggal_lahir",
            "id_agama",
            "nama_agama",
            "nik",
            "nisn",
            "npwp",
            "id_negara",
            "nama_negara",
            "kewarganegaraan",
            "jalan",
            "dusun",
            "rt",
            "rw",
            "kelurahan",
            "kode_pos",
            "id_wilayah",
            "nama_wilayah",
            "id_jenis_tinggal",
            "nama_jenis_tinggal",
            "id_alat_transportasi",
            "nama_alat_transportasi",
            "telepon",
            "handphone",
            "email",
            "penerima_kps",
            "nomor_kps",
            "nik_ayah",
            "nama_ayah",
            "tanggal_lahir_ayah",
            "id_pendidikan_ayah",
            "nama_pendidikan_ayah",
            "id_pekerjaan_ayah",
            "nama_pekerjaan_ayah",
            "id_penghasilan_ayah",
            "nama_penghasilan_ayah",
            "nik_ibu",
            "nama_ibu_kandung",
            "tanggal_lahir_ibu",
            "id_pendidikan_ibu",
            "nama_pendidikan_ibu",
            "id_pekerjaan_ibu",
            "nama_pekerjaan_ibu",
            "id_penghasilan_ibu",
            "nama_penghasilan_ibu",
            "nama_wali",
            "tanggal_lahir_wali",
            "id_pendidikan_wali",
            "nama_pendidikan_wali",
            "id_pekerjaan_wali",
            "nama_pekerjaan_wali",
            "id_penghasilan_wali",
            "nama_penghasilan_wali",
            "id_kebutuhan_khusus_mahasiswa",
            "nama_kebutuhan_khusus_mahasiswa",
            "id_kebutuhan_khusus_ayah",
            "nama_kebutuhan_khusus_ayah",
            "id_kebutuhan_khusus_ibu",
            "nama_kebutuhan_khusus_ibu",
    ];

    public $timestamps = false;
    public $increments = false;

    public function JenisKelamin(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($value == 'L') {
                    return 'Laki-laki';
                } elseif ($value == 'P') {
                    return 'Perempuan';
                } else {
                    return '-';
                }
            },

        );
    }

    public function PenerimaKps(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($value == '0') {
                    return 'Tidak';
                } elseif ($value == '1') {
                    return 'Ya';
                } else {
                    return '-';
                }
            },

        );
    }
}
