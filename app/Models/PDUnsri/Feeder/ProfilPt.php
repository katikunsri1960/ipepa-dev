<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPt extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_profil_pt';
    protected $primaryKey = null;

    public $timestamps = false;
    public $incrementing = false;
}
