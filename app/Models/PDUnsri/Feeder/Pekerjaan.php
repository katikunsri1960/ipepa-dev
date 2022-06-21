<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pd_feeder_pekerjaan';
    protected $primaryKey = 'id_pekerjaan';
    public $timestamps = false;

    protected $fillable = [
        'id_pekerjaan', 'nama_pekerjaan',
    ];
}
