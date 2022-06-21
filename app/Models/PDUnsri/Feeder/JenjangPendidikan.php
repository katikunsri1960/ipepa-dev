<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenjangPendidikan extends Model
{
    use HasFactory;

    protected $table = 'pd_feeder_jenjang_pendidikan';
    protected $primaryKey = 'id_jenjang_didik';
    public $timestamps = false;

    protected $fillable = [
        'id_jenjang_didik', 'nama_jenjang_didik',
    ];
}
