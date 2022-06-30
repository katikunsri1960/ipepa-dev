<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'pd_feeder_wilayah';
    protected $primaryKey = 'id_wilayah';
    
    public $timestamps = false;

    protected $fillable = [
        'id_wilayah', 'id_negara', 'nama_wilayah',
    ];
}
