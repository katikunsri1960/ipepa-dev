<?php

namespace App\Models\PDUnsri\Feeder\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPenugasanDosen extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_penugasan_dosen';

    public $timestamps = false;
    public $incrementing = false;
}
