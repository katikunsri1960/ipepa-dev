<?php

namespace App\Models\PDUnsri\Feeder\Mahasiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListRiwayatPendidikanMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_riwayat_pendidikan_mahasiswa';
    protected $primaryKey = 'id_registrasi_mahasiswa';
    protected $keyType = 'string';

    public $timestamps = false;
    public $incrementing = false;
}
