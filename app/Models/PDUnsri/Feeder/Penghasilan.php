<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghasilan extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_penghasilan';
    protected $primaryKey = 'id_penghasilan';
    public $timestamps = false;

    protected $fillable = [
        'id_penghasilan', 'nama_penghasilan',
    ];
}
