<?php

namespace App\Models\PDUnsri\Feeder\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPengajarKelasKuliah extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_dosen_pengajar_kelas_kuliah';
    public $timestamps = false;
    public $incrementing = false;
}
