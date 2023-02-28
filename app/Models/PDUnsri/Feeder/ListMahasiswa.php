<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\PDUnsri\Feeder\Mahasiswa\ListMahasiswaLulusDo;

class ListMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_mahasiswa';
    protected $primaryKey = null;
    public $timeStamps = false;
    public $incrementing = false;

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
            set: function ($value) {
                if ($value == 'Laki-laki') {
                    return 'L';
                } elseif ($value == 'Perempuan') {
                    return 'P';
                } else {
                    return '-';
                }
            }

        );
    }

    public function lulus_do()
    {
        return $this->hasOne(ListMahasiswaLulusDo::class, 'id_registrasi_mahasiswa', 'id_registrasi_mahasiswa');
    }

}
