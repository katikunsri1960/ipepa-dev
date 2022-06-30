<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDaftar extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_jenis_daftar';
    protected $primaryKey = 'id_jenis_daftar';
    public $timestamps = false;

    protected $fillable = [
        'id_jenis_daftar', 'nama_jenis_daftar', 'untuk_daftar_sekolah',
    ];
}
