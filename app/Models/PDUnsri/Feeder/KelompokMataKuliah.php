<?php

namespace App\Models\PDUnsri\Feeder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokMataKuliah extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_kelompok_mata_kuliah';
    protected $primaryKey = 'id_kelompok_mata_kuliah';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        'id_kelompok_mata_kuliah', 'nama_kelompok_mata_kuliah',
    ];
}
