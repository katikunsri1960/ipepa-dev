<?php

namespace App\Models\PDUnsri\Feeder\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PangkatGolongan extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_pangkat_golongan';
    protected $primaryKey = 'id_pangkat_golongan';

    public $timestamps = false;
    public $incrementing = false;
}
