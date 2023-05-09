<?php

namespace App\Models\PDUnsri\Feeder\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAktivitasMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'pd_feeder_jenis_aktivitas_mahasiswa';
    protected $primaryKey = 'id_jenis_aktivitas_mahasiswa';
    
    public $timestamps = false;
}
