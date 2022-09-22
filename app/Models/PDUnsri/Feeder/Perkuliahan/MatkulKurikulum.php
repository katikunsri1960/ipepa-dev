<?php

namespace App\Models\PDUnsri\Feeder\Perkuliahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulKurikulum extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_matkul_kurikulum';
    public $timestamps = false;
    public $incrementing = false;
}
