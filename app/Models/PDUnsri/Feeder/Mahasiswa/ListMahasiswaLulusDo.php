<?php

namespace App\Models\PDUnsri\Feeder\Mahasiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListMahasiswaLulusDo extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_mahasiswa_lulus_do';
    public $timestamps = false;
    public $incrementing = false;

    public function mahasiswa()
    {
        return $this->belongsTo(ListMahasiswa::class, 'id_registrasi_mahasiswa', 'id_registrasi_mahasiswa');
    }
}
