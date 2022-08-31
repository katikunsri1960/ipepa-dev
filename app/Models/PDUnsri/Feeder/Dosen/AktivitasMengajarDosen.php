<?php

namespace App\Models\PDUnsri\Feeder\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasMengajarDosen extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_aktivitas_mengajar_dosen';
    public $timestamps = false;
    public $incrementing = false;
}
