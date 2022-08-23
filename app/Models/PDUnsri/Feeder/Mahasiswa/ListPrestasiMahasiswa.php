<?php

namespace App\Models\PDUnsri\Feeder\Mahasiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPrestasiMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_prestasi_mahasiswa';
    public $timestamps = false;
    public $incrementing = false;
}
