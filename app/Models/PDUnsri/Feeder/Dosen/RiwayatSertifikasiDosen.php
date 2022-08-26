<?php

namespace App\Models\PDUnsri\Feeder\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatSertifikasiDosen extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_riwayat_sertifikasi_dosen';
    protected $primaryKey = 'id_dosen';
    protected $keyType = 'string';

    public $timestamps = false;
    public $incrementing = false;
}
