<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'pd_feeder_biodata_mahasiswa';

    protected $primaryKey = 'id_mahasiswa';

    protected $keyType = 'string';

    protected $fillable = [
        'id_mahasiswa',
        'nama_mahasiswa', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'id_agama', 'nama_agama', 'nik', 'nisn', 'npwp', 'id_negara', 'kewarganegaraan',
        'jalan', 'dusun', 'rt', 'rw', 'kelurahan', 'kode_pos', 'id_wilayah',
        'id_jenis_tinggal', 'nama_jenis_tinggal', 'id_alat_transportasi', 'nama_alat_transportasi', 'telepon', 'handphone',
        'email', 'penerima_kps', 'nomor_kps', 'nik_ayah', 'nama_ayah',
        'tanggal_lahir_ayah', 'id_pendidikan_ayah', 'id_pekerjaan_ayah', 'id_penghasilan_ayah',
        'nik_ibu', 'nama_ibu_kandung', 'tanggal_lahir_ibu', 'id_pendidikan_ibu', 'id_pekerjaan_ibu', 'id_penghasilan_ibu',
        'nama_ibu_wali', 'tanggal_lahir_wali', 'id_pendidikan_wali', 'id_pekerjaan_wali', 'id_penghasilan_wali',
        'id_kebutuhan_khusus_mahasiswa', 'id_kebutuhan_khusus_ayah', 'id_kebutuhan_khusus_ibu'

    ];

    public $timestamps = false;
    public $increments = false;
}
