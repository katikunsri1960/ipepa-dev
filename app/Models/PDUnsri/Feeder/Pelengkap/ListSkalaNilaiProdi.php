<?php

namespace App\Models\PDUnsri\Feeder\Pelengkap;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListSkalaNilaiProdi extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_skala_nilai_prodi';
    public $timestamps = false;
    public $incrementing = false;
}
