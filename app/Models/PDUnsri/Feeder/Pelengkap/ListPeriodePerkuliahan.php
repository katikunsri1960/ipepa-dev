<?php

namespace App\Models\PDUnsri\Feeder\Pelengkap;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPeriodePerkuliahan extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_periode_perkuliahan';
    public $timestamps = false;
    public $incrementing = false;
}
