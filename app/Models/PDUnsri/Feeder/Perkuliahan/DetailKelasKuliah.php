<?php

namespace App\Models\PDUnsri\Feeder\Perkuliahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKelasKuliah extends Model
{
    use HasFactory;
    protected $table = 'pd_feeder_detail_kelas_kuliah';
    public $timestamps = false;
    public $incrementing = false;
}
