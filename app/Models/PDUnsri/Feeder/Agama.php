<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_agama';
    protected $primaryKey = 'id_agama';
    public $timestamps = false;

    protected $fillable = [
        'id_agama', 'nama_agama',
    ];
}
