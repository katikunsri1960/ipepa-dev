<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatTransportasi extends Model
{
    use HasFactory;

    protected $table = 'pd_feeder_alat_transportasi';
    protected $primaryKey = 'id_alat_transportasi';
    public $timestamps = false;

    protected $fillable = [
        'id_alat_transportasi', 'nama_alat_transportasi',
    ];
}
