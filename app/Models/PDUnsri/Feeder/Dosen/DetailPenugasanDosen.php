<?php

namespace App\Models\PDUnsri\Feeder\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenugasanDosen extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_detail_penugasan_dosen';
    protected $primaryKey = 'id_dosen';
    protected $keyType = 'string';

    public $timestamps = false;
    public $incrementing = false;
}
