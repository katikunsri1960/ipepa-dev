<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTransferPendidikan extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_nilai_transfer_pendidikan';
    public $timestamps = false;
    public $incrementing = false;
}
