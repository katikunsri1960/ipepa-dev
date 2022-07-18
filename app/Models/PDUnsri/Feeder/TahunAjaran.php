<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_tahun_ajaran';
    protected $primaryKey = 'id_tahun_ajaran';

    public $timestamps = false;
}
