<?php

namespace App\Models\PDUnsri\Feeder\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListAnggotaAktivitasMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_anggota_aktivitas_mahasiswa';

    public $timestamps = false;
    public $incrementing = false;
}
