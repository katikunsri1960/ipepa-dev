<?php

namespace App\Models\PDUnsri\Feeder\Pelengkap;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriodePerkuliahan extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_detail_periode_perkuliahan';
    public $timestamps = false;
    public $incrementing = false;
}
