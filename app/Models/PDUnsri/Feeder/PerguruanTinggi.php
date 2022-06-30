<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerguruanTinggi extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_perguruan_tinggi';
    protected $primaryKey = 'id_perguruan_tinggi';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_perguruan_tinggi', 'nama_perguruan_tinggi', 'kode_perguruan_tinggi', 'nama_singkat'
    ];
}
