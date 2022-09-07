<?php

namespace App\Models\PDUnsri\Feeder\Perkuliahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListSubstansiKuliah extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_list_substansi_kuliah';
    public $timestamps = false;
    public $incrementing = false;
}