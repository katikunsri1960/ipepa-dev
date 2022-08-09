<?php

namespace App\Models\PDUnsri\Feeder\Mahasiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasKuliahMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_aktivitas_kuliah_mahasiswa';
    public $timestamps = false;
    public $incrementing = false;

}
