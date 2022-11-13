<?php

namespace App\Models\PDUnsri\Feeder\Perkuliahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaPembelajaran extends Model
{
    use HasFactory;

    protected $table = 'pd_feeder_rencana_pembelajaran';
    public $timestamps = false;
    public $incrementing = false;
}
