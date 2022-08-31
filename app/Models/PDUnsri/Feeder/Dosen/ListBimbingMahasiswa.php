<?php

namespace App\Models\PDUnsri\Feeder\Dosen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBimbingMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_bimbing_mahasiswa';

    public $timestamps = false;
    public $incrementing = false;
}
