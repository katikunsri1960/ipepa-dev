<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTinggal extends Model
{
    use HasFactory;

    protected $table = 'pd_feeder_jenis_tinggal';
    protected $primaryKey = 'id_jenis_tinggal';
    public $timestamps = false;

    protected $fillable = [
        'id_jenis_tinggal', 'nama_jenis_tinggal',
    ];
}
