<?php

namespace App\Models\PDUnsri\Feeder\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ListDosen extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_dosen';
    protected $primaryKey = 'id_dosen';
    protected $keyType = 'string';

    public $timestamps = false;
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
}
