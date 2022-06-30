<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMataKuliah extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_jenis_mata_kuliah';
    protected $primaryKey = 'id_jenis_mata_kuliah';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_jenis_mata_kuliah', 'nama_jenis_mata_kuliah',
    ];
}
