<?php

namespace App\Models\PDUnsri\Feeder\Mahasiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranskripMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'transkrip_mahasiswa';

    public $timestamps = false;
    public $incrementing = false;
}
