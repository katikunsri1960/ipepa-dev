<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembiayaan extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_pembiayaan';
    protected $primaryKey = 'id_pembiayaan';
    public $timestamps = false;

    protected $fillable = [
        'id_pembiayaan', 'nama_pembiayaan',
    ];

}
